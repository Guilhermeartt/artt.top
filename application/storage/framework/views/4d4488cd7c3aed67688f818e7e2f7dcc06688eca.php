<?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="task_<?php echo e($task->task_id); ?>">
    <td class="tasks_col_checkbox checkitem" id="tasks_col_checkbox_<?php echo e($task->task_id); ?>">
        <!--list checkbox-->
        <span class="list-checkboxes" id="fx-timebilling-list">
            <input type="checkbox" id="listcheckbox-tasks-<?php echo e($task->task_id); ?>" name="ids[<?php echo e($task->task_id); ?>]"
                class="listcheckbox listcheckbox-tasks filled-in chk-col-light-blue tasks-checkbox"
                data-actions-container-class="tasks-checkbox-actions-container" 
                data-task-id="<?php echo e($task->task_id); ?>"
                data-timers-list="<?php echo e($task->timer_ids); ?>"
                data-project-id="<?php echo e($task->task_projectid); ?>"
                data-description="<?php echo e($task->task_title); ?>"
                data-hours="<?php echo e($task->hours); ?>"
                data-minutes="<?php echo e($task->minutes); ?>"
                data-total="<?php echo e($task->total); ?>"
                data-rate="<?php echo e($billing_rate); ?>"
                data-unit="<?php echo e(cleanLang(__('lang.time'))); ?>"
                data-linked-type="timer"
                data-linked-id="<?php echo e($task->task_id); ?>">
            <label for="listcheckbox-tasks-<?php echo e($task->task_id); ?>"></label>
        </span>
    </td>
    <td class="tasks_col_title">
        <?php echo e($task->task_title); ?>

    </td>
    <td class="tasks_col_time">
        <?php if(runtimeSecondsWholeHours($task->time) > 0): ?>
        <?php echo e(runtimeSecondsWholeHours($task->time)); ?> Hrs 
        <?php endif; ?>        
        <?php echo e(runtimeSecondsWholeMinutes($task->time)); ?> Mins 
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/bill/components/timebilling/tasks/ajax.blade.php ENDPATH**/ ?>