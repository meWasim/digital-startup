<?php $__env->startSection('title', 'Home - Digital Startups'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.partials.domain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.partials.get-website', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <section class="web-demo-Area w-100 d-block py-md-4 py-2">
        <div class="container-fluid" style="width:90%;">
            <div class="row">
                <div class="chse-tmpl w-100 d-block text-center pb-md-3">Choose a Free Stunning Template</div>

                <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-3 col-sm-3 p-md-3 pl-2 pr-3 pt-0 pb-1">
                        <div class="webImg">
                            <div class="webTemp position-relative">
                                <a href="#" class="favourite"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                <img src="<?php echo e(asset('thumbnails/' . basename($template->thumbnail))); ?>" alt="<?php echo e($template->name); ?>">
                            </div>
                            <div class="webArea position-relative py-4 px-3">
                                <div class="title w-100 d-block text-left position-absolute pl-3">
                                    <?php echo e($template->name); ?>

                                </div>
                                <div class="rupee-sym w-100 d-block text-left position-absolute pl-3">
                                    ₹ Free
                                </div>
                                <div class="web-demo w-100 d-block text-right position-absolute pr-3">
                                    <a class="web-cart ml-2" href="javascript:void(0);" data-template-id="<?php echo e($template->id); ?>">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </a>
                                    
                                    <a href="<?php echo e(url('template-preview/' . $template->folder)); ?>" target="_blank" class="prev-box">Preview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-md-3 col-sm-3 p-md-3 pl-2 pr-3 pt-0 pb-1">
                    No template available
                </div>
                <?php endif; ?>



            </div>

            
        </div>
    </section>

    <script>
        $(document).ready(function () {
            // Handling click event on Add to Cart button
            $('.web-cart').on('click', function () {
                // Retrieve template ID from the data-template-id attribute
                var templateId = $(this).data('template-id');

                // SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Add to Cart?',
                    text: 'Do you want to add this template to your cart?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, add to cart!',
                    cancelButtonText: 'No, thanks',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request to add to cart
                        $.ajax({
                            url: '/add-to-cart',  // Change to your route
                            method: 'POST',
                            data: {
                                template_id: templateId,  // Send template ID
                                _token: '<?php echo e(csrf_token()); ?>' // CSRF token
                            },
                            success: function(response) {
                                // On success, show confirmation message
                                Swal.fire(
                                    'Added!',
                                    'Template has been added to your cart.',
                                    'success'
                                );
                            },
                            error: function() {
                                // On failure, show error message
                                Swal.fire(
                                    'Oops...',
                                    'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
    <?php echo $__env->make('layouts.partials.whyChooseUs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.partials.ourService', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.partials.googleReview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/home.blade.php ENDPATH**/ ?>