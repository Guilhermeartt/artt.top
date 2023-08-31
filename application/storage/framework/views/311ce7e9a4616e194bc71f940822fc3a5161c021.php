<div class="card-title m-b-0">
    <span id="<?php echo e(runtimePermissions('task-edit-title', $task->permission_edit_task)); ?>"> <?php echo e($task->task_title); ?>

    </span>
</div>
<!--buttons: edit-->
<?php if($task->permission_edit_task): ?>
<div id="card-title-edit" class="card-title-edit hidden">
    <input type="text" class="form-control form-control-sm card-title-input" id="task_title" name="task_title">
    <!--button: subit & cancel-->
    <div id="card-title-submit" class="p-t-10 text-right">
        <button type="button" class="btn waves-effect waves-light btn-xs btn-default"
            id="card-title-button-cancel"><?php echo e(cleanLang(__('lang.cancel'))); ?></button>
        <button type="button" class="btn waves-effect waves-light btn-xs btn-danger"
            data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/update-title')); ?>" data-progress-bar='hidden'
            data-type="form" data-form-id="card-title-edit" data-ajax-type="post"
            id="card-title-button-save"><?php echo e(cleanLang(__('lang.save'))); ?></button>
    </div>
</div>
<?php endif; ?>
<div class=""><small><strong><?php echo app('translator')->get('lang.project'); ?>: </strong></small><small id="card-task-milestone-title"><a
            href="<?php echo e(url('projects/'.$task->project_id ?? '')); ?>"><?php echo e($task->project_title ?? '---'); ?></a></small></div>
<div class="m-b-15"><small><strong><?php echo app('translator')->get('lang.milestone'); ?>: </strong></small><small
        id="card-task-milestone-title"><?php echo e(runtimeLang($task->milestone_title, 'task_milestone')); ?></small></div>

<!--this item is archived notice-->
<?php if(runtimeArchivingOptions()): ?>
<div id="card_archived_notice_<?php echo e($task->task_id); ?>"
    class="alert alert-warning p-t-7 p-b-7 <?php echo e(runtimeActivateOrAchive('archived-notice', $task->task_active_state)); ?>">
    <i class="mdi mdi-archive"></i> <?php echo app('translator')->get('lang.this_task_is_archived'); ?>
</div>
<?php endif; ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/task/components/title.blade.php ENDPATH**/ ?>