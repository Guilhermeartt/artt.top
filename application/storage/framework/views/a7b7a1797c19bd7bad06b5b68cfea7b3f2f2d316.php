<div class="x-heading"><?php echo app('translator')->get('lang.active_timer'); ?></div>
<div class="x-task">
    <a
        href="<?php echo e(urlResource('/tasks/v/'.request('users_running_timer_task_id').'/'.str_slug(request('users_running_timer_task_title')))); ?>">
        <?php echo e(str_limit(request('users_running_timer_title'), 100)); ?></a>
    <!--polling trigger-->
    <?php if(Auth::user() && auth()->user()->is_team && env('APP_DEBUG_TOOLBAR') === false): ?>
    <span class="hidden" id="js-trigger-topnav-timer" data-progress-bar='hidden'
        data-notifications="disabled" data-skip-checkboxes-reset="TRUE"
        data-url="<?php echo e(url('/polling/timer')); ?>"></span>
    <?php endif; ?>
</div>
<div class="x-button">
    <!--stoptimer-->
    <button type="button" id="my-timer-time-topnav-stop-button"
        class="btn waves-effect waves-light btn-sm btn-danger js-timer-button js-ajax-request"
        data-url="<?php echo e(url('tasks/timer/'.request('users_running_timer_task_id').'/stop?source=topnav')); ?>"
        data-form-id="tasks-list-table"
        data-progress-bar='hidden'><?php echo app('translator')->get('lang.stop_timer'); ?></button>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/misc/timer-topnav-details.blade.php ENDPATH**/ ?>