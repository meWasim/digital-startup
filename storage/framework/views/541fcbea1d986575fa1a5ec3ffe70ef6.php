<?php $__env->startSection('title', $blog->title . ' - Digital Startups'); ?>

<?php $__env->startSection('content'); ?>
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2><?php echo e($blog->title); ?></h2>
            </div>
            <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                <ul class="breadcrumb mb-0 pl-1">
                    <li><a href="/">Home</a></li>
                    <li><a href="<?php echo e(route('blog')); ?>">Blogs</a></li>
                    <li><?php echo e($blog->title); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="blog-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="blog w-100">
                    <div class="blogdetilsImg">
                        <img src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" alt="<?php echo e($blog->title); ?>" class="img-fluid">
                    </div>
                    <ul class="post pl-0 pt-3">
                        <li class="mr-2">
                            <i class="fa fa-calendar mr-1" aria-hidden="true"></i><?php echo e($blog->created_at->format('d/m/Y H:i:s')); ?>

                        </li>
                        <li class="mr-2">
                            <i class="fa fa-user mr-1" aria-hidden="true"></i>Posted by <?php echo e($blog->author ?? 'Admin'); ?>

                        </li>
                        <li class="mr-1">Share this:</li>
                        <li>
                            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li class="mr-1">
                            <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li class="mr-1">
                            <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li class="mr-1">
                            <a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <h2 class="d-block pb-3"><?php echo e($blog->title); ?></h2>
                    <p class="d-block blog-content">   <?php echo $blog->content; ?></p>

                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="popular-pst">
                    <h2 class="d-block pb-md-5 pb-3">POPULAR POSTS</h2>
                    <ul class="d-block">
                        <?php $__currentLoopData = $popularBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="d-block position-relative mb-4">
                            <dd>
                                <img src="<?php echo e(asset('storage/' . $popular->featured_image)); ?>" alt="<?php echo e($popular->title); ?>" class="img-fluid">
                            </dd>
                            <span class="d-block">
                                <a href="<?php echo e(route('blog.detail', $popular->slug)); ?>"><?php echo e($popular->title); ?></a>
                            </span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/pages/blog-detail.blade.php ENDPATH**/ ?>