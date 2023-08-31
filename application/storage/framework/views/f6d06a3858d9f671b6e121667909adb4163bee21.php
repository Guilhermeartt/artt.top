<div class="row">
    <div class="col-lg-12">

        <!--repeat period-->
        <div class="form-group row">
            <label for="example-month-input"
                class="col-sm-12 col-lg-4 col-form-label text-left"><?php echo e(cleanLang(__('lang.repeat_every'))); ?></label>

            <div class="col-sm-12 col-lg-3">
                <input type="number" class="form-control form-control-sm" id="task_recurring_duration"
                    name="task_recurring_duration" value="<?php echo e($task->task_recurring_duration ?? 1); ?>">
            </div>
            <div class="col-5">
                <select class="select2-basic form-control form-control-sm" id="task_recurring_period"
                    name="task_recurring_period">
                    <option value="month" <?php echo e(runtimePreselected($task->task_recurring_period ?? '', 'month')); ?>>
                        <?php echo e(cleanLang(__('lang.month_months'))); ?></option>
                    <option value="day" <?php echo e(runtimePreselected($task->task_recurring_period ?? '', 'day')); ?>>
                        <?php echo e(cleanLang(__('lang.days'))); ?>

                    </option>
                    <option value="week" <?php echo e(runtimePreselected($task->task_recurring_period ?? '', 'week')); ?>>
                        <?php echo e(cleanLang(__('lang.week_weeks'))); ?></option>
                    <option value="year" <?php echo e(runtimePreselected($task->task_recurring_period ?? '', 'year')); ?>>
                        <?php echo e(cleanLang(__('lang.year_years'))); ?></option>
                </select>
            </div>

        </div>


        <!--repeat cycle-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-4 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.cycles'))); ?></label>
            <div class="col-sm-12 col-lg-3">
                <input type="number" class="form-control form-control-sm" id="task_recurring_cycles"
                    name="task_recurring_cycles" value="<?php echo e($task->task_recurring_cycles ?? 0); ?>">
            </div>
            <div class="col-sm-12 col-lg-3">
                <!--info tooltip-->
                <div class="fx-info-tool-tip">
                    <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                        title="<?php echo e(cleanLang(__('lang.task_recurring_period_info'))); ?>" data-placement="top"><i
                            class="ti-info-alt"></i></span>
                </div>
            </div>
        </div>

        <!--next cycle date-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-4 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.first_task_date'))); ?></label>
            <div class="col-sm-12 col-lg-3">
                <?php if(isset($task['task_recurring']) && $task['task_recurring'] == 'yes'): ?>
                <input type="text" class="form-control form-control-sm pickadate" name="task_recurring_next"
                    autocomplete="off" value="<?php echo e(runtimeDatepickerDate($task->task_recurring_next ?? '')); ?>">
                <input class="mysql-date" type="hidden" name="task_recurring_next" id="task_recurring_next"
                    value="<?php echo e($task->task_recurring_next ?? ''); ?>">
                <?php else: ?>
                <input type="text" class="form-control form-control-sm pickadate" name="task_recurring_next"
                    autocomplete="off" value="">
                <input class="mysql-date" type="hidden" name="task_recurring_next" id="task_recurring_next" value="">
                <?php endif; ?>
            </div>
            <div class="col-sm-12 col-lg-3">
                <!--info tooltip-->
                <div class="fx-info-tool-tip">
                    <span class="align-middle text-themecontrast font-16" data-toggle="tooltip"
                        title="<?php echo e(cleanLang(__('lang.task_recurring_cycles_explanation'))); ?>" data-placement="top"><i
                            class="ti-info-alt"></i></span>
                </div>
            </div>
        </div>

        <div class="line"></div>

        <!--copy checklists-->
        <div class="form-group form-group-checkbox row">
            <label class="col-4 col-form-label text-left"><?php echo app('translator')->get('lang.copy_checklists'); ?></label>
            <div class="col-8 text-left p-t-5">
                <input type="checkbox" id="task_recurring_copy_checklists" name="task_recurring_copy_checklists"
                    class="filled-in chk-col-light-blue"
                    <?php echo e(runtimePreChecked2($task->task_recurring_copy_checklists ?? 'yes', 'yes')); ?>>
                <label class="p-l-30" for="task_recurring_copy_checklists"></label>
            </div>
        </div>


        <!--copy files-->
        <div class="form-group form-group-checkbox row">
            <label class="col-4 col-form-label text-left"><?php echo app('translator')->get('lang.copy_files'); ?></label>
            <div class="col-8 text-left p-t-5">
                <input type="checkbox" id="task_recurring_copy_files" name="task_recurring_copy_files"
                    class="filled-in chk-col-light-blue"
                    <?php echo e(runtimePreChecked2($task->task_recurring_copy_files ?? 'yes', 'yes')); ?>>
                <label class="p-l-30" for="task_recurring_copy_files"></label>
            </div>
        </div>

        <!--automatically assign-->
        <div class="form-group form-group-checkbox row">
            <label class="col-4 col-form-label text-left"><?php echo app('translator')->get('lang.automatically_assign'); ?></label>
            <div class="col-8 text-left p-t-5">
                <input type="checkbox" id="task_recurring_automatically_assign" name="task_recurring_automatically_assign"
                    class="filled-in chk-col-light-blue"
                    <?php echo e(runtimePreChecked2($task->task_recurring_automatically_assign ?? 'yes', 'yes')); ?>>
                <label class="p-l-30" for="task_recurring_automatically_assign"></label>
            </div>
        </div>


    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/tasks/components/modals/recurring-settings.blade.php ENDPATH**/ ?>