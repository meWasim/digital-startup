<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $userId = auth()->id(); // Get the authenticated user ID
        $templateId = $request->input('template_id'); // Get the template ID from the request

        // Check if the user has already added this template to their cart
        $cartItem = Cart::where('user_id', $userId)
                        ->where('template_id', $templateId)
                        ->first();

        if ($cartItem) {
            return response()->json(['error' => 'This template is already in your cart.'], 400);
        }

        // Create a new cart item
        Cart::create([
            'user_id' => $userId,
            'template_id' => $templateId
        ]);

        // Fetch the template name from the database
        $template = Template::where('id', $templateId)->first();
        if (!$template) {
            return response()->json(['error' => 'Template not found.'], 404);
        }

        $templateName = $template->name; // Assuming 'name' column holds the folder name

        // Define source and destination paths
        $sourcePath = public_path("templates-master/$templateName");
        $destinationPath = public_path("templates-user/$templateName");

        // Check if the source folder exists
        if (!File::exists($sourcePath)) {
            return response()->json(['error' => 'Source template folder does not exist.'], 404);
        }

        // Check if the destination folder already exists
        if (File::exists($destinationPath)) {
            return response()->json(['error' => 'This template has already been added to your user folder.'], 400);
        }

        // Copy the template folder to templates-user
        if (!File::copyDirectory($sourcePath, $destinationPath)) {
            return response()->json(['error' => 'Failed to copy template folder.'], 500);
        }

        // Modify the necessary files for the user-specific template
        $this->makeAboutUsDynamic($destinationPath);
        $this->makeChooseUsDynamic($destinationPath);
        $this->makeTestimonialDynamic($destinationPath);
        $this->makeContactUsDynamic($destinationPath);
        $this->makeFooterDynamic($destinationPath);
        $this->makeHeaderDynamic($destinationPath,$templateName);
        $this->makeServicesDynamic($destinationPath);

        return response()->json(['success' => 'Template added to cart and updated successfully.']);
    }

protected function makeServicesDynamic($destinationPath)
{
    $servicePath = "$destinationPath/include/service.php";

    if (File::exists($servicePath)) {
        // Replace static content with dynamic placeholders
        $dynamicContent = '
        <div class="container py-3">
            <div class="row">
                <h2 class="page-header w-100 d-block text-center pb-3"><?= $content["page_title"] ?? "Our Services"; ?></h2>
            </div>
            <div class="row">
                <?php foreach ($content["services"] ?? [] as $service): ?>
                    <div class="col-md-4 col-sm-4 <?= $service["extra_class"] ?? ""; ?>">
                        <div class="servs w-100">
                            <div class="zoom-effect-container">
                                <div class="image-card">
                                    <img src="<?= $service["image_url"] ?? "/default-image.jpg"; ?>" alt="<?= $service["title"] ?? "Service"; ?>">
                                </div>
                            </div>
                            <div class="service-info w-100 d-block p-md-5 p-3">
                                <h4 class="d-block text-center pb-md-3"><?= $service["title"] ?? "Service Title"; ?></h4>
                                <h5 class="d-block text-center"><?= $service["subtitle"] ?? "Service Subtitle"; ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>';

        // Write the dynamic content back to the file
        File::put($servicePath, $dynamicContent);
    } else {
        throw new \Exception("services.php not found in $destinationPath/include.");
    }
}


protected function makeHeaderDynamic($destinationPath, $templateName)
{
    $headerPath = "$destinationPath/include/header.php";

    if (File::exists($headerPath)) {
        // Prepare resolved menu links
        $menuLinks = [
            ["url" => asset("templates-user/$templateName/index.php"), "text" => "Home"],
            ["url" => asset("templates-user/$templateName/about-us.php"), "text" => "About Us"],
            ["url" => asset("templates-user/$templateName/services.php"), "text" => "Services"],
            ["url" => asset("templates-user/$templateName/blog.php"), "text" => "Blog"],
            ["url" => asset("templates-user/$templateName/contact-us.php"), "text" => "Contact Us"],
        ];

        // Convert menu links array to PHP code
        $menuLinksString = var_export($menuLinks, true);

        // Dynamic header content
        $dynamicContent = <<<EOD
        <section class="header-fixed">
            <div class="container header-top-bg w-100 d-block py-2">
                <div class="row hdr-menu">
                    <div class="col-md-2 col-sm-2 pl-0 pt-1">
                        <a href="<?= \$content["home_url"] ?? "/"; ?>" class="logo ml-4"><?= \$content["logo_text"] ?? "Your Logo"; ?></a>
                    </div>
                    <div class="col-md-5 col-m-5 d-flex flex-wrap justify-content-center pl-0 pr-0 mr-md-0 mr-3">
                        <nav class="navbar navbar-expand-md navbar-light sticky-top">
                            <div id="navcontainer" class="d-flex container justify-content-right align-items-end">
                                <div id="hamburger-wrapper">
                                    <div id="button-wrapper" class="d-flex szelesseg">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navcollapse" aria-controls="navcollapse" aria-expanded="false" aria-label="Toggle Navigation">
                                            <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                                        </button>
                                    </div>
                                    <div class="collapse navbar-collapse" id="navcollapse">
                                        <ul class="nav navbar-nav pl-0">
                                            <?php foreach (\$content["menu_links"] ?? $menuLinksString as \$menu): ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?= \$menu["url"] ?? "#"; ?>"><?= \$menu["text"] ?? "Link"; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <ul class="sMedia-top pt-md-2">
                            <?php foreach (\$content["social_links"] ?? [
                                ["url" => "https://facebook.com", "icon" => "fa fa-facebook"],
                                ["url" => "https://twitter.com", "icon" => "fa fa-twitter"],
                                ["url" => "https://instagram.com", "icon" => "fa fa-instagram"],
                                ["url" => "https://youtube.com", "icon" => "fa fa-youtube-play"]
                            ] as \$social): ?>
                                <li><a href="<?= \$social["url"] ?? "#"; ?>"><i class="<?= \$social["icon"] ?? "fa fa-link"; ?>" aria-hidden="true"></i></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 pt-2 pr-0">
                        <div class="topbar-link mr-4">
                            <ul>
                                <li>
                                    <a href="tel:<?= \$content["phone_number"] ?? "+91 0000000000"; ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?= \$content["phone_number"] ?? "+91 0000000000"; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        EOD;

        // Write the dynamic content back to the file
        File::put($headerPath, $dynamicContent);
    } else {
        throw new \Exception("header.php not found in $destinationPath/include.");
    }
}



protected function makeFooterDynamic($destinationPath)
{
    $footerPath = "$destinationPath/include/footer.php";

    if (File::exists($footerPath)) {
        // Replace static content with dynamic placeholders
        $dynamicContent = '
        <div class="container footer-bg w-100 d-block pt-3 mt-md-3">
            <div class="row pl-md-3">
                <div class="col-md-4 col-sm-4">
                    <h3 class="d-block pb-2 mb-3"><?= $content["about_us_title"] ?? "About Us"; ?></h3>
                    <p><?= $content["about_us_text"] ?? "Default about us text."; ?></p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <h3 class="d-block pb-2 mb-3"><?= $content["useful_links_title"] ?? "Useful Links"; ?></h3>
                    <ul class="usf-link pl-0">
                        <?php foreach ($content["useful_links"] ?? [] as $link): ?>
                            <li class="pb-1"><a href="<?= $link["url"] ?? "#"; ?>"><?= $link["text"] ?? "Link"; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="footer-logo pb-3">
                        <a href="#"><?= $content["footer_logo"] ?? "Your Logo"; ?></a>
                    </div>
                    <ul class="w-100 d-block pl-0">
                        <li class="pb-2"><i class="fa fa-envelope-o mr-2" aria-hidden="true"></i><a href="mailto:<?= $content["email"] ?? "info@yourdomain.com"; ?>"><?= $content["email"] ?? "info@yourdomain.com"; ?></a></li>
                        <li class="pb-2"><i class="fa fa-phone mr-2" aria-hidden="true"></i><a href="tel:<?= $content["phone"] ?? "+91 0000000000"; ?>"><?= $content["phone"] ?? "+91 0000000000"; ?></a></li>
                        <li><i class="fa fa-map-marker mr-2" aria-hidden="true"></i><?= $content["address"] ?? "Your Address"; ?></li>
                    </ul>
                </div>
            </div>
            <div class="row pt-md-5 pt-3 position-relative">
                <ul class="smedia position-absolute">
                    <?php foreach ($content["social_links"] ?? [] as $social): ?>
                        <li><a href="<?= $social["url"] ?? "#"; ?>" target="_blank"><i class="<?= $social["icon"] ?? "fa fa-link"; ?>" aria-hidden="true" style="font-size: 22px;"></i></a></li>
                    <?php endforeach; ?>
                </ul>
                <div class="ftr-line"></div>
            </div>
            <div class="row mt-4">
                <p class="w-100 d-block text-center">©<?= date("Y"); ?> <?= $content["footer_text"] ?? "Developed by:"; ?> <a href="<?= $content["developer_link"] ?? "#"; ?>" target="_blank"><?= $content["developer_name"] ?? "Your Developer"; ?></a></p>
            </div>
        </div>';

        // Write the dynamic content back to the file
        File::put($footerPath, $dynamicContent);
    } else {
        throw new \Exception("footer.php not found in $destinationPath/include.");
    }
}

protected function makeContactUsDynamic($destinationPath)
{
    $contactUsPath = "$destinationPath/include/contact-us.php";

    if (File::exists($contactUsPath)) {
        // Replace static content with dynamic placeholders
        $dynamicContent = '
        <div class="container py-md-3">
            <div class="row">
                <h2 class="page-header w-100 d-block text-center pb-3"><?= $content["title"] ?? "Contact Us"; ?></h2>
            </div>
            <div class="row contact-bg py-md-4 px-md-5 pl-2 py-3 mb-md-4">
                <div class="col-md-6 col-sm-6 pl-0">
                    <h3 class="d-block text-center pb-2"><?= $content["company_name"] ?? "Your Company Name"; ?></h3>
                    <p class="d-block text-center mb-1" style="font-size:17px;"><b>CIN No:</b> <?= $content["cin_no"] ?? "Default CIN"; ?></p>
                    <p class="d-block text-center mb-1" style="font-size:17px;"><b>Registration No:</b> <?= $content["registration_no"] ?? "Default Reg No"; ?></p>
                    <p class="d-block text-center mb-1"><i class="fa fa-map-marker mr-2" aria-hidden="true"></i><?= $content["address"] ?? "Your Address"; ?></p>
                    <p class="d-block text-center mb-1"><i class="fa fa-envelope-o mr-2" aria-hidden="true"></i><a href="mailto:<?= $content["email"] ?? "info@yourdomain.com"; ?>"><?= $content["email"] ?? "info@yourdomain.com"; ?></a></p>
                    <p class="d-block text-center mb-4"><i class="fa fa-phone mr-2" aria-hidden="true"></i><a href="tel:<?= $content["phone"] ?? "+91 0000000000"; ?>"><?= $content["phone"] ?? "+91 0000000000"; ?></a></p>
                    <div class="col-md-12 col-sm-12">
                        <div class="row map-bdr p-2">
                            <iframe src="<?= $content["map_embed_url"] ?? "https://maps.google.com"; ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 pl-md-2 pl-0 ftr-frm">
                    <form action="<?= $content["form_action"] ?? "/submit-contact"; ?>" method="POST">
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
        </div>';

        // Write the dynamic content back to the file
        File::put($contactUsPath, $dynamicContent);
    } else {
        throw new \Exception("contact-us.php not found in $destinationPath/include.");
    }
}

protected function makeTestimonialDynamic($destinationPath)
{
    $testimonialPath = "$destinationPath/include/testimonial.php";

    if (File::exists($testimonialPath)) {
        // Replace static content with dynamic placeholders
        $dynamicContent = '
        <div class="container pt-2 pb-3">
            <div class="row">
                <h2 class="page-header w-100 d-block text-center"><?= $content["title"] ?? "Testimonial"; ?></h2>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 client-bg mx-auto pt-4">
            <div class="p-md-2 paralax rounded position-relative">
                <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
                    <ol class="carousel-indicators mb-0">
                        <?php foreach ($content["testimonials"] ?? [] as $index => $testimonial): ?>
                            <li class="<?= $index === 0 ? "active" : ""; ?>" data-target="#carouselExampleIndicators" data-slide-to="<?= $index; ?>"></li>
                        <?php endforeach; ?>
                    </ol>
                    <div class="carousel-inner px-md-0 pb-4">
                        <?php foreach ($content["testimonials"] ?? [] as $index => $testimonial): ?>
                            <div class="carousel-item <?= $index === 0 ? "active" : ""; ?>">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <div class="testimonial w-100 d-block text-center px-md-5">
                                                <img src="<?= $testimonial["image_url"] ?? "/default-image.png"; ?>" alt="<?= $testimonial["name"] ?? "Client"; ?>">
                                                <h3 class="w-100 d-block text-center"><?= $testimonial["name"] ?? "Client Name"; ?></h3>
                                                <span class="w-100 d-block text-center"><?= $testimonial["designation"] ?? "Designation"; ?></span>
                                                <p class="d-block pt-3"><?= $testimonial["description"] ?? "Default testimonial description."; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>';

        // Write the dynamic content back to the file
        File::put($testimonialPath, $dynamicContent);
    } else {
        throw new \Exception("testimonial.php not found in $destinationPath/include.");
    }
}

protected function makeAboutUsDynamic($destinationPath)
{
    $aboutUsPath = "$destinationPath/include/about-us.php";

    if (File::exists($aboutUsPath)) {
        // Replace static content with dynamic placeholders
        $dynamicContent = '
        <div class="row">
            <div class="col-md-6 col-sm-6 story-bg">
                <h2 class="w-100 d-block text-center pb-2">Our Story</h2>
                <p class="d-block pb-md-3"><?= $content["our_story"] ?? "Default story content"; ?></p>

                <h2 class="w-100 d-block text-center pb-2">Mission</h2>
                <p class="d-block pb-md-3"><?= $content["mission"] ?? "Default mission content"; ?></p>

                <h2 class="w-100 d-block text-center pb-2">Vision</h2>
                <p class="d-block"><?= $content["vision"] ?? "Default vision content"; ?></p>
            </div>
            <div class="col-md-6 col-sm-6 pr-md-0">
                <img src="<?= $content["image_url"] ?? "/default-image.jpg"; ?>" class="img-fluid" alt="">
            </div>
        </div>';

        // Write the dynamic content back to the file
        File::put($aboutUsPath, $dynamicContent);
    } else {
        throw new \Exception("about-us.php not found in $destinationPath/include.");
    }
}
protected function makeChooseUsDynamic($destinationPath)
{
    $chooseUsPath = "$destinationPath/include/choose-us.php";

    if (File::exists($chooseUsPath)) {
        // Replace static content with dynamic placeholders
        $dynamicContent = '
        <div class="container">
            <div class="row">
                <h2 class="page-header w-100 d-block text-center pb-3"><?= $content["title"] ?? "Why Choose Us"; ?></h2>
            </div>
            <div class="col-md-12 col-sm-12 choose-bg d-block">
                <div class="row pt-4 px-md-4">
                    <?php foreach ($content["features"] ?? [] as $feature): ?>
                        <div class="col-md-4 col-sm-4 mb-md-0 mb-4">
                            <div class="makeus p-3">
                                <img src="<?= $feature["image_url"] ?? "/default-image.png"; ?>" alt="<?= $feature["title"] ?? "Feature"; ?>">
                                <h4><?= $feature["title"] ?? "Feature Title"; ?></h4>
                                <p><?= $feature["description"] ?? "Default description for this feature."; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>';

        // Write the dynamic content back to the file
        File::put($chooseUsPath, $dynamicContent);
    } else {
        throw new \Exception("choose-us.php not found in $destinationPath/include.");
    }
}



public function viewCart()
{
    // Fetch all cart items for the authenticated user
    $userId = auth()->id();
    $cartItems = Cart::where('user_id', $userId)->get();

    // Get the template details for each cart item
    $templates = [];
    foreach ($cartItems as $cartItem) {
        $templates[] = Template::find($cartItem->template_id); // Fetch the template data
    }

    // Pass the templates to the view
    return view('cart.index', compact('templates'));
}


public function preview($templateFolder)

    {

        // Construct the path to the template's index.php file
        $filePath = public_path('templates-user/' . $templateFolder . '/index.php');

        if (!file_exists($filePath)) {
            // Return the file to the browser
            return abort(404,'Template not found');
        }
        ob_start();
        include $filePath;
        $output = ob_get_clean();
        return response($output);
        $output = ob_get_clean();
    }

}
