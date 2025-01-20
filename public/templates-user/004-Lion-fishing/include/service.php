
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
        </div>