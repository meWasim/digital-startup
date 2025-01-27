<?php $__env->startSection('title', 'Blogs - Digital Startups'); ?>

<?php $__env->startSection('content'); ?>
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2>Blogs</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Blogs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Blogs List</h3>
                <a href="<?php echo e(route('blogs.create')); ?>" class="btn btn-primary">Create New Blog</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Featured Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                
                                <td><?php echo e($blog->title); ?></td>
                                <td><?php echo e($blog->author); ?></td>
                                <td>
                                    <?php if($blog->featured_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" alt="Featured Image" class="img-thumbnail" style="width: 100px; height: auto;">
                                    <?php else: ?>
                                        <span class="text-muted">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="<?php echo e(route('blogs.edit', $blog->id)); ?>" class="btn btn-warning btn-sm mr-2">Edit</a>

                                        <a href="<?php echo e(route('blogs.show', $blog->id)); ?>" class="btn btn-info btn-sm mr-2">Preview</a>

                                        <form action="<?php echo e(route('blogs.destroy', $blog->id)); ?>" method="POST"
                                            style="display:inline-block;" id="delete-form-<?php echo e($blog->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete(<?php echo e($blog->id); ?>)">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center">No blogs available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this blog?')) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/blogs/index.blade.php ENDPATH**/ ?>