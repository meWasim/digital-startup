<?php $__env->startSection('title', 'Create Role - Digital Startups'); ?>
<?php $__env->startSection('content'); ?>
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-md-6 col-sm-6">
                <h2>Create Role</h2>
            </div>
            <!-- Breadcrumb -->
            <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                <ul class="breadcrumb mb-0 pl-1">
                    <li><a href="/">Home</a></li>
                    <li><a href="<?php echo e(route('roles.index')); ?>">Roles</a></li>
                    <li>Create Role</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="about-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <!-- Create Role Form -->
        <div class="card">
            <div class="card-header">
                <h4>Create New Role</h4>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('roles.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Role Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Permissions Checkbox List -->
                    <div class="mb-3">
                        <label for="permissions" class="form-label">Permissions</label>
                        <div class="row">
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>">
                                        <label class="form-check-label"><?php echo e($permission->name); ?></label>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/role-permission/role/create.blade.php ENDPATH**/ ?>