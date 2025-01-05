<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Digital Startups')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/left-menu.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>


    @stack('styles')
</head>

<body>
    <div id="wrapper">
        @include('layouts.partials.sideNav')

        <div id="page-content-wrapper">
            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="row">
                            @include('layouts.partials.header')
                            @yield('content')
                            @include('layouts.partials.footer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/ImageScroll.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var highestBox = 0;
            $('.service-box').each(function() {
                if ($(this).height() > highestBox) {
                    highestBox = $(this).height();
                }
            });
            $('.service-box').height(highestBox);

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var trigger = $('.hamburger'),
                overlay = $('.overlay'),
                isClosed = false;

            trigger.click(function() {
                hamburger_cross();
            });

            function hamburger_cross() {

                if (isClosed == true) {
                    overlay.hide();
                    trigger.removeClass('is-open');
                    trigger.addClass('is-closed');
                    isClosed = false;
                } else {
                    overlay.show();
                    trigger.removeClass('is-closed');
                    trigger.addClass('is-open');
                    isClosed = true;
                }
            }

            $('[data-toggle="offcanvas"]').click(function() {
                $('#wrapper').toggleClass('toggled');
            });
        });
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500,
                toast: true, // Makes it smaller like a toast
            });
        @elseif (session('error'))
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500,
                toast: true, // Makes it smaller like a toast
            });
        @endif
    </script>
    <script>
        function confirmDelete(param) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById(`delete-form-${param}`).submit();
                }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentPath = window.location.pathname;
            const activeLink = document.querySelector(`.nav-link[href="${currentPath}"]`);

            if (activeLink) {
                activeLink.classList.add("active");
                const parentCollapse = activeLink.closest(".collapse");
                if (parentCollapse) {
                    const collapseToggle = document.querySelector(`[href="#${parentCollapse.id}"]`);
                    if (collapseToggle) {
                        collapseToggle.setAttribute("aria-expanded", "true");
                        parentCollapse.classList.add("show");
                    }
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#table').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search bar
                "ordering": true, // Enable column sorting
                "info": true, // Display table information
                "autoWidth": false, // Disable automatic column width
                "responsive": true, // Enable responsive table
                "language": {
                    "search": "Filter records:", // Custom label for search bar
                    "lengthMenu": "Show _MENU_ entries", // Custom label for page length menu
                    "info": "Showing _START_ to _END_ of _TOTAL_ templates", // Info text customization
                    "infoEmpty": "No templates available", // Text for empty table
                    "infoFiltered": "(filtered from _MAX_ total entries)", // Info about filtered results
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    </script>
    <!-- DataTables JS -->

    @stack('scripts')
</body>

</html>
