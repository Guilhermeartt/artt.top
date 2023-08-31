<!--no reminder-->
<div class="reminders-none-existing" id="reminders-none-existing">
    <div class="x-image">
        <img src="<?php echo e(url('/public/images/reminders_none.svg')); ?>" alt="404 - Not found" />
    </div>
    <div class="x-text">
        <?php echo app('translator')->get('lang.you_do_not_have_a_reminder_for_item'); ?>
    </div>
    <div class="x-button">
        <button type="button" class="btn btn-rounded-x btn-info btn-sm js-ajax-ux-request apply-filter-button"
            data-url="<?php echo e(url('reminders/new?resource_type='.$payload['resource_type'].'&resource_id='.$payload['resource_id'])); ?>"
            data-loading-target="reminders-side-panel-body"
            data-progress-bar='hidden'><?php echo e(cleanLang(__('lang.add_a_reminder'))); ?></button>
    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/reminders/misc/none-found.blade.php ENDPATH**/ ?>