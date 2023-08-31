<?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="task_<?php echo e($task->task_id); ?>" class="<?php echo e(runtimeTaskCompletedStatus($task->task_status)); ?>">
    <td class="tasks_col_title td-edge">
        <!--for polling timers-->
        <input type="hidden" name="tasks[<?php echo e($task->task_id); ?>]" value="<?php echo e($task->assigned_to_me); ?>">
        <!--checkbox-->
        <span class="task_border td-edge-border bg-<?php echo e($task->taskstatus_color); ?>"></span>
        <?php if(config('visibility.tasks_checkbox')): ?>
        <span class="list-checkboxes m-l-0">
            <input type="checkbox" id="toggle_task_status_<?php echo e($task->task_id); ?>" name="toggle_task_status"
                class="toggle_task_status filled-in chk-col-light-blue js-ajax-ux-request-default"
                data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/toggle-status')); ?>" data-ajax-type="post"
                data-type="form" data-form-id="task_<?php echo e($task->task_id); ?>" data-notifications="disabled"
                data-container="task_<?php echo e($task->task_id); ?>" data-progress-bar="hidden" data-task-status="<?php echo e($task->task_status); ?>"
                <?php echo e(runtimePrechecked($task->task_status)); ?> <?php echo e(runtimeTaskDependencyLock($task->count_dependency_cannot_complete)); ?>>

            <label for="toggle_task_status_<?php echo e($task->task_id); ?>">
                <a class="show-modal-button reset-card-modal-form js-ajax-ux-request" href="javascript:void(0)"
                    data-toggle="modal" data-target="#cardModal" data-url="<?php echo e(urlResource('/tasks/'.$task->task_id)); ?>"
                    data-loading-target="main-top-nav-bar"><span class="x-strike-through"
                        id="table_task_title_<?php echo e($task->task_id); ?>">
                        <?php echo e(str_limit($task->task_title ?? '---', 40)); ?></span>                 
                  <!--various icons displayed next to title-->
                  <?php echo $__env->make('pages.tasks.components.common.icons-1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </a>
            </label>
        </span>
        <?php endif; ?>
        <?php if(config('visibility.tasks_nocheckbox')): ?>
        <a class="show-modal-button reset-card-modal-form js-ajax-ux-request p-l-5" href="javascript:void(0)"
            data-toggle="modal" data-target="#cardModal" data-url="<?php echo e(urlResource('/tasks/'.$task->task_id)); ?>"
            data-loading-target="main-top-nav-bar"><span class="x-strike-through"
                id="table_task_title_<?php echo e($task->task_id); ?>">
                <?php echo e(str_limit($task->task_title ?? '---', 45)); ?></span>
            <!--recurring-->
            <?php if(auth()->user()->is_team && $task->task_recurring == 'yes'): ?>
            <span class="sl-icon-refresh text-danger p-l-5" data-toggle="tooltip"
                title="<?php echo app('translator')->get('lang.recurring_task'); ?>"></span>
            <?php endif; ?></a>
        <?php endif; ?>
    </td>
    <?php if(config('visibility.tasks_col_project')): ?>
    <td class="tasks_col_project">
        <span class="x-strike-through"><a title=""
                href="<?php echo e(url('/projects/'.$task->project_id)); ?>"><?php echo e(str_limit($task->project_title ?? '---', 18)); ?></a></span>
    </td>
    <?php endif; ?>
    <?php if(config('visibility.tasks_col_milestone')): ?>
    <td class="tasks_col_milestone">
        <span class="x-strike-through"><?php echo e(str_limit($task->milestone_title ?? '---', 12)); ?></span>
    </td>
    <?php endif; ?>
    <?php if(config('visibility.tasks_col_date')): ?>
    <td class="tasks_col_created"><?php echo e(runtimeDate($task->task_date_start)); ?></td>
    <?php endif; ?>
    <td class="tasks_col_deadline"><?php echo e(runtimeDate($task->task_date_due)); ?></td>

    <?php if(config('visibility.tasks_col_assigned')): ?>
    <td class="tasks_col_assigned" id="tasks_col_assigned_<?php echo e($task->task_id); ?>">
        <!--assigned users-->
        <?php if(count($task->assigned ?? []) > 0): ?>
        <?php $__currentLoopData = $task->assigned->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <img src="<?php echo e($user->avatar); ?>" data-toggle="tooltip" title="<?php echo e($user->first_name); ?>" data-placement="top"
            alt="<?php echo e($user->first_name); ?>" class="img-circle avatar-xsmall">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <span>---</span>
        <?php endif; ?>
        <!--assigned users-->
        <!--more users-->
        <?php if(count($task->assigned ?? []) > 2): ?>
        <?php $more_users_title = __('lang.assigned_users'); $users = $task->assigned; ?>
        <?php echo $__env->make('misc.more-users', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!--more users-->
    </td>
    <?php endif; ?>
    <?php if(config('visibility.tasks_col_all_time')): ?>
    <td class="tasks_col_all_time">
        <span class="x-timer-time"
            id="task_timer_all_table_<?php echo e($task->task_id); ?>"><?php echo e(runtimeSecondsHumanReadable($task->sum_all_time, true)); ?></span>
    </td>
    <?php endif; ?>
    <?php if(config('visibility.tasks_col_mytime')): ?>
    <td class="tasks_col_my_time">
        <?php if($task->assigned_to_me): ?>
        <span class="x-timer-time timers <?php echo e(runtimeTimerRunningStatus($task->timer_current_status)); ?>"
            id="task_timer_table_<?php echo e($task->task_id); ?>"><?php echo clean(runtimeSecondsHumanReadable($task->my_time, false)); ?></span>
        <?php if($task->task_status != 'completed'): ?>
        <!--start a timer-->
        <span
            class="x-timer-button js-timer-button js-ajax-request timer-start-button hidden <?php echo e(runtimeTimerVisibility($task->timer_current_status, 'stopped')); ?>"
            id="timer_button_start_table_<?php echo e($task->task_id); ?>" data-task-id="<?php echo e($task->task_id); ?>" data-location="table"
            data-url="<?php echo e(url('/')); ?>/tasks/timer/<?php echo e($task->task_id); ?>/start?source=list" data-form-id="tasks-list-table"
            data-type="form" data-progress-bar='hidden' data-ajax-type="POST">
            <span><i class="mdi mdi-play-circle"></i></span>
        </span>
        <!--stop a timer-->
        <span
            class="x-timer-button js-timer-button js-ajax-request timer-stop-button hidden <?php echo e(runtimeTimerVisibility($task->timer_current_status, 'running')); ?>"
            id="timer_button_stop_table_<?php echo e($task->task_id); ?>" data-task-id="<?php echo e($task->task_id); ?>" data-location="table"
            data-url="<?php echo e(url('/')); ?>/tasks/timer/<?php echo e($task->task_id); ?>/stop?source=list" data-form-id="tasks-list-table"
            data-type="form" data-progress-bar='hidden' data-ajax-type="POST">
            <span><i class="mdi mdi-stop-circle"></i></span>
        </span>
        <!--timer updating-->
        <input type="hidden" name="timers[<?php echo e($task->task_id); ?>]" value="">
        <?php endif; ?>
        <?php else: ?>
        <span>---</span>
        <?php endif; ?>
    </td>
    <?php endif; ?>
    <?php if(config('visibility.tasks_col_priority')): ?>
    <td class="tasks_col_priority">
        <span
            class="label <?php echo e(runtimeTaskPriorityColors($task->task_priority, 'label')); ?>"><?php echo e(runtimeLang($task->task_priority)); ?></span>
    </td>
    <?php endif; ?>
    <?php if(config('visibility.tasks_col_tags')): ?>
    <td class="tasks_col_tags">
        <!--tag-->
        <?php if(count($task->tags ?? []) > 0): ?>
        <?php $__currentLoopData = $task->tags->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="label label-outline-default"><?php echo e(str_limit($tag->tag_title, 15)); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <span>---</span>
        <?php endif; ?>
        <!--/#tag-->

        <!--more tags (greater than tags->take(x) number above -->
        <?php if(count($task->tags ?? []) > 1): ?>
        <?php $tags = $task->tags; ?>
        <?php echo $__env->make('misc.more-tags', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!--more tags-->
    </td>
    <?php endif; ?>
    <td class="tasks_col_status">
        <span class="label label-<?php echo e($task->taskstatus_color); ?>"><?php echo e(runtimeLang($task->taskstatus_title)); ?></span>
        <!--archived-->
        <?php if($task->task_active_state == 'archived' && runtimeArchivingOptions()): ?>
        <span class="label label-icons label-icons-default" data-toggle="tooltip" data-placement="top"
            title="<?php echo app('translator')->get('lang.archived'); ?>"><i class="ti-archive"></i></span>
        <?php endif; ?>
    </td>
    <td class="tasks_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">

            <!--[delete]-->
            <?php if($task->permission_delete_task): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/tasks/<?php echo e($task->task_id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php else: ?>
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled  <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i
                    class="sl-icon-trash"></i></span>
            <?php endif; ?>

            <!--view-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.view'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm show-modal-button reset-card-modal-form js-ajax-ux-request"
                data-toggle="modal" data-target="#cardModal" data-url="<?php echo e(urlResource('/tasks/'.$task->task_id)); ?>"
                data-loading-target="main-top-nav-bar">
                <i class="ti-new-window"></i>
            </button>
        </span>

        <!--more button (team)-->
        <?php if(auth()->user()->is_team && $task->permission_super_user): ?>
        <span class="list-table-action dropdown  font-size-inherit">
            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                title="<?php echo e(cleanLang(__('lang.more'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                <i class="ti-more"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">

                <!--clone task (team only)-->
                <?php if(auth()->user()->is_team && $task->permission_edit_task): ?>
                <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal" data-modal-title="<?php echo app('translator')->get('lang.clone_task'); ?>"
                    data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/clone')); ?>"
                    data-action-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/clone')); ?>" data-modal-size="modal-sm"
                    data-loading-target="commonModalBody" data-action-method="POST" aria-expanded="false">
                    <?php echo app('translator')->get('lang.clone_task'); ?>
                </a>
                <?php endif; ?>

                <!--record time-->
                <?php if($task->assigned_to_me): ?>
                <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.archive_task'))); ?>" data-toggle="modal"
                    data-target="#commonModal" data-modal-title="<?php echo app('translator')->get('lang.record_your_work_time'); ?>"
                    data-url="<?php echo e(url('/timesheets/create?task_id='.$task->task_id)); ?>"
                    data-action-url="<?php echo e(urlResource('/timesheets')); ?>" data-modal-size="modal-sm"
                    data-loading-target="commonModalBody" data-action-method="POST" aria-expanded="false">
                    <?php echo e(cleanLang(__('lang.record_time'))); ?>

                </a>
                <?php endif; ?>
                <!--stop all timers-->
                <a class="dropdown-item confirm-action-danger"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.stop_all_timers'))); ?>"
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
                    data-url="<?php echo e(url('/')); ?>/tasks/timer/<?php echo e($task->task_id); ?>/stopall?source=list">
                    <?php echo e(cleanLang(__('lang.stop_all_timers'))); ?>

                </a>

                <?php if(auth()->user()->is_team && $task->permission_edit_task): ?>
                <!--recurring settings-->
                <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                    data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/recurring-settings?source=list')); ?>"
                    data-loading-target="commonModalBody"
                    data-modal-title="<?php echo e(cleanLang(__('lang.recurring_settings'))); ?>"
                    data-action-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/recurring-settings?source=list')); ?>"
                    data-action-method="POST"
                    data-action-ajax-loading-target="tasks-td-container"><?php echo e(cleanLang(__('lang.recurring_settings'))); ?></a>
                <!--stop recurring -->
                <?php if($task->task_recurring == 'yes'): ?>
                <a class="dropdown-item confirm-action-info" href="javascript:void(0)"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.stop_recurring'))); ?>"
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                    data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/stop-recurring?source=list')); ?>">
                    <?php echo e(cleanLang(__('lang.stop_recurring'))); ?></a>
                <?php endif; ?>
                <?php endif; ?>

                <!--archive-->
                <?php if($task->task_active_state == 'active' && runtimeArchivingOptions()): ?>
                <a class="dropdown-item confirm-action-info"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.archive_task'))); ?>"
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
                    data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/archive')); ?>">
                    <?php echo e(cleanLang(__('lang.archive'))); ?>

                </a>
                <?php endif; ?>
                <!--activate-->
                <?php if($task->task_active_state == 'archived' && runtimeArchivingOptions()): ?>
                <a class="dropdown-item confirm-action-info"
                    data-confirm-title="<?php echo e(cleanLang(__('lang.restore_task'))); ?>"
                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
                    data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/activate')); ?>">
                    <?php echo e(cleanLang(__('lang.restore'))); ?>

                </a>
                <?php endif; ?>

            </div>
        </span>
        <?php endif; ?>
        <!--more button-->
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/tasks/components/table/ajax.blade.php ENDPATH**/ ?>