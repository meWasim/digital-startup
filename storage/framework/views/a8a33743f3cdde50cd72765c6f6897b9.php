<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Your Cart</h2>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 col-sm-3 p-md-3 pl-2 pr-3 pt-0 pb-1">
                <div class="webImg">
                    <div class="webTemp position-relative">
                        <img src="<?php echo e(asset($template->thumbnail)); ?>" alt="<?php echo e($template->name); ?>">
                    </div>
                    <div class="webArea position-relative py-4 px-3">
                        <div class="title w-100 d-block text-left position-absolute pl-3">
                            <?php echo e($template->name); ?></div>
                        <div class="rupee-sym w-100 d-block text-left position-absolute pl-3">
                            ₹ Free</div>
                    </div>
                    <div class="web-demo w-100 d-block text-right position-absolute pr-3">
                        <a href="<?php echo e(url('user/template-preview/' . $template->folder)); ?>" target="_blank" class="btn btn-info btn-sm">Preview</a>
                        <a href="<?php echo e(route('template.edit', $template->id)); ?>" class="btn btn-warning ml-2">Edit</a>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
    <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Back to Home</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\mywork\vivek startup\digital-startup\resources\views/cart/index.blade.php ENDPATH**/ ?>