<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [edit] precheck processes for product listmessages
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Timesheets;
use Closure;
use Log;

class Edit {

    /**
     * This middleware does the following
     *   2. checks users permissions to [view] listmessages
     *   3. modifies the request object as needed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //listmessage id
        $listmessage_id = $request->route('listmessage');

        //does the listmessage exist
        if ($listmessage_id == '' || !$listmessage = \App\Models\Timer::Where('timer_id', $listmessage_id)->first()) {
            Log::error("listmessage could not be found", ['process' => '[permissions][listmessages][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'listmessage id' => $listmessage_id ?? '']);
            abort(404);
        }

        //permission: does user have permission edit listmessages
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_listmessages >= 2) {
                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][listmessages][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }
}
