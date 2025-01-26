<?php $__env->startSection('title', 'Permissions - Digital Startups'); ?>
<?php $__env->startSection('content'); ?>
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Permissions</h2>
                </div>
                <!-- Breadcrumb -->
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Permissions</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="row">
                <!-- Create Permission Button -->
                <div class="col-md-12 mb-3 text-right">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Permissions List</h3>
                        <!-- Trigger the Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#createPermissionModal">
                            Create Permission
                        </button>
                    </div>
                </div>

                <!-- Permissions List Section -->
                <div class="col-md-12">
                    <div class="about w-100">
                        <!-- List of Permissions -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Permission Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($permission->name); ?></td>
                                            <td><?php echo e($permission->description); ?></td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <!-- Edit Button -->
                                                    <a href="<?php echo e(route('permissions.edit', $permission->id)); ?>" class="btn btn-warning btn-sm mr-2">Edit</a>

                                                    <!-- Delete Button -->
                                                    <form id="delete-form-<?php echo e($permission->id); ?>" action="<?php echo e(route('permissions.destroy', $permission->id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo e($permission->id); ?>)">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>


                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo $__env->make('role-permission.permission.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        // JavaScript to trigger and populate the Edit modal with current data
        document.addEventListener('DOMContentLoaded', function() {
            // Get the Edit buttons
            var editButtons = document.querySelectorAll('[data-bs-toggle="modal"]');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the data attributes
                    var permissionId = this.getAttribute('data-id');
                    var permissionName = this.getAttribute('data-name');
                    var permissionDescription = this.getAttribute('data-description');

                    // Set the modal fields to the current permission data
                    var modal = document.getElementById('editPermissionModal');
                    modal.querySelector('#name').value = permissionName;
                    modal.querySelector('#description').value = permissionDescription;
                    modal.querySelector('form').action = '/permissions/' +
                    permissionId; // Dynamically set the form action
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\91911\OneDrive\Desktop\digitalstartup\digital-startup\resources\views/role-permission/permission/index.blade.php ENDPATH**/ ?>