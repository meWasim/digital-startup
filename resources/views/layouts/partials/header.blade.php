<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

<section class="header-fixed">
    <div class="header-top-bg w-100 d-block pb-md-0 pb-3">
        <div class="container">
            <div class="row hdr-menu pt-md-0 pt-2 align-items-center">
                <!-- Logo Section -->
                <div class="col-6 col-md-3 d-flex justify-content-start">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('images/Logo2.png') }}" alt="Logo" class="img-fluid">
                    </a>
                </div>

                <!-- Search Bar Section (Hidden on small screens) -->
                <div class="col-md-3 d-none d-md-block">
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

                <!-- Navigation Menu Section -->
                <div class="col-md-4 d-none d-md-block">
                    <nav class="navbar navbar-expand-md navbar-light sticky-top">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navcollapse"
                            aria-controls="navcollapse" aria-expanded="false" aria-label="Toggle Navigation">
                            <span class="navbar-toggler-icon">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navcollapse">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about.us') }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact.us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- User Dropdown Section with Cart next to it -->
                <div class="col-6 col-md-2 d-flex justify-content-end align-items-center">
                    @auth
                        <!-- Cart Button -->
                        @can('cart')
                            <a href="{{ route('cart.view') }}" class="btn btn-success btn-sm mr-2">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        @endcan

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a class="sign-in-to-right dropdown-toggle" id="userDropdown" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <span class="d-none d-md-inline">{{ Auth::user()->Fname }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="{{ route('profile') }}">Profile</a> --}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login Button -->
                        <a href="{{ route('login') }}" class="sign-in-to-right">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                            <span class="d-none d-md-inline">Login</span>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Search Bar for Small Screens -->
            <div class="row d-md-none mt-2">
                <div class="col-12">
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
            </div>
        </div>
    </div>
</section>
