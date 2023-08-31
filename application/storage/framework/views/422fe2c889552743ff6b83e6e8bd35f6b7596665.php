<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left"><?php echo e(cleanLang(__('lang.status'))); ?></label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="project_status" name="project_status">
            <option value="not_started" <?php echo e(runtimePreselected('not_started', $project->project_status)); ?>>
                <?php echo e(cleanLang(__('lang.not_started'))); ?></option>
            <option value="in_progress" <?php echo e(runtimePreselected('in_progress', $project->project_status)); ?>>
                <?php echo e(cleanLang(__('lang.in_progress'))); ?></option>
            <option value="on_hold" <?php echo e(runtimePreselected('on_hold', $project->project_status)); ?>>
                <?php echo e(cleanLang(__('lang.on_hold'))); ?></option>
            <option value="cancelled" <?php echo e(runtimePreselected('cancelled', $project->project_status)); ?>>
                <?php echo e(cleanLang(__('lang.cancelled'))); ?></option>
            <option value="completed" <?php echo e(runtimePreselected('completed', $project->project_status)); ?>>
                <?php echo e(cleanLang(__('lang.completed'))); ?></option>
        </select>
    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/projects/components/actions/change-status.blade.php ENDPATH**/ ?>