<!--[icons] task dependency - lock icon (cannot be started)-->
<?php if($task->count_dependency_cannot_start > 0): ?>
<span class="x-icon text-warning p-l-3  display-inline-block font-14 vm " data-toggle="tooltip"  data-placement="top"
    title="<?php echo app('translator')->get('lang.task_dependency_info_cannot_be_started'); ?>"><i class="mdi mdi-lock"></i></span>
<?php endif; ?>

<!--[icons] task dependency - lock icon (cannot be completed)-->
<?php if($task->count_dependency_cannot_complete > 0): ?>
<span class="x-icon text-danger p-l-3  display-inline-block font-14 vm " data-toggle="tooltip"  data-placement="top"
    title="<?php echo app('translator')->get('lang.task_dependency_info_cannot_be_completed'); ?>"><i class="mdi mdi-lock"></i></span>
<?php endif; ?>

<!--[icons] task dependency - fullfilled-->
<?php if($task->count_dependency_cannot_start_fullfilled > 0 || $task->count_dependency_cannot_complete_fulfilled > 0): ?>
<span class="x-icon text-success p-l-3  display-inline-block font-14 vm " data-toggle="tooltip"  data-placement="top"
    title="<?php echo app('translator')->get('lang.dependecies_have_been_fulfilled'); ?>"><i class="mdi mdi-lock"></i></span>
<?php endif; ?>



<!--[icons] recurring-->
<?php if(auth()->user()->is_team && $task->task_recurring == 'yes'): ?>
<span class="sl-icon-refresh text-danger display-inline-block p-l-3 vm " data-toggle="tooltip"  data-placement="top" title="<?php echo app('translator')->get('lang.recurring_task'); ?>"></span>
<?php endif; ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/tasks/components/common/icons-1.blade.php ENDPATH**/ ?>