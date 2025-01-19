
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
        </div>