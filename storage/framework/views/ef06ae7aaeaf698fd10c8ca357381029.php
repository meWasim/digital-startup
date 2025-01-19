<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

<section class="header-fixed">
    <div class="header-top-bg w-100 d-block pb-md-0 pb-3">
        <div class="container">
            <div class="row hdr-menu pt-md-0 pt-2">
                <div class="col-md-3 col-sm-3 d-flex flex-wrap justify-content-md-left lgo-ml">
                    <a class="navbar-brand" href="/"><img src="<?php echo e(asset('images/Logo2.png')); ?>" alt=""></a>
                </div>
                <div class="col-md-3 col-sm-3 pt-2">
                    <form action="" id="">
                        <div class="input-group">
                            <input type="text" class="form-control search-blog" placeholder="Search Web Template">
                            <div class="input-group-append">
                                <button class="btn search-blog-btn" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-sm-4 position-relative hdr-top-posi pr-0">
                    <nav class="navbar navbar-expand-md navbar-light sticky-top">
                        <div id="navcontainer">
                            <div id="hamburger-wrapper">
                                <div id="button-wrapper" class="d-flex szelesseg justify-content-end">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navcollapse" aria-controls="navcollapse" aria-expanded="false"
                                        aria-label="Toggle Navigation">
                                        <span class="navbar-toggler-icon"><i class="fa fa-bars"
                                                aria-hidden="true"></i></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="navcollapse">
                                    <ul class="nav navbar-nav pl-3">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('about.us')); ?>">About Us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('blog')); ?>">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('contact.us')); ?>">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                                <a href="<?php echo e(route('cart.view')); ?>" class="btn btn-success">View Cart</a>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- User Dropdown Section -->
                <div class="col-md-2 col-sm-2 position-relative d-flex flex-wrap justify-content-end pr-0 pt-2">
                    <?php if(auth()->guard()->check()): ?>
                    <div class="dropdown">
                        <a class="sign-in-to-right dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <dd><i class="fa fa-user-o mr-md-1" aria-hidden="true"></i></dd>
                            <span><?php echo e(Auth::user()->Fname); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </div>
                    <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="sign-in-to-right">
                        <dd><i class="fa fa-user-o mr-md-1" aria-hidden="true"></i></dd>
                        <span>Login</span>
                    </a>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH E:\mywork\vivek startup\digital-startup\resources\views/layouts/partials/header.blade.php ENDPATH**/ ?>