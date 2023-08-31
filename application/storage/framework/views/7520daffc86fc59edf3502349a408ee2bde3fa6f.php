<?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="status_<?php echo e($status->ticketstatus_id); ?>">
    <td class="status_col_date">
        <span class="mdi mdi-drag-vertical cursor-pointer"></span>
        <!--sorting data-->
        <input type="hidden" name="sort-stages[<?php echo e($status->ticketstatus_id); ?>]" value="<?php echo e($status->ticketstatus_id); ?>">
        <?php echo e(runtimeLang($status->ticketstatus_title)); ?>


        <!--ticketstatus_use_for_team_replied-->
        <?php if($status->ticketstatus_use_for_team_replied == 'yes'): ?>
        <span class="sl-icon-action-redo text-info p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.tickets_apply_when_staff_replied'))); ?>"></span>
        <?php endif; ?>

        <!--ticketstatus_use_for_client_replied-->
        <?php if($status->ticketstatus_use_for_client_replied == 'yes'): ?>
        <span class="sl-icon-action-undo text-purple p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.tickets_apply_when_customer_replied'))); ?>"></span>
        <?php endif; ?>

        <!--system initial stage-->
        <?php if($status->ticketstatus_system_default == 'yes' && $status->ticketstatus_id == 1): ?>
        <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.required_system_status'))); ?>"></span>
        <span class="label label-light-info label-rounded"><?php echo e(cleanLang(__('lang.new_status'))); ?></span>

        <?php endif; ?>
        <!--system initial stage-->
        <?php if($status->ticketstatus_system_default == 'yes' && $status->ticketstatus_id == 2): ?>
        <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.required_system_status'))); ?>"></span>
        <span class="label label-light-info label-rounded"><?php echo e(cleanLang(__('lang.closed_status'))); ?></span>
        <?php endif; ?>

    </td>
    <td class="status_col_count"><?php echo e($status->count_tickets); ?></td>
    <td class="status_col_color"><span class="bg-<?php echo e($status->ticketstatus_color); ?>"
            id="fx-settimgs-tickets-status">&nbsp;</span>
    </td>
    <td class="status_col_created_by">
        <img src="<?php echo e(getUsersAvatar($status->avatar_directory, $status->avatar_filename, $status->ticketstatus_creatorid)); ?>"
            alt="user" class="img-circle avatar-xsmall">
        <?php echo e(checkUsersName($status->first_name, $status->ticketstatus_creatorid)); ?>

    </td>
    <td class="status_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                data-url="<?php echo e(url('/settings/tickets/statuses/'.$status->ticketstatus_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_ticket_status'))); ?>"
                data-action-url="<?php echo e(url('/settings/tickets/statuses/'.$status->ticketstatus_id)); ?>"
                data-action-method="PUT" data-action-ajax-class=""
                data-action-ajax-loading-target="status-td-container">
                <i class="sl-icon-note"></i>
            </button>
            <button type="button" title="<?php echo e(cleanLang(__('lang.move'))); ?>"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-warning btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" title="<?php echo e(cleanLang(__('lang.move'))); ?>"
                data-url="<?php echo e(url('/settings/tickets/move/'.$status->ticketstatus_id)); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.move_tickets'); ?>"
                data-action-url="<?php echo e(url('/settings/tickets/move/'.$status->ticketstatus_id)); ?>" data-action-method="PUT"
                data-action-ajax-class="js-ajax-ux-request" data-action-ajax-loading-target="commonModalBody">
                <i class="sl-icon-share-alt"></i>
            </button>


            <button type="button" title="<?php echo e(cleanLang(__('lang.settings'))); ?>"
                class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" title="<?php echo e(cleanLang(__('lang.move'))); ?>"
                data-url="<?php echo e(url('/settings/tickets/statuses/'.$status->ticketstatus_id.'/settings/')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.settings'); ?>"
                data-action-url="<?php echo e(url('/settings/tickets/statuses/'.$status->ticketstatus_id.'/settings/')); ?>"
                data-action-method="PUT" data-action-ajax-class="js-ajax-ux-request"
                data-action-ajax-loading-target="commonModalBody">
                <i class="sl-icon-wrench"></i>
            </button>

            <?php if($status->ticketstatus_system_default == 'no'): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_ticket_status'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/')); ?>/settings/tickets/statuses/<?php echo e($status->ticketstatus_id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php else: ?>
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled <?php echo e(runtimePlaceholdeActionsButtons()); ?>"
                data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>"><i
                    class="sl-icon-trash"></i></span>
            <?php endif; ?>

        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/settings/sections/tickets/table/ajax.blade.php ENDPATH**/ ?>