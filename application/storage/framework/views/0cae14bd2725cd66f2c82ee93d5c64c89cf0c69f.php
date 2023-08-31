<?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-sm-12" id="card_attachment_<?php echo e($attachment->attachment_uniqiueid); ?>">
    <div class="file-attachment">
        <?php if($attachment->attachment_type == 'image'): ?>
        <!--dynamic inline style-->
        <div class="">
            <a class="fancybox preview-image-thumb"
                href="storage/files/<?php echo e($attachment->attachment_directory); ?>/<?php echo e($attachment->attachment_filename); ?>"
                title="<?php echo e(str_limit($attachment->attachment_filename, 60)); ?>"
                alt="<?php echo e(str_limit($attachment->attachment_filename, 60)); ?>">
                <img class="x-image" src="<?php echo e(url('storage/files/' . $attachment->attachment_directory .'/'. $attachment->attachment_thumbname)); ?>">
            </a>
        </div>
        <?php else: ?>
        <div class="x-image"> 
            <a class="preview-image-thumb" href="tasks/download-attachment/<?php echo e($attachment->attachment_uniqiueid); ?>" download>
            <?php echo e($attachment->attachment_extension); ?>

            </a>
        </div>
        <?php endif; ?>
        <div class="x-details">
            <div><span class="x-meta"><?php echo e($attachment->first_name ?? runtimeUnkownUser()); ?></span>
                [<?php echo e(runtimeDateAgo($attachment->attachment_created)); ?>]</div>
            <div class="x-name"><span
                    title="<?php echo e($attachment->attachment_filename); ?>"><?php echo e(str_limit($attachment->attachment_filename, 60)); ?></span>
            </div>
            <div class="x-actions"><strong>
                    <!--action: download-->
                    <a href="tasks/download-attachment/<?php echo e($attachment->attachment_uniqiueid); ?>" download><?php echo e(cleanLang(__('lang.download'))); ?> <span
                            class="x-icons"><i class="ti-download"></i></span></strong></a>
                <!--action: delete-->
                <?php if($attachment->permission_delete_attachment): ?>
                <span> |
                    <a href="javascript:void(0)" class="text-danger js-delete-ux-confirm confirm-action-danger"
                        data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                        data-ajax-type="DELETE"
                        data-parent-container="card_attachment_<?php echo e($attachment->attachment_uniqiueid); ?>"
                        data-progress-bar="hidden"
                        data-url="<?php echo e(urlResource('/tasks/delete-attachment/'.$attachment->attachment_uniqiueid)); ?>"><?php echo e(cleanLang(__('lang.delete'))); ?></a></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/task/components/attachment.blade.php ENDPATH**/ ?>