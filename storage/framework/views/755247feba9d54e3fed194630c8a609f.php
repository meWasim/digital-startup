<?php $__env->startSection('title', 'Contact Us - Digital Startups'); ?>
<?php $__env->startSection('content'); ?>
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Contact Us</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <form action="<?php echo e(route('contacts.store')); ?>" method="POST" id="contactForm">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control form-field" placeholder="Full Name" name="name"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-field" placeholder="Email Address" name="email"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-field" placeholder="Contact Number"
                                name="contact" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-field" rows="5" name="message" placeholder="Message" style="resize: none;"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn form-field-Btn w-100">Send Message</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="col-md-12 col-sm-12">
                        <ul class="cont-addres w-100 d-block pl-0 mb-md-0">
                            <h5 class="d-flex pb-2">Registered Office:</h5>
                            <li>
                                <dd><i class="fa fa-map-marker mr-2" aria-hidden="true"></i></dd>PS Srijan Corporate Park,
                                Unit No-406, 4th<br />
                                Floor, Tower-2, Plot No-G-2, Block-GP,<br>Sector-V, North 24 Parganas, Salt
                                Lake<br />Kolkata - 700091,West Bengal India
                            </li>
                            <li>
                                <dd><i class="fa fa-phone mr-2" aria-hidden="true"></i></dd><a href="tel:+918100118818">+91
                                    8100118818</a>
                            </li>
                            <li>
                                <dd><i class="fa fa-whatsapp mr-2"></i></dd><a
                                    href="https://web.whatsapp.com/send?phone=+918100118818&amp;text=Hi, I would like to get more information..">+91
                                    8100118818</a>
                            </li>
                            <li>
                                <dd><i class="fa fa-envelope ftr-email mr-2" aria-hidden="true"></i></dd><a
                                    href="mailto:info@digitalstartups.in">info@digitalstartups.in</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-sm-12 map-bdr mt-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.271723446122!2d88.43218402616282!3d22.568938383102896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02758c8cfff887%3A0xc7105a534d628380!2sPS%20Srijan%20Corporate%20Park!5e0!3m2!1sen!2sin!4v1727070490545!5m2!1sen!2sin"
                            width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\mywork\vivek startup\digital-startup\resources\views/pages/contactUs.blade.php ENDPATH**/ ?>