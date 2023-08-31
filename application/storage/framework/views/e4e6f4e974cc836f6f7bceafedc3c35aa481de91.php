 <?php $__env->startSection('content'); ?>
<!--signup-->
<div class="login-logo m-t-30 p-b-5">
    <a href="javascript:void(0)" class="text-center db">
        <img src="<?php echo e(runtimeLogoLarge()); ?>" alt="Home">
    </a>
</div>

<div class="login-box m-t-20">
    <form class="form-horizontal form-material" id="resetPasswordForm" action="index.html">
        <div class="title">
            <h3 class="box-title m-t-10 text-center"><?php echo e(cleanLang(__('lang.reset_password'))); ?></h3>
            <div class="text-center  m-b-20 ">
                <small><?php echo e(cleanLang(__('lang.enter_new_password'))); ?></small>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Cofirm Password">
            </div>
        </div>
        <div class="form-group text-center p-b-10">
            <div class="col-xs-12">
                <!--reset code-->
                <input type="hidden" name="token" value="<?php echo e(request('token')); ?>">
                <button class="btn btn-info btn-lg btn-block" id="resetPasswordSubminButton"
                    data-button-loading-annimation="yes" data-button-disable-on-click="yes"
                    data-url="<?php echo e(url('resetpassword')); ?>" data-ajax-type="POST" data-loading-target=""
                    data-loading-class="loading" type="submit"><?php echo e(cleanLang(__('lang.reset_password'))); ?></button>
            </div>
        </div>
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                <a href="<?php echo e(url('login')); ?>" class="text-info m-l-5 js-toggle-login-forms"
                    data-target="login-forms-login">
                    <b><?php echo e(cleanLang(__('lang.back_to_login'))); ?></b>
                </a>
                </p>
            </div>
        </div>
    </form>
</div>

<div class="login-background">
    <div class="x-left">
        <img src="<?php echo e(url('/')); ?>/public/images/login-1.png"  class="login-images" />
    </div>
    <div class="x-right hidden">
        <img src="<?php echo e(url('/')); ?>/public/images/login-2.png" alt="404 - Not found" />
    </div>
</div>
<!--signup-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapperplain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/arttto74/artt.top/application/resources/views/pages/authentication/resetpassword.blade.php ENDPATH**/ ?>