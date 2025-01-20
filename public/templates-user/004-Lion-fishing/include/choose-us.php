
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
        </div>