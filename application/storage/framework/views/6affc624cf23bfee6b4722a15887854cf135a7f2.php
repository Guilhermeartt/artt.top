<?php $__currentLoopData = $dependecies_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dependency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each dependency-->
<div id="task_dependency_task_<?php echo e($dependency->tasksdependency_id); ?>"
    class="task-dependency-task <?php echo e(runtimeTaskDependencyColors($dependency->tasksdependency_type,  $dependency->tasksdependency_status)); ?>">
    <span><a href="<?php echo e(url('/tasks/v/'.$dependency->task_id)); ?>" target="_blank"><?php echo e($dependency->task_title); ?></a></span>

    <!--delete dependency-->
    <?php if(config('permission.manage_dependency')): ?>
    <span class="task-dependency-delete-button ajax-request" id="task-dependency-delete-button" data-parent="task_dependency_task_<?php echo e($dependency->tasksdependency_id); ?>"
        data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/delete-dependency?dependency_id='.$dependency->tasksdependency_id)); ?>" data-ajax-type="DELETE"
        data-progress-bar="hidden">
        <i class="sl-icon-close"></i>
    </span>
    <?php endif; ?>

    <!--dependency fullfilled-->
    <?php if($dependency->tasksdependency_status == 'fulfilled'): ?>
    <span class="task-dependency-fulfilled-icon">
        <i class="mdi mdi-checkbox-marked-circle"></i>
    </span>
    <?php endif; ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!--info panel-->
<?php if(count($dependecies_all ?? []) > 0): ?>
<div class="p-l-1">
    <span class="bg-danger task-dependency-tooltip" data-toggle="tooltip" data-placement="top"
        title="<?php echo app('translator')->get('lang.dependency_prevents_task_from_completing'); ?>">
    </span>
    <span class="bg-warning task-dependency-tooltip" data-toggle="tooltip" data-placement="top"
        title="<?php echo app('translator')->get('lang.dependency_prevents_task_from_starting'); ?>">
    </span>
    <span class="bg-success task-dependency-tooltip" data-toggle="tooltip" data-placement="top"
        title="<?php echo app('translator')->get('lang.dependency_has_been_fulfilled'); ?>">
    </span>
</div>
<?php endif; ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/task/dependency/ajax.blade.php ENDPATH**/ ?>