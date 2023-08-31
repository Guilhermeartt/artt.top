<div class="table-responsive">
    <?php if(@count($webforms ?? []) > 0): ?>
    <table id="demo-webform-addrow" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
        <thead>
            <tr>
                <th class="webforms_col_name"><?php echo app('translator')->get('lang.title'); ?></th>
                <th class="webforms_col_date"><?php echo app('translator')->get('lang.date_created'); ?></th>
                <th class="webforms_col_created_by"><?php echo app('translator')->get('lang.created_by'); ?></th>
                <th class="webforms_col_submitted"><?php echo app('translator')->get('lang.times_submitted'); ?></th>
                <th class="webforms_col_action"><?php echo app('translator')->get('lang.actions'); ?></th>
            </tr>
        </thead>
        <tbody id="webforms-td-container">
            <!--ajax content here-->
            <?php echo $__env->make('pages.settings.sections.webforms.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--ajax content here-->
        </tbody>
    </table>

    <?php if(config('system.settings_type') == 'standalone'): ?>
    <!--[standalone] - settings documentation help-->
    <div class="m-t-40">
        <a href="https://growcrm.io/documentation" target="_blank" class="btn btn-sm btn-info help-documentation"><i
                class="ti-info-alt"></i>
            <?php echo e(cleanLang(__('lang.help_documentation'))); ?>

        </a>
    </div>
    <?php endif; ?>

    <?php endif; ?>
    <?php if(@count($webforms ?? []) == 0): ?>
    <!--nothing found-->
    <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--nothing found-->
    <?php endif; ?>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/settings/sections/webforms/table/table.blade.php ENDPATH**/ ?>