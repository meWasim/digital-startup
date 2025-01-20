<div class="container py-md-3" id="contact-us">
    <div class="row">
        <h2 class="page-header w-100 d-block text-center pb-3"><?php echo htmlspecialchars($contact->title ?? 'Contact Us'); ?></h2>
    </div>
    <div class="row contact-bg py-md-4 px-md-5 pl-2 py-3 mb-md-4">
        <div class="col-md-6 col-sm-6 pl-0">
            <h3 class="d-block text-center pb-2"><?php echo htmlspecialchars($contact->company_name ?? 'Your Company Name'); ?></h3>
            <p class="d-block text-center mb-1" style="font-size:17px;">
                <b>CIN No:</b> <?php echo htmlspecialchars($contact->cin_no ?? 'Default CIN'); ?>
            </p>
            <p class="d-block text-center mb-1" style="font-size:17px;">
                <b>Registration No:</b> <?php echo htmlspecialchars($contact->registration_no ?? 'Default Reg No'); ?>
            </p>
            <p class="d-block text-center mb-1">
                <i class="fa fa-map-marker mr-2" aria-hidden="true"></i><?php echo htmlspecialchars($contact->address ?? 'Your Address'); ?>
            </p>
            <p class="d-block text-center mb-1">
                <i class="fa fa-envelope-o mr-2" aria-hidden="true"></i>
                <a href="mailto:<?php echo htmlspecialchars($contact->email ?? 'info@yourdomain.com'); ?>"><?php echo htmlspecialchars($contact->email ?? 'info@yourdomain.com'); ?></a>
            </p>
            <p class="d-block text-center mb-4">
                <i class="fa fa-phone mr-2" aria-hidden="true"></i>
                <a href="tel:<?php echo htmlspecialchars($contact->phone ?? '+91 0000000000'); ?>"><?php echo htmlspecialchars($contact->phone ?? '+91 0000000000'); ?></a>
            </p>
            <div class="col-md-12 col-sm-12">
                <div class="row map-bdr p-2">
                    <iframe src="<?php echo htmlspecialchars($contact->map_embed_url ?? 'https://maps.google.com'); ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 pl-md-2 pl-0 ftr-frm">

            <form action="<?php echo htmlspecialchars($formAction ?? '/contact-submit'); ?>" method="POST">

                <div class="form-group mb-2">
                    <label for="usr">Name *</label>
                    <input type="text" class="form-control form-filed" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group mb-2">
                    <label for="address">Address</label>
                    <input type="text" class="form-control form-filed" name="address" placeholder="Enter your address">
                </div>
                <div class="form-group form-md mb-2">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control form-filed" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group form-md mb-2">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control form-filed" name="phone" placeholder="Enter your phone number">
                </div>
                <div class="form-group mb-2">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control form-filed" name="subject" placeholder="Type the subject">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control textarea" rows="4" name="message" placeholder="Type your message here"></textarea>
                </div>
                <button type="submit" class="btn subBtn">Submit</button>
            </form>
        </div>
    </div>
</div>