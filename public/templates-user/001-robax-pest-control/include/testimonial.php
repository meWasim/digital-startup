<div class="container pt-2 pb-3">
    <div class="row">
        <h2 class="page-header w-100 d-block text-center">
            <?= $content["title"] ?? "Testimonial"; ?>
        </h2>
    </div>
</div>
<div class="col-md-12 col-sm-12 client-bg mx-auto pt-4">
    <div class="p-md-2 paralax rounded position-relative">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php foreach (array_chunk($content["testimonials"] ?? [], 3) as $index => $group): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            </ol>

            <!-- Carousel Slides -->
            <div class="carousel-inner px-md-0 pb-4">
                <?php foreach (array_chunk($content["testimonials"] ?? [], 3) as $index => $group): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <?php foreach ($group as $testimonial): ?>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="testimonial w-100 d-block text-center px-md-5">
                                            <img src="<?= $testimonial['image_url'] ?? '/default-image.png'; ?>"
                                                 alt="<?= $testimonial['name'] ?? 'Client'; ?>">
                                            <h3 class="w-100 d-block text-center">
                                                <?= $testimonial['name'] ?? 'Client Name'; ?>
                                            </h3>
                                            <span class="w-100 d-block text-center">
                                                <?= $testimonial['designation'] ?? 'Designation'; ?>
                                            </span>
                                            <p class="d-block pt-3">
                                                <?= $testimonial['description'] ?? 'Default testimonial description.'; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
