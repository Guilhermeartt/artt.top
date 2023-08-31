<div class="folder-panel">

    <div class="folder-header clearfix">
        <h5><i class="ti-folder display-inline-block m-r-4"></i> <?php echo app('translator')->get('lang.folders'); ?></h5>
        <?php if(config('visibility.manage_file_folders')): ?>
        <div class="folder-actions">
            <span class="dropdown cursor-pointer" data-toggle="dropdown" aria-haspopup="true"
                id="folder-actions-settings" aria-expanded="false">
                <i class="ti-more"></i>
            </span>
            <div class="dropdown-menu" aria-labelledby="folder-actions-settings">
                <!--create_a_folder-->
                <a class="dropdown-item js-ajax-ux-request" href="javascript:void(0);"
                    data-button-loading-annimation="no" data-url="<?php echo e(urlResource('/files/folders/create')); ?>">
                    <i class="mdi mdi-plus-circle-outline"></i> <?php echo app('translator')->get('lang.create_a_folder'); ?></a>
                <!--edit_folders-->
                <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    href="javascript:void(0)" data-url="<?php echo e(urlResource('/files/folders/edit')); ?>"
                    data-button-loading-annimation="no">
                    <i class="ti-pencil"></i> <?php echo app('translator')->get('lang.edit_folders'); ?></a>
            </div>
            </span>
        </div>
        <?php endif; ?>
    </div>

    <div class="folders-body p-t-15" id="folders-body">
        <!--folders [list] view-->
        <?php echo $__env->make('pages.files.components.folders.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/files/components/folders/wrapper.blade.php ENDPATH**/ ?>