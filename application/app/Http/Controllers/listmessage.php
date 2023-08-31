<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for time sheets
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Listmessage\CreateResponse;
use App\Http\Responses\Listmessage\DestroyResponse;
use App\Http\Responses\Listmessage\EditResponse;
use App\Http\Responses\Listmessage\IndexResponse;
use App\Http\Responses\Listmessage\StoreResponse;
use App\Http\Responses\Listmessage\UpdateResponse;
use App\Permissions\TaskPermissions;
use App\Repositories\TimerRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class Listmessage extends Controller {

    /**
     * The timesheet repository instance.
     */
    protected $timerrepo;

    public function __construct(TimerRepository $timerrepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        $this->middleware('listmessageMiddlewareIndex')->only([
            'index',
            'update',
            'store',
        ]);
        $this->middleware('listmessageMiddlewareEdit')->only([
            'update',
        ]);
        $this->middleware('listmessageMiddlewareDestroy')->only([
            'destroy',
        ]);

        $this->timerrepo = $timerrepo;
    }

    /**
     * Display a listing of listmessage
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //only stopped timers
        request()->merge([
            'filter_timer_status' => 'stopped',
        ]);

        //get listmessage
        $listmessage = $this->timerrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('listmessage'),
            'listmessage' => $listmessage,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //response
        return new CreateResponse();
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function store(TaskPermissions $taskpermissions) {

        //validate - custom error messages
        $messages = [
            'timer_created.required' => __('lang.date') . '-' . __('lang.is_required'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'my_assigned_tasks' => [
                'required',
                Rule::exists('tasks', 'task_id'),
            ],
            'timer_created' => [
                'required',
                'date',
            ],
            'manual_time_hours' => [
                'required',
                'numeric',
            ],
            'manual_time_minutes' => [
                'required',
                'numeric',
            ],
        ], $messages);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }
            abort(409, $messages);
        }

        //validate if user is assigned to this task
        if (!$taskpermissions->check('assigned', request('my_assigned_tasks'))) {
            abort(409, __('lang.you_are_now_not_assigned_to_this_task'));
        }

        //get task
        $task = \App\Models\Task::Where('task_id', request('my_assigned_tasks'))->first();

        //hours and minutes
        $hours = request('manual_time_hours') * 60 * 60;
        $minutes = request('manual_time_minutes') * 60;
        $total = $hours + $minutes;

        //validate
        if ($total <= 0) {
            abort(409, __('lang.total_time_must_be_greater_than_1_minute'));
        }

        $timer = new \App\Models\Timer();
        $timer->timer_creatorid = auth()->id();
        $timer->timer_created = request('timer_created');
        $timer->timer_time = $total;
        $timer->timer_taskid = $task->task_id;
        $timer->timer_projectid = $task->task_projectid;
        $timer->timer_clientid = $task->task_clientid;
        $timer->timer_status = 'stopped';
        $timer->save();

        //count sheets on this page
        if (request()->segment(2) == 'my') {
            request()->merge([
                'filter_timer_creatorid' => auth()->id(),
            ]);
        }
        $listmessage = $this->timerrepo->search();
        $count = $listmessage->total();

        //get refreshed timesheet
        $listmessage = $this->timerrepo->search($timer->timer_id);

        //reponse payload
        $payload = [
            'listmessage' => $listmessage,
            'count' => $count,
        ];

        //generate a response
        return new StoreResponse($payload);
    }

    /**
     * Show the form for editing the specified timesheet
     * @param object CategoryRepository instance of the repository
     * @param int $id timesheet id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        if (!$time = \App\Models\Timer::Where('timer_id', $id)->first()) {
            abort(404);
        }

        //reponse payload
        $payload = [
            'time' => $time,
        ];

        //return the reposnse
        return new EditResponse($payload);
    }

    /**
     * Update the specified timesheetin storage.
     * @param object timesheetStoreUpdate instance of the repository
     * @param object UnitRepository instance of the repository
     * @param int $id timesheet id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {

        //get the timer
        if (!$timer = \App\Models\Timer::Where('timer_id', $id)->first()) {
            abort(404);
        }

        //hours and minutes
        $hours = request('manual_time_hours') * 60 * 60;
        $minutes = request('manual_time_minutes') * 60;
        $seconds = request('manual_time_seconds');
        $total = $hours + $minutes + $seconds;

        //validate
        if ($total < 60) {
            abort(409, __('lang.total_time_must_be_greater_than_1_minute'));
        }

        //update
        $timer->timer_time = $hours + $minutes + $seconds;
        $timer->save();

        //get updates
        $listmessage = $this->timerrepo->search($id);

        //reponse payload
        $payload = [
            'listmessage' => $listmessage,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy() {

        //delete each record in the array
        $allrows = array();
        foreach (request('ids') as $id => $value) {
            //only checked items
            if ($value == 'on') {
                //get the timer
                $timer = \App\Models\Timer::Where('timer_id', $id)->first();
                //delete client
                $timer->delete();
                //add to array
                $allrows[] = $id;
            }
        }
        //reponse payload
        $payload = [
            'allrows' => $allrows,
        ];

        //generate a response
        return new DestroyResponse($payload);
    }
    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.listmessage'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'listmessage',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_listmessage' => 'active',
            'mainmenu_sales' => 'active',
            'submenu_listmessage' => 'active',
            'sidepanel_id' => 'sidepanel-filter-listmessage',
            'dynamic_search_url' => url('listmessage/search?action=search&timesheetresource_id=' . request('timesheetresource_id') . '&timesheetresource_type=' . request('timesheetresource_type')),
            'add_button_classes' => '',
            'add_button_classes' => 'add-edit-item-button',
            'load_more_button_route' => 'listmessage',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.record_your_work_time'),
            'add_modal_create_url' => url('listmessage/create'),
            'add_modal_action_url' => url('listmessage'),
            'add_modal_action_ajax_class' => '',
            'add_modal_size' => 'modal-sm',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'listmessage') {
            $page += [
                'meta_title' => __('lang.listmessage'),
                'heading' => __('lang.listmessage'),

            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //return
        return $page;
    }
}
