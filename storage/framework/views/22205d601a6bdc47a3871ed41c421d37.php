<?php $__env->startSection('title', 'Login - Digital Startups'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container blue-bg-mt py-md-5 pt-3">
        <div class="row w-100 d-block text-center">
            <h2 class="header-txt pb-3 mb-md-4 mb-3">Login or Create an Account</h2>
        </div>
        <div class="row d-flex flex-wrap justify-content-center mb-4">
            <div class="col-md-4 col-sm-4 crt-act-bg p-3">
                <p class="w-100 text-center">Already registered?</p>
                <p class="w-100 text-center">If you have an account with us, please log in.</p>
                <div class="col-md-12">
                    <form method="POST" id="loginFrm" action="<?php echo e(route('login')); ?>" class="mb-3">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control crt-act-fild <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="email" placeholder="Email Address" name="email" value="<?php echo e(old('email')); ?>"
                                required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control crt-act-fild <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="password" placeholder="Enter password" name="password" required>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <a href="<?php echo e(route('password.request')); ?>" class="forgot pb-3">Forgot Your Password?</a>
                        <button type="submit" class="btn crtBtn mb-1" id="loginButton">Login</button>
                        <div class="crt-act-line mt-4"></div>
                        <p class="w-100 text-center pt-3">New Here?</p>
                        <a href="<?php echo e(route('register')); ?>" class="crtBtn" style="line-height: 30px;">Create an Account</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\mywork\vivek startup\digital-startup\resources\views/auth/login.blade.php ENDPATH**/ ?>