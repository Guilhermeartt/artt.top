<!--[dependency] - hide tab menu, if we have a locking dependency-->
<?php if(config('visibility.task_is_open')): ?>
<ul class="nav nav-tabs" role="tablist">
        <!--home-->
        <li class="nav-item"> <a class="nav-link active ajax-request" data-toggle="tab" href="javascript:void(0);"
                        role="tab" data-url="<?php echo e(url('tasks/content/'.$task->task_id.'/show-main?show=tab')); ?>"
                        data-loading-class="loading-before-centre" data-loading-target="card-tasks-left-panel"><span
                                class="hidden-sm-up"><i class="ti-home"></i></span> <span
                                class="hidden-xs-down"><?php echo app('translator')->get('lang.task'); ?></span></a> </li>

        <!--customfields-->
        <li class="nav-item"> <a class="nav-link ajax-request" data-toggle="tab" href="javascript:void(0);" role="tab"
                        data-url="<?php echo e(url('tasks/content/'.$task->task_id.'/show-customfields')); ?>"
                        data-loading-class="loading-before-centre" data-loading-target="card-tasks-left-panel">
                        <span class="hidden-sm-up"><i class="ti-menu"></i></span>
                        <span class="hidden-xs-down"><?php echo app('translator')->get('lang.information'); ?></span></a>
        </li>


        <!--my notes (do not show for templates)-->
        <?php if($task->project_type == 'project'): ?>
        <li class="nav-item"> <a class="nav-link ajax-request" data-toggle="tab" href="javascript:void(0);" role="tab"
                        data-url="<?php echo e(url('tasks/content/'.$task->task_id.'/show-mynotes')); ?>"
                        data-loading-class="loading-before-centre" data-loading-target="card-tasks-left-panel">
                        <span class="hidden-sm-up"><i class="ti-notepad"></i></span>
                        <span class="hidden-xs-down"><?php echo app('translator')->get('lang.my_notes'); ?></span></a>
        </li>
        <?php endif; ?>



        <!--recurring settings-->
        <?php if($task->project_type == 'project' && auth()->user()->is_team && $task->permission_edit_task): ?>
        <li class="nav-item"> <a class="nav-link ajax-request" data-toggle="tab" href="javascript:void(0);" role="tab"
                        data-url="<?php echo e(url('tasks/'.$task->task_id.'/recurring-settings?source=modal')); ?>"
                        data-loading-class="loading-before-centre" data-loading-target="card-tasks-left-panel">
                        <span class="hidden-sm-up"><i class="sl-icon-refresh"></i></span>
                        <span class="hidden-xs-down"><?php echo app('translator')->get('lang.recurring'); ?></span>
                        <!--recurring-->
                        <?php if(auth()->user()->is_team): ?>
                        <span class="sl-icon-refresh font-13 vm text-danger p-l-5 <?php echo e(runtimeTaskRecurringIcon($task->task_recurring)); ?>" id="task-modal-menu-recurring-icon"
                                data-toggle="tooltip"
                                title="<?php echo app('translator')->get('lang.recurring_task'); ?>"></span>
                        <?php endif; ?> </a>
        </li>
        <?php endif; ?>
</ul>
<?php endif; ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/task/content/tabmenu.blade.php ENDPATH**/ ?>