<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<style>
    #suggestion-box {
        width: 100%;
        background-color: #fff;
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #suggestion-box .list-group-item {
        cursor: pointer;
        padding: 10px;
    }

    #suggestion-box .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>

<section class="header-fixed">
    <div class="pb-3 header-top-bg w-100 d-block pb-md-0">
        <div class="container">
            <div class="pt-2 row hdr-menu pt-md-0 align-items-center">
                <!-- Logo Section -->
                <div class="col-6 col-md-3 d-flex justify-content-start">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('images/Logo2.png') }}" alt="Logo" class="img-fluid">
                    </a>
                </div>

                <!-- Search Bar Section (Hidden on small screens) -->
                <div class="col-md-3 d-md-block">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control search-blog" name="query" placeholder="Search Web Template">
                            <div class="input-group-append">
                                <button class="btn search-blog-btn" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <ul id="suggestion-box" class="list-group position-absolute" style="z-index: 1000; display: none;"></ul>
                    </form>

                </div>

                <!-- Navigation Menu Section -->
                <div class="col-md-4 d-md-block">
                    <nav class="navbar navbar-expand-md navbar-light sticky-top">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navcollapse"
                            aria-controls="navcollapse" aria-expanded="false" aria-label="Toggle Navigation">
                            <span class="navbar-toggler-icon">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navcollapse">
                            <ul class="ml-auto navbar-nav">
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
                            <a href="{{ route('cart.view') }}" class="mr-2 btn btn-success btn-sm">
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
            <div class="mt-2 row d-none d-md-none">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Debounce function to limit AJAX requests
        let debounceTimeout;
        const debounce = (func, delay) => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(func, delay);
        };

        $('.search-blog').on('keyup', function () {
            const query = $(this).val();

            // Ensure minimum 3 characters before triggering the AJAX request
            if (query.length > 0) {
                debounce(() => {
                    $.ajax({
                        url: "{{ route('search.suggestions') }}", // Dynamic route
                        type: "GET",
                        data: { query: query },
                        success: function (data) {
                            if (data.length > 0) {
                                // Create suggestion list
                                let suggestions = '';
                                data.forEach(function (item) {
                                    suggestions += `<li class="list-group-item">${item}</li>`;
                                });

                                // Update suggestion box
                                $('#suggestion-box').html(suggestions).show();
                            } else {
                                $('#suggestion-box').html('<li class="list-group-item">No results found</li>').show();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching suggestions:", error);
                        }
                    });
                }, 300); // Debounce delay of 300ms
            } else {
                $('#suggestion-box').hide();
            }
        });

        // Handle click on suggestion
        $('#suggestion-box').on('click', '.list-group-item', function () {
            const selectedText = $(this).text();
            $('.search-blog').val(selectedText); // Copy selected text to input
            $('#suggestion-box').hide(); // Hide suggestion box
            $('.search-blog-btn').prop('disabled', false); // Enable the search button
        });

        // Initially disable search button until a suggestion is selected or input has a valid value
        $('.search-blog-btn').prop('disabled', true);

        $('.search-blog').on('input', function () {
            const value = $(this).val();
            if (value.length > 0) {
                $('.search-blog-btn').prop('disabled', false);
            } else {
                $('.search-blog-btn').prop('disabled', true);
            }
        });

        // Hide suggestions on clicking outside the input or suggestion box
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search-blog, #suggestion-box').length) {
                $('#suggestion-box').hide();
            }
        });

        // Prevent hiding the suggestion box when clicked inside it
        $('#suggestion-box').on('click', function (e) {
            e.stopPropagation();
        });
    });
</script>


