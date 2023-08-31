<?php $__currentLoopData = $board['tasks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each card-->
<div class="kanban-card kanban-board-element show-modal-button reset-card-modal-form js-ajax-ux-request"
    data-toggle="modal" data-target="#cardModal" data-url="<?php echo e(urlResource('/tasks/'.$task->task_id)); ?>"
    data-task-id="<?php echo e($task->task_id); ?>" data-loading-target="main-top-nav-bar" id="card_task_<?php echo e($task->task_id); ?>">
    <div class="x-title wordwrap" id="kanban_task_title_<?php echo e($task->task_id); ?>"><?php echo e($task->task_title); ?>

        <span class="x-action-button" id="card-action-button-<?php echo e($task->task_id); ?>" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></span>
        <div class="dropdown-menu dropdown-menu-small dropdown-menu-right js-stop-propagation"
            aria-labelledby="card-action-button-<?php echo e($task->task_id); ?>">
            <?php $count_actions = 0 ; ?>
            <!--delete-->
            <?php if($task->permission_delete_task): ?>
            <a class="dropdown-item confirm-action-danger  js-stop-propagation"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/tasks/<?php echo e($task->task_id); ?>"><?php echo e(cleanLang(__('lang.delete'))); ?></a>
            <?php $count_actions ++ ; ?>
            <?php endif; ?>

            <!--clone task (team only)-->
            <?php if(auth()->user()->is_team && $task->permission_edit_task): ?>
            <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-modal-title="<?php echo app('translator')->get('lang.clone_task'); ?>"
                data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/clone')); ?>"
                data-action-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/clone')); ?>" data-modal-size="modal-lg"
                data-loading-target="commonModalBody" data-action-method="POST" aria-expanded="false">
                <?php echo app('translator')->get('lang.clone_task'); ?>
            </a>
            <?php $count_actions ++ ; ?>
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
            <?php $count_actions ++ ; ?>
            <?php endif; ?>

            <!--stop my timer-->
            <?php if($task->timer_current_status): ?>
            <a class="dropdown-item confirm-action-danger js-stop-propagation"
                data-confirm-title="<?php echo e(cleanLang(__('lang.stop_my_timer'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="GET"
                data-url="<?php echo e(url('/')); ?>/tasks/timer/<?php echo e($task->task_id); ?>/stop"><?php echo e(cleanLang(__('lang.stop_my_timer'))); ?></a>
            <?php $count_actions ++ ; ?>
            <?php endif; ?>
            <!--stop all timers-->
            <?php if(auth()->user()->is_team && $task->permission_super_user): ?>
            <a class="dropdown-item confirm-action-danger js-stop-propagation"
                data-confirm-title="<?php echo e(cleanLang(__('lang.stop_all_timers'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="GET"
                data-url="<?php echo e(url('/')); ?>/tasks/timer/<?php echo e($task->task_id); ?>/stopall?source=list"><?php echo e(cleanLang(__('lang.stop_all_timers'))); ?></a>
            <?php $count_actions ++ ; ?>
            <?php endif; ?>


            <?php if(auth()->user()->is_team && $task->permission_edit_task): ?>
            <!--recurring settings-->
            <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                href="javascript:void(0)" data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/recurring-settings?source=list')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.recurring_settings'))); ?>"
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
            <?php if($task->permission_super_user && runtimeArchivingOptions()): ?>
            <a class="dropdown-item confirm-action-info <?php echo e(runtimeActivateOrAchive('archive-button', $task->task_active_state)); ?> card_archive_button_<?php echo e($task->task_id); ?>"
                id="card_archive_button_<?php echo e($task->task_id); ?>"
                data-confirm-title="<?php echo e(cleanLang(__('lang.archive_task'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
                data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/archive')); ?>">
                <?php echo e(cleanLang(__('lang.archive'))); ?>

            </a>
            <?php $count_actions ++ ; ?>
            <?php endif; ?>

            <!--activate-->
            <?php if($task->permission_super_user && runtimeArchivingOptions()): ?>
            <a class="dropdown-item confirm-action-info <?php echo e(runtimeActivateOrAchive('activate-button', $task->task_active_state)); ?> card_restore_button_<?php echo e($task->task_id); ?>"
                id="card_restore_button_<?php echo e($task->task_id); ?>"
                data-confirm-title="<?php echo e(cleanLang(__('lang.restore_task'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"
                data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/activate')); ?>">
                <?php echo e(cleanLang(__('lang.restore'))); ?>

            </a>
            <?php $count_actions ++ ; ?>
            <?php endif; ?>

            <!--no actions-->
            <?php if($count_actions == 0): ?>
            <a class="dropdown-item js-stop-propagation"
                href="javascript:void(0);"><?php echo e(cleanLang(__('lang.no_actions_available'))); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="x-meta">
        <!--priority-->
        <?php if(config('system.settings_tasks_kanban_priority') == 'show'): ?>
        <label class="label <?php echo e(runtimeTaskPriorityColors($task->task_priority, 'label')); ?> p-t-3 p-b-3 p-l-8 p-r-8"
            data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.priority'))); ?>"><?php echo e(runtimeLang($task->task_priority)); ?></label>
        <?php endif; ?>
        <!--tags-->
        <?php if(config('system.settings_tasks_kanban_tags') == 'show'): ?>
        <div class="wrap-words">
            <?php $__currentLoopData = $task->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task_tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="label label-light-primary p-t-3 p-b-3 p-r-8 p-l-8"><?php echo e($task_tag->tag_title); ?></label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
        <!--project-->
        <?php if(config('system.settings_tasks_kanban_project_title') == 'show'): ?>
        <span title="<?php echo e($task->project_title ?? '---'); ?>"><strong><?php echo e(cleanLang(__('lang.project'))); ?>:</strong>
            <?php echo e(str_limit($task->project_title ??'---', 68)); ?></span>
        <?php endif; ?>
        <!--client-->
        <?php if(config('system.settings_tasks_kanban_client_name') == 'show'): ?>
        <span title="<?php echo e($task->client_company_name ?? '---'); ?>"><strong><?php echo e(cleanLang(__('lang.client'))); ?>:</strong>
            <?php echo e(str_limit($task->client_company_name ??'---', 68)); ?></span>
        <?php endif; ?>
        <!--date created-->
        <?php if(config('system.settings_tasks_kanban_date_created') == 'show'): ?>
        <span><strong><?php echo e(cleanLang(__('lang.created'))); ?>:</strong> <?php echo e(runtimeDate($task->task_created)); ?></span>
        <?php endif; ?>
        <!--start date-->
        <?php if(config('system.settings_tasks_kanban_date_start') == 'show'): ?>
        <span><strong><?php echo e(cleanLang(__('lang.start_date'))); ?>:</strong>: <?php echo e(runtimeDate($task->task_date_start)); ?></span>
        <?php endif; ?>
        <!--due date-->
        <?php if(config('system.settings_tasks_kanban_date_due') == 'show'): ?>
        <span><strong><?php echo e(cleanLang(__('lang.due'))); ?>:</strong>: <?php echo e(runtimeDate($task->task_date_due)); ?></span>
        <?php endif; ?>

        <!--show enabled custom fields-->
        <?php if(isset($task->fields)): ?>
        <?php $__currentLoopData = $task->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($field->customfields_show_task_summary == 'yes'): ?>
        <span><strong><?php echo e($field->customfields_title); ?>:</strong>:
            <?php echo e(strip_tags(customFieldValue($field->customfields_name, $task, $field->customfields_datatype))); ?></span>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <!--reminder-->
        <?php if(config('system.settings_tasks_kanban_reminder') == 'show'): ?>
        <div class="wrap-words" id="reminder_card_view_container_<?php echo e($task->task_id ?? ''); ?>">
            <?php $__currentLoopData = $task->reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--only show current users reminders-->
            <?php if($reminder->reminder_userid == auth()->user()->id): ?>
            <?php echo $__env->make('pages.reminders.cards.kanban', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

    </div>
    <div class="x-footer row">
        <div class="col-6 x-icons">

            <!--various icons displayed next to title-->
            <?php echo $__env->make('pages.tasks.components.common.icons-1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!--[icon] created by you-->
            <?php if($task->task_creatorid == auth()->user()->id): ?>
            <span class="x-icon text-info display-inline-block vm p-t-2" data-toggle="tooltip"
                title="<?php echo app('translator')->get('lang.you_created_this_task'); ?>" data-placement="top"><i
                    class="mdi mdi-account-circle"></i></span>
            <?php endif; ?>

            <!--[icon] archived-->
            <?php if(runtimeArchivingOptions()): ?>
            <span class="x-icon <?php echo e(runtimeActivateOrAchive('archived-icon', $task->task_active_state)); ?>"
                id="archived_icon_<?php echo e($task->task_id); ?>" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.archived'); ?>"><i
                    class="ti-archive font-15"></i></span>
            <?php endif; ?>


            <!--[icon] client visibility-->
            <?php if(config('system.settings_tasks_kanban_client_visibility') == 'show' && auth()->user()->is_team): ?>
            <?php if($task->task_client_visibility == 'no'): ?>
            <span class="x-icon display-inline-block vm " data-toggle="tooltip"
                title="<?php echo e(cleanLang(__('lang.client'))); ?> - <?php echo e(cleanLang(__('lang.hidden'))); ?>" data-placement="top"><i
                    class="mdi mdi-eye-outline-off"></i></span>
            <?php endif; ?>
            <?php endif; ?>

            <!--[icon] attachments-->
            <?php if($task->has_attachments): ?>
            <span class="x-icon display-inline-block vm "><i class="mdi mdi-attachment"></i>
                <?php if($task->count_unread_attachments > 0): ?>
                <span class="x-notification" id="card_notification_attachment_<?php echo e($task->task_id); ?>"></span>
                <?php endif; ?>
            </span>
            <?php endif; ?>

            <!--[icon] comments-->
            <?php if($task->has_comments): ?>
            <span class="x-icon display-inline-block vm p-t-3"><i class="mdi mdi-comment-text-outline"></i>
                <?php if($task->count_unread_comments > 0): ?>
                <span class="x-notification" id="card_notification_comment_<?php echo e($task->task_id); ?>"></span>
                <?php endif; ?>
            </span>
            <?php endif; ?>

            <!--timer running-->
            <span class="x-icon text-danger <?php echo e(runtimeCardMyRunningTimer($task->timer_current_status)); ?>"
                id="card-task-timer-<?php echo e($task->task_id); ?>"><i class="mdi mdi-timer"></i></span>

        </div>
        <div class="col-6 x-assigned">
            <?php $__currentLoopData = $task->assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img src="<?php echo e(getUsersAvatar($user->avatar_directory, $user->avatar_filename)); ?>" data-toggle="tooltip"
                title="" data-placement="top" alt="<?php echo e($user->first_name); ?>" class="img-circle avatar-xsmall"
                data-original-title="<?php echo e($user->first_name); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/tasks/components/kanban/card.blade.php ENDPATH**/ ?>