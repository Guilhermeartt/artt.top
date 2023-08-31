<?php

/** -------------------------------------------------------------------------------------------------
 * @description
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 *
 * @details
 * The cron will look for items (e.g tasks, invoices, etc) that are meant to me linked to another item
 * (e.g. a project) but that item nolonger exists (for whatever reason)
 * The cleanup is needed to avoid sql errors due to missing content
 *
 * @package    Grow CRM
 * @author     NextLoop
 *
 *---------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs\Cleanup;
use App\Repositories\DestroyRepository;
use Illuminate\Support\Facades\Log;

class OrphanedRecordsCron {

    protected $destroyrepo;

    public function __invoke(
        DestroyRepository $destroyrepo
    ) {

        $this->destroyrepo = $destroyrepo;

        //[MT] - tenants only
        if (env('MT_TPYE')) {
            if (\Spatie\Multitenancy\Models\Tenant::current() == null) {
                return;
            }
            //boot system settings
            middlwareBootSystem();
            middlewareBootMail();
        }

        //delete orphaned tasks
        $this->orphanedTasks();

    }

    /**
     * All tasks should be linked to a project (even 'spaces' or 'templates' tasks)
     * Find tasks that are not linked and delete them. They should have been deleted when the parent was deleted
     *
     */
    public function orphanedTasks() {

        //get all tasks that are not linked to any project
        if ($tasks = \App\Models\Task::WhereNotIn('task_projectid', function ($query) {
            $query->select('project_id')->from('projects')->groupby('project_id');
        })->get()) {

            //loop through and delete the task
            foreach ($tasks as $task) {
                Log::info("Task with id (" . $task->task_id . ") is orphaned [it is not linked to a project]. It wil now be deleted", ['process' => '[OrphanedRecordsCron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => 1]);
                $this->destroyrepo->destroyTask($task->task_id);
            }

        }
    }

}