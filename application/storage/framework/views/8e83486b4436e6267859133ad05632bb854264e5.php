<?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="client_<?php echo e($client->client_id); ?>">
    <td class="clients_col_id" id="clients_col_id_<?php echo e($client->client_id); ?>"><?php echo e($client->client_id); ?></td>
    <td class="clients_col_company" id="clients_col_id_<?php echo e($client->client_id); ?>">
        <a href="/clients/<?php echo e($client->client_id ?? ''); ?>"><?php echo e(str_limit($client->client_company_name, 35)); ?></a>
    </td>
    <td class="clients_col_account_owner" id="clients_col_account_owner_<?php echo e($client->client_id); ?>">
        <img src="<?php echo e(getUsersAvatar($client->avatar_directory, $client->avatar_filename)); ?>" alt="user"
            class="img-circle avatar-xsmall">
        <span><?php echo e($client->first_name ?? '---'); ?></span>
    </td>
    <?php if(config('visibility.modules.projects')): ?>
    <td class="clients_col_projects" id="clients_col_projects_<?php echo e($client->client_id); ?>">
        <?php echo e($client->count_projects_all ?? '0'); ?>

    </td>
    <?php endif; ?>
    <td class="clients_col_invoices" id="clients_col_invoices_<?php echo e($client->client_id); ?>">
        <?php echo e(runtimeMoneyFormat($client->sum_invoices_all)); ?></td>
    <td class="clients_col_tags" id="clients_col_tags_<?php echo e($client->client_id); ?>">


        <!--tag-->
        <?php if(count($client->tags ?? []) > 0): ?>
        <?php $__currentLoopData = $client->tags->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="label label-outline-default"><?php echo e(str_limit($tag->tag_title, 15)); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <span>---</span>
        <?php endif; ?>
        <!--/#tag-->

        <!--more tags (greater than tags->take(x) number above -->
        <?php if(count($client->tags ?? []) > 1): ?>
        <?php $tags = $client->tags; ?>
        <?php echo $__env->make('misc.more-tags', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!--more tags-->

    </td>
    <td class="clients_col_category" id="clients_col_category_<?php echo e($client->client_id); ?>">
        <!--category-->
        <span class="label label-outline-default"><?php echo e(str_limit($client->category_name, 15)); ?></span>
        <!--category-->
    </td>
    <td class="clients_col_status" id="clients_col_status_<?php echo e($client->client_id); ?>">
        <span class="label <?php echo e(runtimeClientStatusLabel($client->client_status)); ?>"><?php echo e(runtimeLang($client->client_status)); ?></span>
    </td>

    <?php if(config('visibility.action_column')): ?>
    <td class="clients_col_action actions_column" id="clients_col_action_<?php echo e($client->client_id); ?>">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            <?php if(config('visibility.action_buttons_delete')): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_client'))); ?>"
                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                data-url="<?php echo e(url('/clients/'.$client->client_id)); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            <?php endif; ?>
            <!--edit-->
            <?php if(config('visibility.action_buttons_edit')): ?>
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/clients/'.$client->client_id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('lang.edit_client'))); ?>"
                data-action-url="<?php echo e(urlResource('/clients/'.$client->client_id.'?ref=list')); ?>" data-action-method="PUT"
                data-action-ajax-loading-target="clients-td-container">
                <i class="sl-icon-note"></i>
            </button>
            <?php endif; ?>

            <!--send email-->
            <button type="button" title="<?php echo app('translator')->get('lang.send_email'); ?>"
                class="data-toggle-action-tooltip btn btn-outline-warning btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" 
                data-target="#commonModal"
                data-url="<?php echo e(url('/appwebmail/compose?view=modal&webmail_template_type=clients&resource_type=client&resource_id='.$client->client_id)); ?>"
                data-loading-target="commonModalBody" 
                data-modal-title="<?php echo app('translator')->get('lang.send_email'); ?>"
                data-action-url="<?php echo e(url('/appwebmail/send')); ?>"
                data-action-method="POST"
                data-modal-size="modal-xl"
                data-action-ajax-loading-target="clients-td-container">
                <i class="ti-email display-inline-block m-t-3"></i>
            </button>

            <a href="/clients/<?php echo e($client->client_id ?? ''); ?>" class="btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>
        </span>
        <!--action button-->
        <!--more button (hidden)-->
        <span class="list-table-action dropdown hidden font-size-inherit">
            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="btn btn-outline-default-light btn-circle btn-sm">
                <i class="ti-more"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <a class="dropdown-item" href="javascript:void(0)">
                    <i class="ti-new-window"></i> <?php echo e(cleanLang(__('lang.view_details'))); ?></a>
            </div>
        </span>
        <!--more button-->
    </td>
    <?php endif; ?>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/clients/components/table/ajax.blade.php ENDPATH**/ ?>