<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [edit] precheck processes for product createmessages
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Createmessage;
use Closure;
use Log;

class Edit {

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

        //createmessage id
        $createmessage_id = $request->route('createmessage');

        //does the createmessage exist
        if ($createmessage_id == '' || !$createmessage = \App\Models\Timer::Where('timer_id', $createmessage_id)->first()) {
            Log::error("createmessage could not be found", ['process' => '[permissions][createmessages][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'createmessage id' => $createmessage_id ?? '']);
            abort(404);
        }

        //permission: does user have permission edit createmessages
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_createmessage >= 2) {
                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][createmessages][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }
}
