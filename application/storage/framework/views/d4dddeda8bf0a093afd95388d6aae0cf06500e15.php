<!-- Column -->
<div class="card" id="project_details" data-progress="<?php echo e($project->project_progress); ?>">

    <!--cover image-->
    <?php if(config('visibility.project_cover_image')): ?>
    <div class="project-cover-image-wrapper js-hover-actions <?php echo e(config('visibility.project_cover_image_current')); ?>">
        <img id="project-cover-image"
            src="<?php echo e(clean(getCoverImage($project->project_cover_directory ?? '', $project->project_cover_filename ?? '', 'image'))); ?>"
            alt="image">

        <!-- cover image buttons-->
        <?php if(config('visibility.project_cover_image')): ?>
        <div class="js-hover-actions-target edit_project_cover_wrapper hidden" id="edit_project_cover_wrapper">
            <!--edit cover-->
            <button type="button"
                class="data-toggle-tooltip btn waves-effect btn-sm waves-light btn-rounded btn-info js-ajax-ux-request edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                title=" <?php echo app('translator')->get('lang.change_cover_image'); ?>" data-toggle="modal" data-target="#commonModal"
                data-modal-title="<?php echo e(cleanLang(__('lang.change_cover_image'))); ?>"
                data-url="<?php echo e(urlResource('/projects/'.$project->project_id.'/change-cover-image?view=page')); ?>"
                data-action-url="<?php echo e(urlResource('/projects/'.$project->project_id.'/change-cover-image')); ?>"
                data-loading-target="commonModalBody" data-action-method="POST">
                <i class="sl-icon-note"></i>
            </button>
            <!--remove cover-->
            <button type="button" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.remove_cover_image'); ?>"
                class="btn waves-effect btn-sm waves-light btn-rounded btn-danger data-toggle-action-tooltip confirm-action-danger"
                title="<?php echo e(cleanLang(__('lang.edit'))); ?>" data-confirm-title="<?php echo app('translator')->get('lang.remove_cover_image'); ?>"
                data-confirm-text="<?php echo app('translator')->get('lang.are_you_sure'); ?>" data-ajax-type="POST" 
                data-url="<?php echo e(urlResource('/projects/'.$project->project_id.'/remove-cover-image')); ?>">
                <i class="sl-icon-trash"></i>
            </button>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="card-body p-t-10 p-b-10" id="project_progress_container">
        <!--project progress-->
        <div class="d-flex no-block">
            <div class="align-self-end no-shrink">
                <h5 class="m-b-0"><?php echo e(cleanLang(__('lang.progress'))); ?></h5>
                <!--[team]-->
                <?php if(auth()->user()->is_team): ?>
                <?php if($project->project_progress_manually == 'yes'): ?>
                <h6 class="text-muted"><?php echo e(cleanLang(__('lang.manually_set_progress'))); ?></h6>
                <?php else: ?>
                <h6 class="text-muted"><?php echo e(cleanLang(__('lang.task_based_progress'))); ?></h6>
                <?php endif; ?>
                <?php else: ?>
                <!--[client]-->
                <h6 class="text-muted"><?php echo e(cleanLang(__('lang.project_progress'))); ?></h6>
                <?php endif; ?>
            </div>
            <div class="ml-auto">
                <div id="project_progress_chart"></div>
            </div>
        </div>
        <!--project progress-->
        <!--this item is archived notice-->
        <?php if($project->project_active_state == 'archived' && runtimeArchivingOptions()): ?>
        <div
            class="alert alert-warning p-t-7 p-b-7 m-t-10 m-b--20<?php echo e(runtimeActivateOrAchive('archived-notice', $project->project_active_state)); ?>">
            <i class="mdi mdi-archive"></i> <?php echo app('translator')->get('lang.this_project_is_archived'); ?>
        </div>
        <?php endif; ?>
    </div>
    <!--hidden-->
    <div class="card-body p-t-0 p-b-0 d-none" id="project_progress_hidden">
        <div>
            <table class="table no-border m-b-0">
                <tbody>
                    <tr>
                        <td class="p-l-0 p-t-5">
                            <h5 class="m-b-0"><?php echo e(cleanLang(__('lang.progress'))); ?></h5>
                            <h6 class="text-muted"><?php echo e(cleanLang(__('lang.tasks'))); ?></h6>
                        </td>
                        <td class="font-medium p-r-0 p-t-5 w-50 vt">
                            <span class="project_progress_hidden_text">30%</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="m-t-10 m-b-10">
        <hr>
    </div>
    <div class="card-body p-t-0 p-b-0">
        <!--[client details]-->
        <?php if(auth()->user()->is_team): ?>
        <div class="p-b-20">
            <h6><a href="/clients/<?php echo e($project->client_id); ?>"><?php echo e($project->client_company_name); ?></a></h6>
            <div>
                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span data-toggle="tooltip" title="<?php echo e($contact->first_name); ?> <?php echo e($contact->last_name); ?>"><img
                        src="<?php echo e(getUsersAvatar($contact->avatar_directory, $contact->avatar_filename)); ?>" alt="user"
                        class="img-circle avatar-xsmall"></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!--assigned-->
        <div class="row">
            <div class="col-sm-6">
                <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.assigned'))); ?></div>
                <div>
                    <?php $__currentLoopData = $project->assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span data-toggle="tooltip" title="<?php echo e($team->first_name); ?> <?php echo e($team->last_name); ?>"><img
                            src="<?php echo e(getUsersAvatar($team->avatar_directory, $team->avatar_filename)); ?>" alt="user"
                            class="img-circle avatar-xsmall"></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($project->assigned()->count() == 0): ?>
                    ---
                    <?php endif; ?>
                </div>
            </div>

            <!--project manager-->
            <div class="col-sm-6">
                <?php if(auth()->user()->is_team): ?>
                <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.project_manager'))); ?></div>
                <div>
                    <?php $__currentLoopData = $project->managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span data-toggle="tooltip" title="<?php echo e($team->first_name); ?> <?php echo e($team->last_name); ?>"><img
                            src="<?php echo e(getUsersAvatar($team->avatar_directory, $team->avatar_filename)); ?>" alt="user"
                            class="img-circle avatar-xsmall"></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($project->managers()->count() == 0): ?>
                    ---
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>



        </div>

        <!--project tags-->
        <?php if(auth()->user()->is_team): ?>
        <div class="row m-t-20">
            <div class="col-12">
                <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.tags'))); ?></div>
                <div class="l-h-24">
                    <?php $__currentLoopData = $project->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="label label-rounded label-default tag p-t-3 p-b-3"><?php echo e($tag->tag_title); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="m-t-10 m-b-10">
        <hr>
    </div>
    <!--dates-->
    <div class="card-body p-t-0 p-b-0">
        <div class="row">
            <div class="col-sm-6">
                <div>
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.start_date'))); ?></div>
                    <div><?php echo e(runtimeDate($project->project_date_start)); ?></div>
                </div>

                <div class="m-t-20">
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.category'))); ?></div>
                    <div><?php echo e($project->category_name); ?></div>
                </div>

            </div>
            <div class="col-sm-6">
                <div>
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.due_date'))); ?></div>
                    <div><?php echo e(runtimeDate($project->project_date_due)); ?></div>
                </div>
                <div class="m-t-20">
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.status'))); ?></div>
                    <div><span
                            class="label <?php echo e(runtimeProjectStatusColors($project->project_status, 'label')); ?>"><?php echo e(runtimeLang($project->project_status)); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-t-10 m-b-10">
        <hr>
    </div>
    <!--billing details-->
    <?php if(config('visibility.project_billing_summary')): ?>
    <div class="card-body p-t-0 p-b-0">
        <div class="row">
            <div class="col-sm-6">
                <div>
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.billing_type'))); ?></div>
                    <?php if($project->project_billing_type == 'hourly'): ?>
                    <div><?php echo e(cleanLang(__('lang.hourly'))); ?></div>
                    <?php else: ?>
                    <div><?php echo e(cleanLang(__('lang.fixed_fee'))); ?></div>
                    <?php endif; ?>
                </div>

                <div class="m-t-20">
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.estimated_hours'))); ?></div>
                    <div><?php echo e($project->project_billing_estimated_hours); ?> <?php echo e(strtolower(__('lang.hrs'))); ?>

                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div>
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.rate'))); ?></div>
                    <div><?php echo e(runtimeMoneyFormat($project->project_billing_rate)); ?></div>
                </div>
                <div class="m-t-20">
                    <div class="panel-label p-b-3"><?php echo e(cleanLang(__('lang.time_spent'))); ?></div>
                    <div><?php echo e($payload['time_logged']); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(config('settings.project_permissions_view_invoices')): ?>
    <!--INVOICES-->
    <div class="m-t-10 m-b-10">
        <hr>
    </div>
    <div class="card-body p-t-0 p-b-0">
        <div>
            <table class="table no-border m-b-0">
                <tbody>
                    <tr>
                        <td class="p-l-0 p-t-5 w-50"><?php echo e(cleanLang(__('lang.all_invoices'))); ?></td>
                        <td class="font-medium p-r-0 p-t-5">
                            <?php echo e(runtimeMoneyFormat($project->sum_invoices_all)); ?>

                            <div class="progress">
                                <?php if($project->sum_invoices_all > 0): ?>
                                <div class="progress-bar bg-info w-100 h-px-3" role="progressbar">
                                    <?php else: ?>
                                    <div class="progress-bar bg-info w-0 h-px-3" role="progressbar">
                                        <?php endif; ?>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-l-0 p-t-5"><?php echo e(cleanLang(__('lang.payments'))); ?></td>
                        <td class="font-medium p-r-0 p-t-5">
                            <?php echo e(runtimeMoneyFormat($project->sum_all_payments)); ?>

                            <div class="progress">
                                <div class="progress-bar bg-success <?php echo e(runtimeProjectInvoicesBars($project->sum_invoices_all, $project->sum_all_payments)); ?>"
                                    role="progressbar"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-l-0 p-t-5"><?php echo e(cleanLang(__('lang.balance_due'))); ?></td>
                        <td class="font-medium p-r-0 p-t-5">
                            <?php echo e(runtimeMoneyFormat($project->sum_invoices_all - $project->sum_all_payments)); ?>

                            <div class="progress">
                                <div class="progress-bar bg-warning <?php echo e(runtimeProjectInvoicesBars($project->sum_invoices_all, ($project->sum_invoices_all - $project->sum_all_payments))); ?>"
                                    role="progressbar"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>


    <?php if(config('visibility.project_show_custom_fields')): ?>
    <!--CUSTOMER FIELDS-->
    <div class="m-t-10 m-b-10">
        <hr>
    </div>
    <div class="card-body p-t-0 p-b-0">
        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($field->customfields_show_project_page == 'yes'): ?>
        <div class="x-each-field m-b-18">
            <div class="panel-label p-b-3"><?php echo e($field->customfields_title); ?>

            </div>
            <div class="x-content"><?php echo clean(customFieldValue($field->customfields_name, $project,
                $field->customfields_datatype)); ?></div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(config('app.application_demo_mode')): ?>
        <!--DEMO INFO-->
        <div class="alert alert-info">
            <h5 class="text-info"><i class="sl-icon-info"></i> Demo Info</h5>
            These are custom fields. You can change them or <a
                href="<?php echo e(url('app/settings/customfields/projects')); ?>">create your own.</a>
        </div>
        <?php endif; ?>

    </div>
    <?php endif; ?>

    <div class="d-none last-line">
        <hr>
    </div>
</div>
<!-- Column --><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/project/components/misc/details.blade.php ENDPATH**/ ?>