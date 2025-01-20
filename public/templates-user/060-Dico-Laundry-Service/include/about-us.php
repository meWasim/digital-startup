
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
        </div>