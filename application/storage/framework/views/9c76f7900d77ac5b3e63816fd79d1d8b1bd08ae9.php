<div class="card count-<?php echo e(@count($tasks ?? [])); ?>" id="tasks-table-wrapper">
    <div class="card-body p-t-0">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($tasks ?? []) > 0): ?>
            <!--billing cycles information-->
            <div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span> </button>
                <div><i class="sl-icon-info text-info"></i> <?php echo e(cleanLang(__('lang.billable_hours_info'))); ?></div>
            </div>
            <table id="tasks-list-table" class="table m-t-0 m-b-0 table-hover no-wrap tasks-list" data-page-size="10">
                <thead>
                    <tr>
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes" id="fx-timebilling-task-list">
                                <input type="checkbox" id="listcheckbox-tasks" name="listcheckbox-tasks"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="tasks-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-tasks">
                                <label for="listcheckbox-tasks"></label>
                            </span>
                        </th>
                        <th class="tasks_col_title"><a class="js-ajax-ux-request js-list-sorting" id="sort_task_title"
                                href="javascript:void(0)"
                                data-url="<?php echo e(url('/invoices/timebilling/'.$project_id.'?grouping=tasks&action=sort&orderby=task_title&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.task'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="tasks_col_time">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_time" href="javascript:void(0)"
                                data-url="<?php echo e(url('/invoices/timebilling/'.$project_id.'?grouping=tasks&action=sort&orderby=time&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.billable_time'))); ?><span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                    </tr>
                </thead>
                <tbody id="tasks-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.bill.components.timebilling.tasks.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->
                </tbody>
            </table>
            <?php endif; ?> <?php if(@count($tasks ?? []) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/bill/components/timebilling/tasks/table.blade.php ENDPATH**/ ?>