<div class="card-description" id="card-description">
    <div class="x-heading"><i class="mdi mdi-file-document-box"></i><?php echo e(cleanLang(__('lang.description'))); ?></div>
    <div class="x-content rich-text-formatting" id="card-description-container">
        <?php echo clean($task->task_description); ?>

    </div>
    <?php if($task->permission_edit_task): ?>
    <!--buttons: edit-->
    <div id="card-description-edit">
        <div class="x-action" id="card-description-button-edit"><a href="javaScript:void(0);"><?php echo e(cleanLang(__('lang.edit_description'))); ?></a>
        </div>
        <input type="hidden" name="task_description" id="card-description-input" value="">
    </div>
    <!--button: subit & cancel-->
    <div id="card-description-submit" class="p-t-10 hidden text-right">
        <button type="button" class="btn waves-effect waves-light btn-xs btn-default"
            id="card-description-button-cancel"><?php echo e(cleanLang(__('lang.cancel'))); ?></button>
        <button type="button" class="btn waves-effect waves-light btn-xs btn-danger js-description-save"
            data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/update-description')); ?>" data-progress-bar='hidden'
            data-type="form" data-form-id="card-description" data-ajax-type="post"
            id="card-description-button-save"><?php echo e(cleanLang(__('lang.save'))); ?></button>
    </div>
    <?php endif; ?>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/task/components/description.blade.php ENDPATH**/ ?>