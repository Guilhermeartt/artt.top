<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [edit] precheck processes for product whatsapp
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
     *   2. checks users permissions to [view] whatsapp
     *   3. modifies the request object as needed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //whatsapp id
        $whatsapp_id = $request->route('whatsapp');

        //does the whatsapp exist
        if ($whatsapp_id == '' || !$whatsapp = \App\Models\Timer::Where('timer_id', $whatsapp_id)->first()) {
            Log::error("whatsapp could not be found", ['process' => '[permissions][whatsapp][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'whatsapp id' => $whatsapp_id ?? '']);
            abort(404);
        }

        //permission: does user have permission edit whatsapp
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_whatsapp >= 2) {
                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][whatsapp][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }
}
