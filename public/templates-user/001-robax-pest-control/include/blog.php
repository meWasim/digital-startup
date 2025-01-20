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
            </div>
