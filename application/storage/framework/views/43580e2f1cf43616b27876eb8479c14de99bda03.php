<!--user-->
<?php $__currentLoopData = $assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<span class="x-assigned-user <?php echo e(runtimePermissions('task-assign-users', $task->permission_assign_users)); ?> card-task-assigned card-assigned-listed-user"
        tabindex="0" data-user-id="<?php echo e($user->id); ?>" data-popover-content="card-task-team"
        data-title="<?php echo e(cleanLang(__('lang.assign_users'))); ?>"><img
                src="<?php echo e(getUsersAvatar($user->avatar_directory, $user->avatar_filename)); ?>" data-toggle="tooltip"
                title="" data-placement="top" alt="<?php echo e($user->first_name); ?>" class="img-circle avatar-xsmall"
                data-original-title="<?php echo e($user->first_name); ?>"></span>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/task/components/assigned.blade.php ENDPATH**/ ?>