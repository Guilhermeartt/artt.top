 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <?php echo $__env->make('pages.project.components.misc.crumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('pages.project.components.misc.actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    <!--page heading-->

    <!--topnav-->
    <?php echo $__env->make('pages.project.components.misc.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--topnav-->

    <!-- page content -->
    <div class="row m-t-10" id="projects-tab-split-screen">

        <!--project details section-->
        <?php if(isset($page['section']) && $page['section'] == 'overview'): ?>
        <div class="col-md-12 col-lg-6 hide_tabbed_section">
            <div class="card min-h-300">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="card-body tab-body p-t-10">
                            <?php echo $__env->make('pages.project.components.misc.details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!--/#project details section-->

        <!--dynamic ajax section-->
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="tab-content">
                    <div class="tab-pane active ext-ajax-container" id="projects_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded project-timeline" id="embed-content-container">
                            <!--dynamic content here-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/#dynamic ajax section-->

    </div>
    <!--page content -->

    <!-- page content -->
    <div class="row m-t-10 hidden" id="projects-tab-single-screen">
        <!--dynamic ajax section-->
        <div class="col-lg-12">
            <div class="card min-h-300">
                <div class="tab-content">
                    <div class="tab-pane active ext-ajax-container" id="projects_ajaxtab" role="tabpanel">
                        <div class="card-body tab-body tab-body-embedded" id="embed-content-container">
                            <!--dynamic content here-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--page content -->
</div>
<!--main content -->
<!--ajax tab loading-->


<!--ajax tab initial loading - timeline-->
<span id="dynamic-project-content" class="js-ajax-ux-request hidden" data-loading-target="embed-content-container"
    data-url="<?php echo e($page['dynamic_url'] ?? ''); ?>">placeholder</span>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/project/wrapper.blade.php ENDPATH**/ ?>