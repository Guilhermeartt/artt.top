<!--title-->
<div class="form-group row">
    <label class="col-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.title'))); ?>*</label>
    <div class="col-12">
        <input type="text" class="form-control form-control-sm" id="knowledgebase_title" name="knowledgebase_title"
            value="<?php echo e($knowledgebase->knowledgebase_title ?? ''); ?>">
    </div>
</div>

<!--category-->
<?php if(is_numeric(request('knowledgebase_categoryid'))): ?>
<input type="hidden" name="knowledgebase_categoryid" value="<?php echo e(request('knowledgebase_categoryid')); ?>">
<?php else: ?>
<div class="form-group row">
    <label for="example-month-input"
        class="col-12 control-label  col-form-label text-left required"><?php echo e(cleanLang(__('lang.category'))); ?>*</label>
    <div class="col-12">
        <select class="select2-basic form-control form-control-sm" id="knowledgebase_categoryid"
            name="knowledgebase_categoryid">
            <option></option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->kbcategory_id); ?>" data-category-type="<?php echo e($category->kbcategory_type); ?>"
                <?php echo e(runtimePreselected(@request('knowledgebase_categoryid'), $category->kbcategory_id)); ?>><?php echo e(runtimeLang($category->kbcategory_title)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php endif; ?>


<!--text description-->
<div class="form-group row <?php echo e(runtimeVisibilityKBArticle('text', request('category_type'))); ?>" id="article-text-editor-container">
    <label
        class="col-12 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.description'))); ?>*</label>
    <div class="col-12">
        <textarea class="form-control form-control-sm tinymce-textarea" rows="5" name="knowledgebase_text"
            id="knowledgebase_text"><?php echo e($knowledgebase->knowledgebase_text ?? ''); ?></textarea>
    </div>
</div>


<!--embed code-->
<div class="form-group row <?php echo e(runtimeVisibilityKBArticle('video', request('category_type'))); ?>" id="article-embed-code-container">
    <label class="col-12 text-left control-label col-form-label required"><?php echo app('translator')->get('lang.youtube_embed_code'); ?>*</label>
    <div class="col-12">
        <textarea class="form-control form-control-sm" rows="5" name="knowledgebase_embed_code"
            id="knowledgebase_embed_code"><?php echo e($knowledgebase->knowledgebase_embed_code ?? ''); ?></textarea>
    </div>
    <div class="col-12 p-t-10">
    <div class="alert alert-info"><?php echo app('translator')->get('lang.video_article_notes'); ?></div>
    </div>
</div>

<!--notes-->
<div class="row">
    <div class="col-12">
        <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>
    </div>
</div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/knowledgebase/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>