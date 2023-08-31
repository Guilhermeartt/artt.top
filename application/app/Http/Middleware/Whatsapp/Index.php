<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for tickets
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Whatsapp;

use App\Models\Whatsapp;
use Closure;
use Log;

class Index {

    /**
     * This middleware does the following
     *   2. checks users permissions to [view] whatsapp
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
        if (request()->filled('whatsappresource_type') && request()->filled('whatsappresource_id')) {
            //project whatsapp
            if (request('whatsappresource_type') == 'project') {
                request()->merge([
                    'filter_timer_projectid' => request('whatsappresource_id'),
                ]);
            }
            //client whatsapp
            if (request('whatsappresource_type') == 'client') {
                request()->merge([
                    'filter_timer_clientid' => request('whatsappresource_id'),
                ]);
            }
        }

        //admin user permission
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_whatsapp >= 1) {
                //limit to own whatsapp, if applicable
                if (auth()->user()->role->role_whatsapp_scope == 'own' || request()->segment(2) == 'my') {
                    request()->merge([
                        'filter_timer_creatorid' => auth()->id(),
                    ]);
                }
                return $next($request);
            }
        }

        //client - allow to view only embedded. Also as per project settings
        if (auth()->user()->is_client) {
            if (request()->ajax() && request()->filled('whatsappresource_id')) {
                if ($project = \App\Models\Project::Where('project_id', request('whatsappresource_id'))->first()) {
                    if ($project->clientperm_whatsapp_view == 'yes') {
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
        Log::error("permission denied", ['process' => '[permissions][whatsapp][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        /**
         * shorten resource_type and resource_id (for easy appending in blade templates - action url's)
         * [usage]
         *   replace the usual url('whatsapp/edit/etc') with urlResource('whatsapp/edit/etc'), in blade templated
         *   usually in the ajax.blade.php files (actions links)
         * */
        if (request('whatsappresource_type') != '' || is_numeric(request('whatsappresource_id'))) {
            request()->merge([
                'resource_query' => 'ref=list&whatsappresource_type=' . request('whatsappresource_type') . '&whatsappresource_id=' . request('whatsappresource_id'),
            ]);
        } else {
            request()->merge([
                'resource_query' => 'ref=list',
            ]);
        }

        //default show some table columns
        config([
            'visibility.whatsapp_col_related' => true,
            'visibility.whatsapp_col_action' => true,
            'visibility.filter_panel_resource' => true,
        ]);

        //permissions -viewing
        if (auth()->user()->role->role_whatsapp >= 1) {
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
                    'visibility.whatsapp_col_client' => false,
                    'visibility.whatsapp_col_action' => false,
                    'visibility.whatsapp_grouped_by_users' => true,
                ]);
            }

            //disable whe grouping whatsapp
            if (request('filter_grouping') == 'task') {
                config([
                    //visibility
                    'visibility.whatsapp_grouped_by_users' => true,
                ]);
            }
        }

        if (auth()->user()->role->role_whatsapp == 1) {
            config([
                'visibility.whatsapp_col_action' => false,
            ]);

        }

        //permissions -adding
        if (auth()->user()->role->role_whatsapp >= 2) {
            config([
                //visibility
                'visibility.action_buttons_edit' => true,
                'visibility.whatsapp_col_checkboxes' => true,
            ]);
        }

        //permissions -deleting
        if (auth()->user()->role->role_whatsapp >= 3) {
            config([
                //visibility
                'visibility.action_buttons_delete' => true,
            ]);
            //disable whe grouping whatsapp
            if (request('filter_grouping') == 'task' || request('filter_grouping') == 'user') {
                config([
                    //visibility
                    'visibility.whatsapp_disable_actions' => true,
                    'visibility.action_buttons_delete' => false,
                ]);
            }
        }

        //columns visibility
        if (request('whatsappresource_type') != '') {
            config([
                //visibility
                'visibility.whatsapp_col_related' => false,
                'visibility.filter_panel_resource' => false,
            ]);
        }
    }
}
