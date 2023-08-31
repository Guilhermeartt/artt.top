<!--heading-->
<div class="x-heading"><i class="mdi mdi-file-document-box"></i><?php echo e(cleanLang(__('lang.custom_fields'))); ?></div>

<!--Form Data-->
<?php if(count($fields ?? []) > 0): ?>
<div class="card-show-form-data " id="card-task-organisation">

    <!--render the form-->
    <?php echo $__env->make('misc.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="form-group text-right">
        <button type="button" class="btn waves-effect waves-light btn-xs btn-default ajax-request"
        data-url="<?php echo e(url('tasks/content/'.$task->task_id.'/show-customfields')); ?>"
        data-loading-class="loading-before-centre" data-loading-target="card-tasks-left-panel"><?php echo app('translator')->get('lang.cancel'); ?></button>
        <button type="button" class="btn btn-danger btn-xs ajax-request"
            data-loading-target="card-tasks-left-panel"
            data-loading-class="loading-before-centre"
            data-url="<?php echo e(url('/tasks/content/'.$task->task_id.'/edit-customfields')); ?>" data-type="form" data-ajax-type="post"
            data-form-id="card-task-organisation">
            <?php echo e(cleanLang(__('lang.update'))); ?>

        </button>
    </div>
</div>
<?php else: ?>

nothng here

<?php endif; ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/task/content/customfields/edit.blade.php ENDPATH**/ ?>