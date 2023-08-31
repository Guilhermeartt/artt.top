<!--folders list view-->
<div class="folders-list-view">


    <ul>

        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li id="folder_<?php echo e($folder->filefolder_id); ?>" class="ajax-request file-folder-menu-item <?php echo e(runtimeFileFoldersActive($folder->filefolder_id, request('filter_folderid'))); ?>"
            data-url="<?php echo e(urlResource('/files').'&source=ext&filter_folderid='.$folder->filefolder_id); ?>">
            <span><?php echo e($folder->filefolder_name); ?></span></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>


</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/files/components/folders/list.blade.php ENDPATH**/ ?>