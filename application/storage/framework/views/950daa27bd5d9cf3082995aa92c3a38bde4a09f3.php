<div class="form-group row">
    <div class="col-4">
        <?php echo app('translator')->get('lang.hours'); ?>
        <input type="number" class="form-control form-control-sm"
            name="manual_time_hours" id="manual_time_hours"
            value="<?php echo e(hourMinuteSeconds($time->timer_time ?? 0, 'hours')); ?>">
    </div>
    <div class="col-4">
        <?php echo app('translator')->get('lang.minutes'); ?>
        <input type="number" class="form-control form-control-sm"
            name="manual_time_minutes" id="manual_time_minutes"
            value="<?php echo e(hourMinuteSeconds($time->timer_time ?? 0, 'minutes')); ?>">
    </div>
    <div class="col-4">
        <?php echo app('translator')->get('lang.seconds'); ?>
        <input type="number" class="form-control form-control-sm"
            name="manual_time_seconds" id="manual_time_seconds"
            value="<?php echo e(hourMinuteSeconds($time->timer_time ?? 0, 'seconds')); ?>">
    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/timesheets/components/modals/edit-time.blade.php ENDPATH**/ ?>