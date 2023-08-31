<?php $__currentLoopData = $timesheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="timesheet_<?php echo e($timesheet->timer_id); ?>">
    <?php if(config('visibility.timesheets_col_checkboxes')): ?>
    <td class="timesheets_col_checkbox checkitem" id="timesheets_col_checkbox_<?php echo e($timesheet->timer_id); ?>">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-timesheets-<?php echo e($timesheet->timer_id); ?>"
                name="ids[<?php echo e($timesheet->timer_id); ?>]"
                class="listcheckbox listcheckbox-timesheets filled-in chk-col-light-blue"
                data-actions-container-class="timesheets-checkbox-actions-container"
                <?php echo e(runtimeDisabledTimesheetsCheckboxes(config('visibility.timesheets_disable_actions'))); ?>

                <?php if($timesheet->timer_billing_status == 'invoiced'): ?> disabled <?php endif; ?>>
            <label for="listcheckbox-timesheets-<?php echo e($timesheet->timer_id); ?>"></label>
        </span>
    </td>
    <?php endif; ?>
    <td class="timesheets_col_user">

        <?php if(config('visibility.timesheets_grouped_by_users')): ?>
        <span class="sl-icon-people"></span> <?php echo e(cleanLang(__('lang.multiple'))); ?>

        <?php else: ?>
        <img src="<?php echo e(getUsersAvatar($timesheet->avatar_directory, $timesheet->avatar_filename)); ?>" alt="user"
            class="img-circle avatar-xsmall"> <?php echo e(str_limit($timesheet->first_name ?? runtimeUnkownUser(), 10)); ?>

        <?php endif; ?>

    </td>
    <td class="timesheets_col_task">
        <a class="show-modal-button reset-card-modal-form js-ajax-ux-request" href="javascript:void(0)"
            data-toggle="modal" data-target="#cardModal"
            data-url="<?php echo e(urlResource('/tasks/'.$timesheet->timer_taskid)); ?>"
            data-loading-target="main-top-nav-bar"><?php echo e(str_limit($timesheet->task_title ?? '---', 25)); ?></a>
    </td>
    <?php if(config('visibility.timesheets_col_related')): ?>
    <td class="timesheets_col_related">
        <?php if($timesheet->timer_projectid > 0): ?>
        <a
            href="/projects/<?php echo e($timesheet->timer_projectid); ?>"><?php echo e(str_limit($timesheet->project_title ?? '---', 25)); ?></a>
        <?php else: ?>
        <a href="/leads/<?php echo e($timesheet->timer_leadid); ?>"><?php echo e(str_limit($timesheet->lead_title ?? '---', 25)); ?></a>
        <?php endif; ?>
    </td>
    <?php endif; ?>

    <!--date-->
    <td class="timesheets_col_start_time"><?php echo e(runtimeDate($timesheet->timer_created)); ?></td>

    <!--billing status-->
    <td class="timesheets_col_billing_status">
        <?php if(request('filter_grouping') == 'none' || !request()->filled('filter_grouping')): ?>
        <?php if($timesheet->timer_billing_status == 'invoiced'): ?>
        <span class="label label-outline-info"><?php echo e(cleanLang(__('lang.invoiced'))); ?></span>
        <?php else: ?>
        <span class="label label-outline-default"><?php echo e(cleanLang(__('lang.not_invoiced'))); ?></span>
        <?php endif; ?>
        <?php else: ?>
        ---
        <?php endif; ?>
    </td>

    <td class="timesheets_col_time"><?php echo clean(runtimeSecondsHumanReadable($timesheet->time, true)); ?></td>
    <?php if(config('visibility.timesheets_col_action')): ?>
    <td class="timesheets_col_action">
        <span class="list-table-action dropdown  font-size-inherit">
        <?php if(config('visibility.timesheets_disable_actions')): ?>
            <span data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.actions_not_available'))); ?>">---</span>
        <?php else: ?>
        <?php if(config('visibility.action_buttons_delete')): ?>
        <?php if($timesheet->timer_billing_status == 'invoiced'): ?>
        <span class="btn btn-outline-default btn-circle btn-sm disabled" data-toggle="tooltip"
            title="<?php echo e(cleanLang(__('lang.item_is_attached_to_invoice_cannot_be_edited'))); ?>"><i
                class="sl-icon-trash"></i></span>
        <?php else: ?>
        <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
            class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
            data-url="<?php echo e(url('/')); ?>/timesheets/<?php echo e($timesheet->timer_id); ?>">
            <i class="sl-icon-trash"></i>
        </button>
        <?php if(config('visibility.action_buttons_edit')): ?>
        <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
            class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#commonModal"
            data-url="<?php echo e(urlResource('/timesheets/'.$timesheet->timer_id.'/edit')); ?>" data-loading-target="commonModalBody"
            data-modal-title="<?php echo e(cleanLang(__('lang.edit_timesheet'))); ?>"
            data-action-url="<?php echo e(url('/timesheets/'.$timesheet->timer_id.'?source=list')); ?>" data-action-method="PUT"
            data-action-ajax-class="js-ajax-request" data-action-ajax-loading-target="timesheets-td-container">
            <i class="sl-icon-note"></i>
        </button>
        <?php endif; ?>
        <?php endif; ?>
        <?php if($timesheet->timer_billing_status == 'invoiced'): ?>
        <a href="<?php echo e(url('/invoices/'.$timesheet->timer_billing_invoiceid)); ?>" title="<?php echo e(cleanLang(__('lang.view'))); ?>"
            class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
            <i class="ti-new-window"></i>
        </a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        </span>
    </td>
    <?php endif; ?>
</tr>
<!--each row-->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/timesheets/components/table/ajax.blade.php ENDPATH**/ ?>