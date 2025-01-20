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