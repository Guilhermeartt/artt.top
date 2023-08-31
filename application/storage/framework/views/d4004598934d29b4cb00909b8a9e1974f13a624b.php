<div class="splash-image" id="updatePasswordSplash">
    <img src="<?php echo e(url('/')); ?>/public/images/notifications.png" alt="404 - Not found" />
</div>
<div class="splash-text">
    <?php echo e(cleanLang(__('lang.notify_me_about_these_events'))); ?>

</div>
<div class="splash-subtext">
    <?php echo e(cleanLang(__('lang.events_such_as'))); ?>

</div>

<!--notifications_new_assignement-->
<?php if(auth()->user()->is_team): ?>
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.new_assignment'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_new_assignement" data-allow-clear="false"
            name="notifications_new_assignement">
            <option value="yes" <?php echo e(runtimePreselected('yes', auth()->user()->notifications_new_assignement)); ?>>
                <?php echo e(cleanLang(__('lang.notification_only'))); ?></option>
            <option value="yes_email" <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_new_assignement)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_new_assignement)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>
<?php endif; ?>


<!--notifications_billing_activity-->
<?php if(auth()->user()->is_team): ?>
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.billing'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_billing_activity" data-allow-clear="false"
            name="notifications_billing_activity">
            <option value="yes" <?php echo e(runtimePreselected('yes', auth()->user()->notifications_billing_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_only'))); ?></option>
            <option value="yes_email" <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_billing_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_billing_activity)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>
<?php endif; ?>


<!--notifications_new_project-->
<?php if(auth()->user()->is_client): ?>
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.new_project'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_new_project" data-allow-clear="false"
            name="notifications_new_project">
            <option value="yes_email"
                <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_new_project)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_new_project)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>
<?php endif; ?>

<!--notifications_projects_activity-->
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.projects'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_projects_activity" data-allow-clear="false"
            name="notifications_projects_activity">
            <option value="yes" <?php echo e(runtimePreselected('yes', auth()->user()->notifications_projects_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_only'))); ?></option>
            <option value="yes_email"
                <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_projects_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_projects_activity)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>

<!--notifications_leads_activity-->
<?php if(auth()->user()->is_team): ?>
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.leads'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_leads_activity" data-allow-clear="false"
            name="notifications_leads_activity">
            <option value="yes" <?php echo e(runtimePreselected('yes', auth()->user()->notifications_leads_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_only'))); ?></option>
            <option value="yes_email"
                <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_leads_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_leads_activity)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>
<?php endif; ?>

<!--notifications_tasks_activity-->
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.tasks'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_tasks_activity" data-allow-clear="false"
            name="notifications_tasks_activity">
            <option value="yes" <?php echo e(runtimePreselected('yes', auth()->user()->notifications_tasks_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_only'))); ?></option>
            <option value="yes_email"
                <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_tasks_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_tasks_activity)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>

<!--notifications_tickets_activity-->
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.support_tickets'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_tickets_activity" data-allow-clear="false"
            name="notifications_tickets_activity">
            <option value="yes" <?php echo e(runtimePreselected('yes', auth()->user()->notifications_tickets_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_only'))); ?></option>
            <option value="yes_email"
                <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_tickets_activity)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_tickets_activity)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>

<!--notifications_reminders-->
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo app('translator')->get('lang.reminders'); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_reminders" data-allow-clear="false"
            name="notifications_reminders">
            <option value="email"
                <?php echo e(runtimePreselected('email', auth()->user()->notifications_reminders)); ?>>
                <?php echo e(cleanLang(__('lang.email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_reminders)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div>


<!--notifications_system-->
<div class="form-group form-group-checkbox row">
    <label class="col-7 col-form-label text-left"><?php echo e(cleanLang(__('lang.system_notifications'))); ?></label>
    <div class="col-5 text-right p-t-5">
        <select class="select2-basic form-control form-control-sm text-left" id="notifications_system" data-allow-clear="false"
            name="notifications_system">
            <option value="yes" <?php echo e(runtimePreselected('yes', auth()->user()->notifications_system)); ?>>
                <?php echo e(cleanLang(__('lang.notification_only'))); ?></option>
            <option value="yes_email"
                <?php echo e(runtimePreselected('yes_email', auth()->user()->notifications_system)); ?>>
                <?php echo e(cleanLang(__('lang.notification_and_email'))); ?></option>
            <option value="no" <?php echo e(runtimePreselected('no', auth()->user()->notifications_system)); ?>>
                <?php echo e(cleanLang(__('lang.nothing'))); ?></option>
        </select>
    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/user/modals/update-notifications.blade.php ENDPATH**/ ?>