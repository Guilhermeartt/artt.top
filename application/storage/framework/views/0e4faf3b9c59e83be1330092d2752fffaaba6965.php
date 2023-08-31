<div class="card" id="comments-wrapper">
    <?php $unique_comment_id = str_random(10) ; ?>

    <div class="comments card-body" id="js-trigger-comments" data-payload="<?php echo e($unique_comment_id); ?>">

        <!--complete commenting form-->
        <?php if(config('visibility.post_new_comment_form')): ?>
        <div class="post-comment display-flex flex-row" id="form-<?php echo e($unique_comment_id); ?>">
            <div class="x-avatar">
                <img src="<?php echo e(auth()->user()->avatar); ?>" class="img-circle" alt="user" width="40">
            </div>
            <!--placeholder textbox-->
            <div class="form-group row x-message-field x-message-field-placeholder js-toggle-placeholder-element"
                id="placeholder-container-<?php echo e($unique_comment_id); ?>"
                data-show-element-container="editor-container-<?php echo e($unique_comment_id); ?>">
                <textarea class="form-control form-control-sm w-100" rows="1"
                    ><?php echo e(cleanLang(__('lang.post_a_comment'))); ?>...</textarea>
            </div>
            <!--rich text editor-->
            <div class="form-group row x-message-field hidden" id="editor-container-<?php echo e($unique_comment_id); ?>">
                <!--tinymce editor-->
                <textarea class="form-control form-control-sm w-100 tinymce-textarea" rows="2" id="editor-<?php echo e($unique_comment_id); ?>"
                    name="comment_text" id="comment_text"></textarea>
                <!--close button-->
                <a class="x-close-button  js-toggle-close-button" href="JavaScript:void(0);"
                    data-hide-element-container="editor-container-<?php echo e($unique_comment_id); ?>"
                    data-show-element-container="placeholder-container-<?php echo e($unique_comment_id); ?>">
                    <i class="ti-close"></i>
                </a>
                <!--submit button-->
                <button type="button" class="btn btn-danger btn-icon-circle js-ajax-ux-request x-submit-button"
                    data-url="<?php echo e(urlResource('/comments')); ?>" data-type="form" data-ajax-type="post"
                    data-form-id="form-<?php echo e($unique_comment_id); ?>" data-loading-target="comments-container">
                    <i class="sl-icon-paper-plane"></i>
                </button>
                <!--meta-->
                <input type="hidden" name="placeholder-container" value="placeholder-container-<?php echo e($unique_comment_id); ?>">
                <input type="hidden" name="editor-container" value="editor-container-<?php echo e($unique_comment_id); ?>">
                <input type="hidden" name="editor" value="editor-<?php echo e($unique_comment_id); ?>">
            </div>
        </div>
        <?php endif; ?>
        <!--/#complete commenting form-->

        <!--ajax content here-->
        <div class="comment-widgets" id="comments-container">
            <!--nothing found-->
            <?php if(@count($comments ?? []) == 0): ?> <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>
            <!--nothing found-->
            <?php echo $__env->make('pages.comments.components.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!--ajax content here-->

        <!--load more button-->
        <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--load more button-->

    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/comments/wrapper.blade.php ENDPATH**/ ?>