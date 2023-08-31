<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- each comment -->
<div class="display-flex flex-row comment-row" id="comment_<?php echo e($comment->comment_id); ?>">
    <div class="p-2">
        <img src="<?php echo e(getUsersAvatar($comment->avatar_directory, $comment->avatar_filename)); ?>"
            class="img-circle" alt="user" width="40">
    </div>
    <div class="comment-text w-100 js-hover-actions">
        <div class="row">
            <div class="col-sm-6 x-name"><?php echo e($comment->first_name ?? runtimeUnkownUser()); ?></div>
            <div class="col-sm-6 x-meta text-right">
                <!--actions-->
                <?php if($comment->permission_delete_comment): ?>
                <span class="comment-actions js-hover-actions-target hidden">
                    <a href="javascript:void(0)" class="btn-outline-danger confirm-action-danger"
                        data-confirm-title="<?php echo e(cleanLang(__('lang.delete_comment'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                        data-ajax-type="DELETE" data-url="<?php echo e(url('/comments/'.$comment->comment_id)); ?>">
                        <i class="sl-icon-trash"></i>
                    </a>
                </span>
                <?php endif; ?>
                <!--actions-->
                <span class="text-muted x-date"><small><?php echo e(runtimeDateAgo($comment->comment_created)); ?></small></span>
            </div>
        </div>
        <div><?php echo _clean($comment->comment_text); ?></div>
    </div>
</div>
<!--each comment -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/comments/components/ajax.blade.php ENDPATH**/ ?>