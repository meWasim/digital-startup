<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Footer;
use App\Models\Header;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Feature;
use App\Models\Service;
use App\Models\Template;
use App\Models\BlogPosts;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ContactTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CartController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth');
    }
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
        $this->makeBlogPageDynamic($destinationPath);
        $this->makeChooseUsDynamic($destinationPath);
        $this->makeTestimonialDynamic($destinationPath);
        $this->makeContactUsDynamic($destinationPath);
        $this->makeFooterDynamic($destinationPath);
        $this->makeHeaderDynamic($destinationPath,$templateName);
        $this->makeServicesDynamic($destinationPath);

        return response()->json(['success' => 'Template added to cart and updated successfully.']);
    }



    protected function makeBlogPageDynamic($destinationPath)
    {
        $blogPath = "$destinationPath/include/blog.php";

        if (File::exists($blogPath)) {
            // Replace static content with dynamic placeholders for the blog
            $dynamicContent = '
            <div class="container py-3 px-0" id="blog">
                <div class="row">
                    <h2 class="page-header w-100 d-block text-center pb-3">Our Blog</h2>
                </div>
                <div class="row">
                    <?php foreach ($content["blog_posts"] ?? [] as $post): ?>
                        <div class="col-md-4 col-sm-4 mb-md-0 mb-3">
                            <div class="blog w-100 d-block">
                                <a href="blog-details-<?php echo $post["id"]; ?>.php">
                                    <img src="<?= $post["image_url"] ?? "default-image.jpg"; ?>" alt="<?= $post["title"] ?? "Blog Post Title"; ?>">
                                </a>
                                <strong class="w-100 d-block pt-3 pb-2 px-3">
                                    <i class="fa fa-calendar mr-2" aria-hidden="true"></i><?= $post["published_at"] ?? "Date"; ?>
                                </strong>
                                <h4 class="w-100 d-block pb-2 px-3">
                                    <a href="blog-details-<?php echo $post["id"]; ?>.php"><?= $post["title"] ?? "Blog Post Title"; ?></a>
                                </h4>
                                <p class="d-block px-3"><?= substr($post["content"], 0, 150) ?? "Blog post summary..."; ?></p>
                                <a href="blog-details-<?php echo $post["id"]; ?>.php" class="read-more py-2">Read More</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>';

            // Write the dynamic content back to the file
            File::put($blogPath, $dynamicContent);
        } else {
            throw new \Exception("blog.php not found in $destinationPath/include.");
        }
    }

protected function makeServicesDynamic($destinationPath)
{
    $servicePath = "$destinationPath/include/service.php";

    if (File::exists($servicePath)) {
        // Replace static content with dynamic placeholders
        $dynamicContent = '
        <div class="container py-3" id="service">
            <div class="row">
                <h2 class="page-header w-100 d-block text-center pb-3"><?= $content["page_title"] ?? "Our Services"; ?></h2>
            </div>
            <div class="row">
                <?php foreach ($content["services"] ?? [] as $service): ?>
                    <div class="col-md-4 col-sm-4 pl-md-0">
                        <div class="servs w-100">
                            <div class="zoom-effect-container">
                                <div class="image-card">
                                    <img src="<?= $service["image_url"] ?? "/default-image.jpg"; ?>" alt="<?= $service["title"] ?? "Service"; ?>">
                                </div>
                            </div>
                            <div class="bed-bug w-100 d-block p-md-5 p-3">
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
            // ["url" => asset("templates-user/$templateName/index.php"), "text" => "Home"],
            // ["url" => asset("templates-user/$templateName/about-us.php"), "text" => "About Us"],
            // ["url" => asset("templates-user/$templateName/services.php"), "text" => "Services"],
            // ["url" => asset("templates-user/$templateName/blog.php"), "text" => "Blog"],
            // ["url" => asset("templates-user/$templateName/contact-us.php"), "text" => "Contact Us"],
            ["url" => "#home", "text" => "Home"],
            ["url" => "#about-us", "text" => "About Us"],
            ["url" => "#service", "text" => "Services"],
            ["url" => "#blog", "text" => "Blog"],
            ["url" => "#contact-us", "text" => "Contact Us"],
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
        <style>
        html {
    scroll-behavior: smooth;
}
        <style>
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
        $dynamicContent = <<<PHP
<div class="container py-md-3" id="contact-us">
    <div class="row">
        <h2 class="page-header w-100 d-block text-center pb-3"><?php echo htmlspecialchars(\$contact->title ?? 'Contact Us'); ?></h2>
    </div>
    <div class="row contact-bg py-md-4 px-md-5 pl-2 py-3 mb-md-4">
        <div class="col-md-6 col-sm-6 pl-0">
            <h3 class="d-block text-center pb-2"><?php echo htmlspecialchars(\$contact->company_name ?? 'Your Company Name'); ?></h3>
            <p class="d-block text-center mb-1" style="font-size:17px;">
                <b>CIN No:</b> <?php echo htmlspecialchars(\$contact->cin_no ?? 'Default CIN'); ?>
            </p>
            <p class="d-block text-center mb-1" style="font-size:17px;">
                <b>Registration No:</b> <?php echo htmlspecialchars(\$contact->registration_no ?? 'Default Reg No'); ?>
            </p>
            <p class="d-block text-center mb-1">
                <i class="fa fa-map-marker mr-2" aria-hidden="true"></i><?php echo htmlspecialchars(\$contact->address ?? 'Your Address'); ?>
            </p>
            <p class="d-block text-center mb-1">
                <i class="fa fa-envelope-o mr-2" aria-hidden="true"></i>
                <a href="mailto:<?php echo htmlspecialchars(\$contact->email ?? 'info@yourdomain.com'); ?>"><?php echo htmlspecialchars(\$contact->email ?? 'info@yourdomain.com'); ?></a>
            </p>
            <p class="d-block text-center mb-4">
                <i class="fa fa-phone mr-2" aria-hidden="true"></i>
                <a href="tel:<?php echo htmlspecialchars(\$contact->phone ?? '+91 0000000000'); ?>"><?php echo htmlspecialchars(\$contact->phone ?? '+91 0000000000'); ?></a>
            </p>
            <div class="col-md-12 col-sm-12">
                <div class="row map-bdr p-2">
                    <iframe src="<?php echo htmlspecialchars(\$contact->map_embed_url ?? 'https://maps.google.com'); ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 pl-md-2 pl-0 ftr-frm">

            <form action="<?php echo htmlspecialchars(\$formAction ?? '/contact-submit'); ?>" method="POST">

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
PHP;

        // Write the dynamic content back to the file
        if (!File::put($contactUsPath, $dynamicContent)) {
            throw new \Exception("Failed to write to $contactUsPath.");
        }
    } else {
        throw new \Exception("contact-us.php not found in $destinationPath/include.");
    }
}

protected function makeTestimonialDynamic($destinationPath)
{
    $testimonialPath = "$destinationPath/include/testimonial.php";

    if (File::exists($testimonialPath)) {
        try {
            // Replace static content with dynamic placeholders
            $dynamicContent = <<<'EOD'
            <div class="container pt-2 pb-3">
                <div class="row">
                    <h2 class="page-header w-100 d-block text-center"><?= $content["title"] ?? "Testimonials"; ?></h2>
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
                                                    <img src="<?= $testimonial["image_url"] ?? "/default-image.png"; ?>"
                                                         alt="<?= htmlspecialchars($testimonial["name"] ?? "Client"); ?>">
                                                    <h3 class="w-100 d-block text-center"><?= htmlspecialchars($testimonial["name"] ?? "Client Name"); ?></h3>
                                                    <span class="w-100 d-block text-center"><?= htmlspecialchars($testimonial["designation"] ?? "Designation"); ?></span>
                                                    <p class="d-block pt-3"><?= htmlspecialchars($testimonial["description"] ?? "No testimonial provided."); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            EOD;

            // Write the dynamic content back to the file
            File::put($testimonialPath, $dynamicContent);
        } catch (\Exception $e) {
            throw new \Exception("Error writing to $testimonialPath: " . $e->getMessage());
        }
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
        <div class="row" id="home">
	 	  <h2 class="page-header w-100 d-block text-center pb-3">About Us</h2>
	    </div>
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
    <img
        src="<?= !empty($content["image_url"]) ? $content["image_url"] : "http://127.0.0.1:8000/templates-master/001-robax-pest-control/images/story-01.jpg"; ?>"
        class="img-fluid"
        alt="Image description">
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
    if (!auth()->user()->can('cart')) {
        return redirect()->back()->with('error', 'Permission denied');
    }
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
        return abort(404, 'Template not found');
    }

    // Fetch the authenticated user's ID
    $userId = auth()->id();

    // Fetch the template record for the given folder
    $template = Template::where('folder', $templateFolder)->first();

    if (!$template) {
        return abort(404, 'Template not found in database');
    }

    // Fetch About Us data for the given user and template
    $aboutUs = AboutUs::where('user_id', $userId)
        ->where('template_id', $template->id)
        ->first();

    $services = Service::where('user_id', $userId)->where('template_id', $template->id)->get();
    $testimonials = Testimonial::where('user_id', $userId)->where('template_id', $template->id)->get();
    $feature = Feature::where('user_id', $userId)->where('template_id', $template->id)->get();
    $contact = ContactTemplate::where('user_id', $userId)->where('template_id', $template->id)->first();
    $footer = Footer::where('user_id', $userId)->where('template_id', $template->id)->first();
    $blogPosts = BlogPosts::where('user_id', $userId)->where('template_id', $template->id)->get();
    $header = Header::where('user_id', $userId)->where('template_id', $template->id)->first();

    $defaultImage = file_exists(public_path('templates-user/'.$templateFolder.'/images/story-01.jpg'))
    ? 'story-01.jpg'
    : 'story.jpg';


    $usefulLinks = $footer ? json_decode($footer->useful_links, true) : [];
    $socialLinks = $footer ? json_decode($footer->social_links, true) : [];
    // Prepare content array
    $content = [
        'home_url' => $header->home_url ?? '/',
        'logo_text' => $header->logo_text ?? 'Your Logo',
      'menu_links' => $header && $header->menu_links ? json_decode($header->menu_links, true) : [
    ['url' => '#home', 'text' => 'Home'],
    ['url' => '#about-us', 'text' => 'About Us'],
    ['url' => '#service', 'text' => 'Services'],
    ['url' => '#blog', 'text' => 'Blog'],
    ['url' => '#contact-us', 'text' => 'Contact Us'],
],
      'social_links' => $header && $header->social_links ? json_decode($header->social_links, true) : [
    ['url' => 'https://facebook.com', 'icon' => 'fa fa-facebook'],
    ['url' => 'https://twitter.com', 'icon' => 'fa fa-twitter'],
    ['url' => 'https://instagram.com', 'icon' => 'fa fa-instagram'],
    ['url' => 'https://youtube.com', 'icon' => 'fa fa-youtube-play'],
],
        'phone_number' => $header->phone_number ?? '+91 0000000000',
        'our_story' => $aboutUs->our_story ?? 'Default story content',
        'mission' => $aboutUs->mission ?? 'Default mission content',
        'vision' => $aboutUs->vision ?? 'Default vision content',
        // 'image_url' => $aboutUs && $aboutUs->image_path
        //     ? asset('storage/' . $aboutUs->image_path)
        //     : '/default-image.jpg',
        'image_url' => !empty($aboutUs->image_path)
    ? $aboutUs->image_path
    : asset('templates-user/'.$templateFolder.'/images/'.$defaultImage),

        'page_title' => 'Our Services',
        'services' => $services->map(function ($service) {
            return [
                'title' => $service->title,
                'subtitle' => $service->subtitle,
                // 'image_url' => $service->image_path
                //     ? asset('storage/' . $service->image_path)
                //     : '/default-image.jpg',
                'image_url'=> $service->image_path,
                'extra_class' => $service->extra_class,
            ];
        })->toArray(),
        'testimonials' => $testimonials->map(function ($testimonial) {
            return [
                'name' => $testimonial->name,
                'designation' => $testimonial->designation,
                'description' => $testimonial->description,
                // 'image_url' => $testimonial->image_path
                //     ? asset('storage/' . $testimonial->image_path)
                //     : '/default-image.png',
                'image_url'=> $testimonial->image_path,
            ];
        })->toArray(),
        'features' => $feature->map(function ($feature) {
            return [
                'title' => $feature->title,
                'description' => $feature->description,
                // 'image_url' => $feature->image_path
                //     ? asset('storage/' . $feature->image_path)
                //     : '/default-feature-image.jpg',
                'image_url' =>$feature->image_path,
            ];
        })->toArray(),
        'blog_posts' => $blogPosts->map(function ($blogPost) {
            return [
                'id' => $blogPost->id,
                'title' => $blogPost->title,
                'description' => $blogPost->description,
                'content' => $blogPost->content,
                'image_url' => $blogPost->image_url,
               'published_at' => Carbon::parse($blogPost->published_at)->format('F j, Y'), // Format the date as needed
            ];
        })->toArray(),
        'contacts' => [
            'title' => $contact->title ?? 'Contact Us',
            'company_name' => $contact->company_name ?? 'Your Company Name',
            'cin_no' => $contact->cin_no ?? 'Default CIN',
            'registration_no' => $contact->registration_no ?? 'Default Registration No',
            'address' => $contact->address ?? 'Your Address',
            'email' => $contact->email ?? 'info@yourdomain.com',
            'phone' => $contact->phone ?? '+91 0000000000',
            'map_embed_url' => $contact->map_embed_url ?? 'https://maps.google.com',
        ],
    ];

    $footer = [
        'about_us_title' => $footer->about_us_title ?? 'About Us',
        'about_us_text' => $footer->about_us_text ?? 'Default About Us text.',
        'footer_logo' => $footer->footer_logo ?? 'Your Logo URL',
        'email' => $footer->email ?? 'info@yourdomain.com',
        'phone' => $footer->phone ?? '+91 9876543210',
        'address' => $footer->address ?? '123 Your Address, Your City, Your Country',
        'useful_links' => $usefulLinks,
        'social_links' => $socialLinks,
        'footer_text' => $footer->footer_text ?? 'Developed by:',
        'developer_name' => $footer->developer_name ?? 'Your Developer',
        'developer_link' => $footer->developer_link ?? 'https://developer-website.com',
    ];

    // Include the file with dynamic content

    ob_start();
    extract(['content' => $content, 'footer'=>$footer]); // Pass the $content array to the included PHP file
    include $filePath; // Include the index.php file
    $output = ob_get_clean(); // Capture the output

    return response($output);
}

}
