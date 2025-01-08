@extends('layouts.app')

@section('title', 'Home - Digital Startups')

@section('content')
    @include('layouts.partials.domain')
    @include('layouts.partials.get-website')
    {{-- @include('layouts.partials.freeTemplate') --}}
    <section class="web-demo-Area w-100 d-block py-md-4 py-2">
        <div class="container-fluid" style="width:90%;">
            <div class="row">
                <div class="chse-tmpl w-100 d-block text-center pb-md-3">Choose a Free Stunning Template</div>

                @forelse($templates as $template)
                    <div class="col-md-3 col-sm-3 p-md-3 pl-2 pr-3 pt-0 pb-1">
                        <div class="webImg">
                            <div class="webTemp position-relative">
                                <a href="#" class="favourite"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                <img src="{{ asset('thumbnails/' . basename($template->thumbnail)) }}" alt="{{ $template->name }}">
                            </div>
                            <div class="webArea position-relative py-4 px-3">
                                <div class="title w-100 d-block text-left position-absolute pl-3">
                                    {{ $template->name }}
                                </div>
                                <div class="rupee-sym w-100 d-block text-left position-absolute pl-3">
                                    ₹ Free
                                </div>
                                <div class="web-demo w-100 d-block text-right position-absolute pr-3">
                                    <a class="web-cart ml-2" href="javascript:void(0);" data-template-id="{{ $template->id }}">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </a>
                                    {{-- <a href="{{ url('templates/' . $template->folder) }}" class="prev-box" target="_blank">Preview</a> --}}
                                    <a href="{{ url('template-preview/' . $template->folder) }}" target="_blank" class="prev-box">Preview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="col-md-3 col-sm-3 p-md-3 pl-2 pr-3 pt-0 pb-1">
                    No template available
                </div>
                @endforelse



            </div>

            {{-- <div class="col-md-12 col-sm-12">
                <a href="{{ route('templates.index') }}" class="view-all">View All</a>
            </div> --}}
        </div>
    </section>

    <script>
        $(document).ready(function () {
            // Handling click event on Add to Cart button
            $('.web-cart').on('click', function () {
                // Retrieve template ID from the data-template-id attribute
                var templateId = $(this).data('template-id');

                // SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Add to Cart?',
                    text: 'Do you want to add this template to your cart?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, add to cart!',
                    cancelButtonText: 'No, thanks',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request to add to cart
                        $.ajax({
                            url: '/add-to-cart',  // Change to your route
                            method: 'POST',
                            data: {
                                template_id: templateId,  // Send template ID
                                _token: '{{ csrf_token() }}' // CSRF token
                            },
                            success: function(response) {
                                // On success, show confirmation message
                                Swal.fire(
                                    'Added!',
                                    'Template has been added to your cart.',
                                    'success'
                                );
                            },
                            error: function() {
                                // On failure, show error message
                                Swal.fire(
                                    'Oops...',
                                    'Something went wrong. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
    @include('layouts.partials.whyChooseUs')
    @include('layouts.partials.ourService')
    @include('layouts.partials.googleReview')
@endsection

>

