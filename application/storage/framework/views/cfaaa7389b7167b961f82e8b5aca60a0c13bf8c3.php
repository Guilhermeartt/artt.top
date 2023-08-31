<?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="webmail_template_<?php echo e($template->webmail_template_id); ?>">
    <td class="template_col_date">
        <?php echo e($template->webmail_template_name); ?>

    </td>
    <td class="template_col_name"><?php echo e(runtimeDate($template->webmail_template_created)); ?></td>
    <td class="template_col_created_by">
        <img src="<?php echo e(getUsersAvatar($template->avatar_directory, $template->avatar_filename)); ?>" alt="user"
            class="img-circle avatar-xsmall">
        <?php echo e($template->first_name); ?>

    </td>
    <td class="template_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--edit-->
            <button type="button"
                class="btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('settings/webmail/templates/'.$template->webmail_template_id.'/edit')); ?>" data-loading-target="commonModalBody"
                data-modal-title="<?php echo app('translator')->get('lang.edit'); ?>" 
                data-modal-size="modal-xl"
                data-action-url="<?php echo e(urlResource('settings/webmail/templates/'.$template->webmail_template_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="js-ajax-ux-request" data-action-ajax-loading-target="table-responsive">
                <i class="sl-icon-note"></i>
            </button>

            
            <!--delete-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(urlResource('settings/webmail/templates/'.$template->webmail_template_id)); ?>">
                <i class="sl-icon-trash"></i>
            </button>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/settings/sections/webmailtemplates/table/ajax.blade.php ENDPATH**/ ?>