<section class="header-fixed">
    <div class="container header-top-bg w-100 d-block py-2">
        <div class="row hdr-menu">
            <div class="col-md-2 col-sm-2 pl-0 pt-1">
                <a href="<?= $content["home_url"] ?? "/"; ?>" class="logo ml-4"><?= $content["logo_text"] ?? "Your Logo"; ?></a>
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
                                    <?php foreach ($content["menu_links"] ?? array (
  0 => 
  array (
    'url' => 'http://127.0.0.1:8000/templates-user/002-Zuk-Animal-Farming/index.php',
    'text' => 'Home',
  ),
  1 => 
  array (
    'url' => 'http://127.0.0.1:8000/templates-user/002-Zuk-Animal-Farming/about-us.php',
    'text' => 'About Us',
  ),
  2 => 
  array (
    'url' => 'http://127.0.0.1:8000/templates-user/002-Zuk-Animal-Farming/services.php',
    'text' => 'Services',
  ),
  3 => 
  array (
    'url' => 'http://127.0.0.1:8000/templates-user/002-Zuk-Animal-Farming/blog.php',
    'text' => 'Blog',
  ),
  4 => 
  array (
    'url' => 'http://127.0.0.1:8000/templates-user/002-Zuk-Animal-Farming/contact-us.php',
    'text' => 'Contact Us',
  ),
) as $menu): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= $menu["url"] ?? "#"; ?>"><?= $menu["text"] ?? "Link"; ?></a>
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
                    <?php foreach ($content["social_links"] ?? [
                        ["url" => "https://facebook.com", "icon" => "fa fa-facebook"],
                        ["url" => "https://twitter.com", "icon" => "fa fa-twitter"],
                        ["url" => "https://instagram.com", "icon" => "fa fa-instagram"],
                        ["url" => "https://youtube.com", "icon" => "fa fa-youtube-play"]
                    ] as $social): ?>
                        <li><a href="<?= $social["url"] ?? "#"; ?>"><i class="<?= $social["icon"] ?? "fa fa-link"; ?>" aria-hidden="true"></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-2 col-sm-2 pt-2 pr-0">
                <div class="topbar-link mr-4">
                    <ul>
                        <li>
                            <a href="tel:<?= $content["phone_number"] ?? "+91 0000000000"; ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?= $content["phone_number"] ?? "+91 0000000000"; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>