<!-- Page Title & Bread Crumbs -->
<div class="col-md-12 col-lg-6 align-self-center">
    <h3 class="text-themecolor"><?php echo e($page['heading'] ?? ''); ?>

        <!--automation-->
        <?php if(auth()->user()->is_team): ?>
        <a href="javascript:void(0)"
            class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form <?php echo e(projectAutomationVisibility($project->project_automation_status)); ?>" 
            id="project_automation_icon_<?php echo e($project->project_id); ?>"
            data-toggle="modal"
            data-target="#commonModal"
            data-url="<?php echo e(urlResource('/projects/'.$project->project_id.'/edit-automation?ref=list')); ?>"
            data-loading-target="commonModalBody" data-modal-title="<?php echo app('translator')->get('lang.project_automation'); ?>"
            data-action-url="<?php echo e(urlResource('/projects/'.$project->project_id.'/edit-automation?ref=list')); ?>"
            data-action-method="POST" data-action-ajax-loading-target="commonModalBody">
            <span
                class="sl-icon-energy text-warning p-l-5"
                data-toggle="tooltip"
                title="<?php echo app('translator')->get('lang.project_automation'); ?>"></span>
        </a>
        <?php endif; ?></h3>
    <!--crumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo e(cleanLang(__('lang.app'))); ?></li>
        <?php if(isset($page['crumbs'])): ?>
        <?php $__currentLoopData = $page['crumbs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="breadcrumb-item <?php if($loop->last): ?> active <?php endif; ?>"><?php echo e($title ?? ''); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ol>
    <!--crumbs-->
</div>
<!--Page Title & Bread Crumbs --><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/project/components/misc/crumbs.blade.php ENDPATH**/ ?>