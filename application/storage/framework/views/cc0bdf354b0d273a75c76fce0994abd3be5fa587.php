<!--main table view-->
<?php echo $__env->make('pages.milestones.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--Update Card Poistion-->
<?php if(config('visibility.milestone_actions')): ?>
<span class="hidden" id="js-trigger-milestones-sorting">placeholder</span>
<?php endif; ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/milestones/components/table/wrapper.blade.php ENDPATH**/ ?>