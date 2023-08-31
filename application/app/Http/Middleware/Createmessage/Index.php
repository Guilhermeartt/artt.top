<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for tickets
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Createmessage;

use App\Models\Createmessage;
use Closure;
use Log;

class Index {

    /**
     * This middleware does the following
     *   2. checks users permissions to [view] createmessages
     *   3. modifies the request object as needed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //various frontend and visibility settings
        $this->fronteEnd();

        //embedded request: limit by supplied resource data
        if (request()->filled('createmessageresource_type') && request()->filled('createmessageresource_id')) {
            //project createmessages
            if (request('createmessageresource_type') == 'project') {
                request()->merge([
                    'filter_timer_projectid' => request('createmessageresource_id'),
                ]);
            }
            //client createmessages
            if (request('createmessageresource_type') == 'client') {
                request()->merge([
                    'filter_timer_clientid' => request('createmessageresource_id'),
                ]);
            }
        }

        //admin user permission
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_createmessage >= 1) {
                //limit to own createmessages, if applicable
                if (auth()->user()->role->role_createmessage_scope == 'own' || request()->segment(2) == 'my') {
                    request()->merge([
                        'filter_timer_creatorid' => auth()->id(),
                    ]);
                }
                return $next($request);
            }
        }

        //client - allow to view only embedded. Also as per project settings
        if (auth()->user()->is_client) {
            if (request()->ajax() && request()->filled('createmessageresource_id')) {
                if ($project = \App\Models\Project::Where('project_id', request('createmessageresource_id'))->first()) {
                    if ($project->clientperm_createmessages_view == 'yes') {
                        //goup by tasks
                        request()->merge([
                            'filter_grouping' => 'task',
                        ]);      
                        return $next($request);
                    }
                }
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][createmessages][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        /**
         * shorten resource_type and resource_id (for easy appending in blade templates - action url's)
         * [usage]
         *   replace the usual url('createmessage/edit/etc') with urlResource('createmessage/edit/etc'), in blade templated
         *   usually in the ajax.blade.php files (actions links)
         * */
        if (request('createmessageresource_type') != '' || is_numeric(request('createmessageresource_id'))) {
            request()->merge([
                'resource_query' => 'ref=list&createmessageresource_type=' . request('createmessageresource_type') . '&createmessageresource_id=' . request('createmessageresource_id'),
            ]);
        } else {
            request()->merge([
                'resource_query' => 'ref=list',
            ]);
        }

        //default show some table columns
        config([
            'visibility.createmessages_col_related' => true,
            'visibility.createmessages_col_action' => true,
            'visibility.filter_panel_resource' => true,
        ]);

        //permissions -viewing
        if (auth()->user()->role->role_createmessage >= 1) {
            if (auth()->user()->is_team) {
                config([
                    //visibility
                    'visibility.list_page_actions_filter_button' => true,
                    'visibility.list_page_actions_add_button' => true,
                    'visibility.list_page_actions_search' => true,
                ]);
            }
            if (auth()->user()->is_client) {
                config([
                    //visibility
                    'visibility.list_page_actions_search' => true,
                    'visibility.createmessages_col_client' => false,
                    'visibility.createmessages_col_action' => false,
                    'visibility.createmessages_grouped_by_users' => true,
                ]);
            }

            //disable whe grouping createmessages
            if (request('filter_grouping') == 'task') {
                config([
                    //visibility
                    'visibility.createmessages_grouped_by_users' => true,
                ]);
            }
        }

        if (auth()->user()->role->role_createmessage == 1) {
            config([
                'visibility.createmessages_col_action' => false,
            ]);

        }

        //permissions -adding
        if (auth()->user()->role->role_createmessage >= 2) {
            config([
                //visibility
                'visibility.action_buttons_edit' => true,
                'visibility.createmessages_col_checkboxes' => true,
            ]);
        }

        //permissions -deleting
        if (auth()->user()->role->role_createmessage >= 3) {
            config([
                //visibility
                'visibility.action_buttons_delete' => true,
            ]);
            //disable whe grouping createmessages
            if (request('filter_grouping') == 'task' || request('filter_grouping') == 'user') {
                config([
                    //visibility
                    'visibility.createmessages_disable_actions' => true,
                    'visibility.action_buttons_delete' => false,
                ]);
            }
        }

        //columns visibility
        if (request('createmessageresource_type') != '') {
            config([
                //visibility
                'visibility.createmessages_col_related' => false,
                'visibility.filter_panel_resource' => false,
            ]);
        }
    }
}
