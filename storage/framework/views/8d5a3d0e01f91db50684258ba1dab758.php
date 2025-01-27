<?php $__env->startSection('title', 'Blog - Digital Startups'); ?>
<?php $__env->startSection('content'); ?>
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
         <div class="row">
             <div class="col-md-6 col-sm-6">
                 <h2 class="d-block">Blog</h2>
             </div>
             <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                  <ul class="breadcrumb mb-0 pl-1">
                       <li><a href="/">Home</a></li>
                       <li>Blog</li>
                   </ul>
             </div>
         </div>
    </div>
</section>
<section class="blog-bg w-100 d-block py-md-5 py-3">
  <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="<?php echo e(route('blog')); ?>" method="GET" class="form-inline">
                    <div class="form-group mr-3">
                        <label for="filterTitle" class="mr-2">Title</label>
                        <input type="text" name="title" id="filterTitle" value="<?php echo e(request('title')); ?>" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="form-group mr-3">
                        <label for="filterAuthor" class="mr-2">Author</label>
                        <input type="text" name="author" id="filterAuthor" value="<?php echo e(request('author')); ?>" class="form-control" placeholder="Enter author">
                    </div>
                    <div class="form-group mr-3">
                        <label for="filterDate" class="mr-2">Date</label>
                        <input type="date" name="date" id="filterDate" value="<?php echo e(request('date')); ?>" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo e(route('blog')); ?>" class="btn btn-secondary ml-2">Clear</a>
                </form>
            </div>
        </div>
        <!-- Blogs List -->
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-sm-6 mb-4">
                 <div class="blog w-100">
                     <div class="blogImg position-relative">
                       <div class="blog-date position-absolute">
                            <span><?php echo e($blog->created_at->format('d')); ?></span>
                            <dd><?php echo e($blog->created_at->format('M Y')); ?></dd>
                       </div>
                       <img src="<?php echo e($blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default-blog.jpg')); ?>" alt="<?php echo e($blog->title); ?>">
                     </div>
                     <h2 class="d-block pt-5 pb-3"><?php echo e($blog->title); ?></h2>
                     <p>
                         <?php echo e(Str::limit(strip_tags($blog->content), 150)); ?>

                         <a href="<?php echo e(route('blog.detail', $blog->slug)); ?>" class="more-info ml-2">Read More</a>
                     </p>
                 </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center">
                <p>No blogs available at the moment.</p>
            </div>
            <?php endif; ?>
        </div>
 </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/pages/blog.blade.php ENDPATH**/ ?>