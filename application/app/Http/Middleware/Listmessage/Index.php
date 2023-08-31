<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for tickets
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Tistmessages;

use App\Models\Tistmessage;
use Closure;
use Log;

class Index {

    /**
     * This middleware does the following
     *   2. checks users permissions to [view] listmessage
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
        if (request()->filled('listmessageresource_type') && request()->filled('listmessageresource_id')) {
            //project listmessage
            if (request('listmessageresource_type') == 'project') {
                request()->merge([
                    'filter_timer_projectid' => request('listmessageresource_id'),
                ]);
            }
            //client listmessage
            if (request('listmessageresource_type') == 'client') {
                request()->merge([
                    'filter_timer_clientid' => request('listmessageresource_id'),
                ]);
            }
        }

        //admin user permission
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_listmessage >= 1) {
                //limit to own listmessage, if applicable
                if (auth()->user()->role->role_listmessage_scope == 'own' || request()->segment(2) == 'my') {
                    request()->merge([
                        'filter_timer_creatorid' => auth()->id(),
                    ]);
                }
                return $next($request);
            }
        }

        //client - allow to view only embedded. Also as per project settings
        if (auth()->user()->is_client) {
            if (request()->ajax() && request()->filled('listmessageresource_id')) {
                if ($project = \App\Models\Project::Where('project_id', request('listmessageresource_id'))->first()) {
                    if ($project->clientperm_listmessage_view == 'yes') {
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
        Log::error("permission denied", ['process' => '[permissions][listmessage][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        /**
         * shorten resource_type and resource_id (for easy appending in blade templates - action url's)
         * [usage]
         *   replace the usual url('listmessage/edit/etc') with urlResource('listmessage/edit/etc'), in blade templated
         *   usually in the ajax.blade.php files (actions links)
         * */
        if (request('listmessageresource_type') != '' || is_numeric(request('listmessageresource_id'))) {
            request()->merge([
                'resource_query' => 'ref=list&listmessageresource_type=' . request('listmessageresource_type') . '&listmessageresource_id=' . request('listmessageresource_id'),
            ]);
        } else {
            request()->merge([
                'resource_query' => 'ref=list',
            ]);
        }

        //default show some table columns
        config([
            'visibility.listmessage_col_related' => true,
            'visibility.listmessage_col_action' => true,
            'visibility.filter_panel_resource' => true,
        ]);

        //permissions -viewing
        if (auth()->user()->role->role_listmessage >= 1) {
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
                    'visibility.listmessage_col_client' => false,
                    'visibility.listmessage_col_action' => false,
                    'visibility.listmessage_grouped_by_users' => true,
                ]);
            }

            //disable whe grouping listmessage
            if (request('filter_grouping') == 'task') {
                config([
                    //visibility
                    'visibility.listmessage_grouped_by_users' => true,
                ]);
            }
        }

        if (auth()->user()->role->role_listmessage == 1) {
            config([
                'visibility.listmessage_col_action' => false,
            ]);

        }

        //permissions -adding
        if (auth()->user()->role->role_listmessage >= 2) {
            config([
                //visibility
                'visibility.action_buttons_edit' => true,
                'visibility.listmessage_col_checkboxes' => true,
            ]);
        }

        //permissions -deleting
        if (auth()->user()->role->role_listmessage >= 3) {
            config([
                //visibility
                'visibility.action_buttons_delete' => true,
            ]);
            //disable whe grouping listmessage
            if (request('filter_grouping') == 'task' || request('filter_grouping') == 'user') {
                config([
                    //visibility
                    'visibility.listmessage_disable_actions' => true,
                    'visibility.action_buttons_delete' => false,
                ]);
            }
        }

        //columns visibility
        if (request('listmessageresource_type') != '') {
            config([
                //visibility
                'visibility.listmessage_col_related' => false,
                'visibility.filter_panel_resource' => false,
            ]);
        }
    }
}
