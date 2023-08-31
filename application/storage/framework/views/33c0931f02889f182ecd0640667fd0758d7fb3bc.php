<!--chat left -->
<?php if($message->message_creatorid != auth()->user()->id): ?>
<li id="<?php echo e(messageUniqueID($message->message_unique_id)); ?>" class="messages_message">
    <div class="chat-img"><img src="<?php echo e(getUsersAvatar($message->avatar_directory, $message->avatar_filename)); ?>"
            alt="user" />
    </div>
    <div class="chat-content">
        <h5>
            <?php if($message->first_name): ?>
            <?php echo e($message->first_name  .' '. $message->last_name); ?>

            <?php else: ?>
            runtimeUnkownUser()
            <?php endif; ?>
        </h5>
        <div class="box message-content-box <?php echo e('message_type_'.$message->message_file_type); ?> bg-light-info">
            <div class="message-content">
                <!--text-->
                <?php if($message->message_type == 'text'): ?>
                <div class="x-text">
                    <?php echo _clean($message->message_text); ?>

                </div>
                <?php endif; ?>
                <!--file-->
                <?php if($message->message_type == 'file' && $message->message_file_type == 'file'): ?>
                <div class="x-file">
                    <a href="<?php echo e(url('storage/files/'.$message->message_file_directory.'/'.$message->message_file_name)); ?>"
                        download>
                        <i class="sl-icon-paper-clip"></i> <span><?php echo e($message->message_file_name); ?></span>
                    </a>
                </div>
                <?php endif; ?>
                <!--image-->
                <?php if($message->message_type == 'file' && $message->message_file_type == 'image'): ?>
                <div class="x-image">
                    <a href="<?php echo e(url('storage/files/'.$message->message_file_directory.'/'.$message->message_file_name)); ?>"
                        download>
                        <img src="<?php echo e(url('storage/files/'.$message->message_file_directory.'/'.$message->message_file_thumb_name)); ?>"
                            alt="<?php echo e($message->message_file_name); ?>" />
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <!--meta-->
            <div class="x-meta">
                <!--delete button-->
                <?php if(auth()->user()->is_admin): ?>
                <span id="message_delete_button_<?php echo e($message->message_id); ?>"
                    class="text-danger messages_delete_button hidden x-left-side"
                    data-message-id="<?php echo e(messageUniqueID($message->message_unique_id)); ?>" data-progress-bar="hidden"
                    data-ajax-type="DELETE" data-url="<?php echo e(url('/messages/'.$message->message_unique_id)); ?>">
                    <i class="sl-icon-trash"></i>
                </span>
                <?php endif; ?>
                <span class="time"><?php echo e(runtimeDateAgo($message->message_created)); ?></span>
            </div>
        </div>
    </div>
</li>
<?php endif; ?>

<!--chat right -->
<?php if($message->message_creatorid == auth()->user()->id): ?>
<li class="reverse" id="<?php echo e(messageUniqueID($message->message_unique_id)); ?>">
    <div class="chat-content my-chat-content">
        <div class="box message-content-box bg-light-inverse <?php echo e('message_type_'.$message->message_file_type); ?>">
            <div class="message-content">
                <!--text-->
                <?php if($message->message_type == 'text'): ?>
                <div class="x-text">
                    <?php echo _clean($message->message_text); ?>

                </div>
                <?php endif; ?>
                <!--file-->
                <?php if($message->message_type == 'file' && $message->message_file_type == 'file'): ?>
                <div class="x-file">
                    <a href="<?php echo e(url('storage/files/'.$message->message_file_directory.'/'.$message->message_file_name)); ?>"
                        download>
                        <i class="sl-icon-paper-clip"></i> <span><?php echo e($message->message_file_name); ?></span>
                    </a>
                </div>
                <?php endif; ?>
                <!--image-->
                <?php if($message->message_type == 'file' && $message->message_file_type == 'image'): ?>
                <div class="x-image">
                    <a href="<?php echo e(url('storage/files/'.$message->message_file_directory.'/'.$message->message_file_name)); ?>"
                        download>
                        <img src="<?php echo e(url('storage/files/'.$message->message_file_directory.'/'.$message->message_file_thumb_name)); ?>"
                            alt="<?php echo e($message->message_file_name); ?>" />
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <!--meta-->
            <div class="x-meta">
                <!--delete button-->
                <span id="message_delete_button_<?php echo e($message->message_id); ?>"
                    class="text-danger messages_delete_button hidden x-right-side"
                    data-message-id="<?php echo e(messageUniqueID($message->message_unique_id)); ?>" data-progress-bar="hidden"
                    data-ajax-type="DELETE" data-url="<?php echo e(url('/messages/'.$message->message_unique_id)); ?>">
                    <i class="sl-icon-trash"></i>
                </span>
                <span class="time"><?php echo e(runtimeDateAgo($message->message_created)); ?></span>
            </div>
        </div>
    </div>
</li>
<?php endif; ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/messages/ajax.blade.php ENDPATH**/ ?>