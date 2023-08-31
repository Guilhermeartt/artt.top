 <!--table-->
    <div class="card count-<?php echo e(@count($files)); ?> files-table-wrapper" id="files-table-wrapper">
            <?php echo $__env->make('pages.files.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="table-responsive">       

                <?php if(@count($files ?? []) > 0): ?>
                <table id="files-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                    data-page-size="10">
                    <thead>
                        <tr>
                            <?php if(config('visibility.files_col_checkboxes')): ?>
                            <th class="list-checkbox-wrapper">
                                <!--list checkbox-->
                                <span class="list-checkboxes display-inline-block w-px-20">
                                    <input type="checkbox" id="listcheckbox-files" name="listcheckbox-files"
                                        class="listcheckbox-all filled-in chk-col-light-blue"
                                        data-actions-container-class="files-checkbox-actions-container"
                                        data-children-checkbox-class="listcheckbox-files">
                                    <label for="listcheckbox-files"></label>
                                </span>
                            </th>
                            <?php endif; ?>
                            <th class="files_col_file"><?php echo e(cleanLang(__('lang.preview'))); ?></th>
                            <th class="files_col_file_name"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_file_filename" href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/files?action=sort&orderby=file_filename&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.file_name'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                            <th class="files_col_added_by"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_added_by" href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/files?action=sort&orderby=added_by&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.uploaded_by'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="files_col_size"><a class="js-ajax-ux-request js-list-sorting" id="sort_file_size"
                                    href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/files?action=sort&orderby=file_size&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.size'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="files_col_date"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_file_created" href="javascript:void(0)"
                                    data-url="<?php echo e(urlResource('/files?action=sort&orderby=file_created&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.date'))); ?><span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="files_col_action"><a
                                    href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                        </tr>
                    </thead>
                    <tbody id="files-td-container">
                        <!--ajax content here-->
                        <?php echo $__env->make('pages.files.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <!--ajax content here-->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                <!--load more button-->
                                <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <!--load more button-->

                                <!--move folders - target id-->
                                <input type="hidden" name="moving_target_folder_id" id="moving_target_folder_id">
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <?php endif; ?> <?php if(@count($files ?? []) == 0): ?>
                <!--nothing found-->
                <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--nothing found-->
                <?php endif; ?>
            </div>
        </div>
    </div><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/files/components/table/table-wrapper.blade.php ENDPATH**/ ?>