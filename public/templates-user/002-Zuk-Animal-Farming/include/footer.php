
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
        </div>