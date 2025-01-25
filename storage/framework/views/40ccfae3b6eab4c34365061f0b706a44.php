<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Edit Template</h2>
    <form method="POST" action="<?php echo e(route('template.update', $templateId)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Header</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="home_url">Home URL</label>
                    <input type="text" name="header[home_url]" id="home_url" class="form-control" value="<?php echo e($header->home_url ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="logo_text">Logo Text</label>
                    <input type="text" name="header[logo_text]" id="logo_text" class="form-control" value="<?php echo e($header->logo_text ?? ''); ?>">
                </div>

                <!-- Menu Links -->
                <div class="form-group">
                    <label>Menu Links</label>
                    <div id="menu-links-container">
                        <?php $__currentLoopData = $header->menu_links ?? [['url' => '', 'text' => '']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="menu-link-item border p-3 mb-3 rounded">
                                <div class="form-group">
                                    <label for="menu_url_<?php echo e($index); ?>">Menu URL</label>
                                    <input type="text" name="header[menu_links][<?php echo e($index); ?>][url]" id="menu_url_<?php echo e($index); ?>" class="form-control" value="<?php echo e($menu['url'] ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="menu_text_<?php echo e($index); ?>">Menu Text</label>
                                    <input type="text" name="header[menu_links][<?php echo e($index); ?>][text]" id="menu_text_<?php echo e($index); ?>" class="form-control" value="<?php echo e($menu['text'] ?? ''); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="form-group">
                    <label>Social Links</label>
                    <div id="social-links-container">
                        <?php $__currentLoopData = $header->social_links ?? [['url' => '', 'icon' => '']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="social-link-item border p-3 mb-3 rounded">
                                <div class="form-group">
                                    <label for="social_url_<?php echo e($index); ?>">Social URL</label>
                                    <input type="text" name="header[social_links][<?php echo e($index); ?>][url]" id="social_url_<?php echo e($index); ?>" class="form-control" value="<?php echo e($social['url'] ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="social_icon_<?php echo e($index); ?>">Social Icon Class</label>
                                    <input type="text" name="header[social_links][<?php echo e($index); ?>][icon]" id="social_icon_<?php echo e($index); ?>" class="form-control" value="<?php echo e($social['icon'] ?? ''); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="header[phone_number]" id="phone_number" class="form-control" value="<?php echo e($header->phone_number ?? ''); ?>">
                </div>

                <!-- Image Upload Fields -->
                <div class="form-group">
                    <label for="header_logo">Header Logo</label>
                    <input type="file" name="header[logo]" id="header_logo" class="form-control">
                    <?php if($header && $header->logo): ?>
                    <div class="mt-2">
                        <img src="<?php echo e(asset('storage/' . $header->logo)); ?>" alt="Logo" class="img-fluid" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- About Us Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>About Us</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="ourStory">Our Story</label>
                    <textarea name="our_story" id="ourStory" class="form-control" rows="3"><?php echo e($aboutUs->our_story ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="mission">Mission</label>
                    <textarea name="mission" id="mission" class="form-control" rows="3"><?php echo e($aboutUs->mission ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="vision">Vision</label>
                    <textarea name="vision" id="vision" class="form-control" rows="3"><?php echo e($aboutUs->vision ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Services</h4>
            </div>
            <div class="card-body">
                <?php $__currentLoopData = range(0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $service = $services[$index] ?? null; ?>
                    <div class="service-item border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="service_title_<?php echo e($index); ?>">Service Title</label>
                            <input type="text" name="services[<?php echo e($index); ?>][title]" id="service_title_<?php echo e($index); ?>" class="form-control" value="<?php echo e($service->title ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="service_subtitle_<?php echo e($index); ?>">Service Subtitle</label>
                            <input type="text" name="services[<?php echo e($index); ?>][subtitle]" id="service_subtitle_<?php echo e($index); ?>" class="form-control" value="<?php echo e($service->subtitle ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="service_image_<?php echo e($index); ?>">Service Image</label>
                            <input type="file" name="services[<?php echo e($index); ?>][image]" id="service_image_<?php echo e($index); ?>" class="form-control">
                            <?php if($service && $service->image_path): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(asset('storage/' . $service->image_path)); ?>" alt="Service Image" class="img-fluid" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
<!-- Blog Section -->
<h3>Our Blog</h3>
<div class="form-group">
    <label>Blog Posts</label>
    <div id="blog-container">
        <?php $__currentLoopData = $header->blog_posts ?? [['title' => '', 'image_url' => '', 'published_at' => '', 'content' => '']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="blog-post-item border p-3 mb-3">
            <div class="form-group">
                <label for="blog_title_<?php echo e($index); ?>">Blog Title</label>
                <input type="text" name="header[blog_posts][<?php echo e($index); ?>][title]" id="blog_title_<?php echo e($index); ?>" class="form-control" value="<?php echo e($post['title'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="blog_image_<?php echo e($index); ?>">Blog Image</label>
                <input type="file" name="header[blog_posts][<?php echo e($index); ?>][image]" id="blog_image_<?php echo e($index); ?>" class="form-control">
                <?php if(isset($post['image_url'])): ?>
                    <img src="<?php echo e(asset('storage/' . $post['image_url'])); ?>" alt="<?php echo e($post['title'] ?? 'Blog Image'); ?>" class="mt-2" style="max-width: 100px;">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="blog_published_at_<?php echo e($index); ?>">Published Date</label>
                <input type="date" name="header[blog_posts][<?php echo e($index); ?>][published_at]" id="blog_published_at_<?php echo e($index); ?>" class="form-control" value="<?php echo e($post['published_at'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="blog_content_<?php echo e($index); ?>">Blog Content</label>
                <textarea name="header[blog_posts][<?php echo e($index); ?>][content]" id="blog_content_<?php echo e($index); ?>" class="form-control" rows="3"><?php echo e($post['content'] ?? ''); ?></textarea>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
        <!-- Features Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Features</h4>
            </div>
            <div class="card-body">
                <?php $__currentLoopData = range(0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $feature = $features[$index] ?? null; ?>
                    <div class="feature-item border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="feature_title_<?php echo e($index); ?>">Feature Title</label>
                            <input type="text" name="features[<?php echo e($index); ?>][title]" id="feature_title_<?php echo e($index); ?>" class="form-control" value="<?php echo e($feature->title ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="feature_description_<?php echo e($index); ?>">Feature Description</label>
                            <textarea name="features[<?php echo e($index); ?>][description]" id="feature_description_<?php echo e($index); ?>" class="form-control" rows="3"><?php echo e($feature->description ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="feature_image_<?php echo e($index); ?>">Feature Image</label>
                            <input type="file" name="features[<?php echo e($index); ?>][image]" id="feature_image_<?php echo e($index); ?>" class="form-control">
                            <?php if($feature && $feature->image_path): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(asset('storage/' . $feature->image_path)); ?>" alt="Feature Image" class="img-fluid" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary btn-lg">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/templates/edit-page.blade.php ENDPATH**/ ?>