@extends('layouts.app')

@section('title', 'Your Cart - Digital Startups')

@section('content')
<style>
    .card {
        height: 100%; /* Ensure all cards fill the same height */
        display: flex;
        flex-direction: column;
    }

    .card-img-top {
        height: 150px; /* Set a fixed height for images */
        overflow: hidden; /* Hide any overflow content */
    }

    .card-img-top img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure images are properly scaled */
    }

    .card-body {
        flex-grow: 1; /* Allow body content to expand and fill space */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card .d-grid {
        margin-top: auto; /* Ensure buttons are aligned to the bottom */
    }
</style>

    <!-- Header Section -->
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Your Cart</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Your Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="row">
                @forelse($templates as $template)
                    <div class="col-md-3 col-sm-6 col-xs-12 p-md-3 pl-2 pr-3 pt-0 pb-1">
                        <div class="card shadow-sm position-relative">

                            <!-- Remove Button with Tooltip -->
                            <form action="#" method="POST"
                                  class="position-absolute" style="top: 10px; right: 10px; z-index: 10;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-circle" title="Remove from Cart"
                                        style="width: 20px; height: 20px; padding: 0; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-times" style="font-size: 8px; color: white;"></i>
                                </button>
                            </form>

                            <!-- Template Thumbnail -->
                            <div class="card-img-top position-relative">
                                <img src="{{ asset($template->thumbnail) }}" alt="{{ $template->name }}" class="img-fluid rounded">
                            </div>

                            <!-- Template Details -->
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $template->name }}</h5>
                                <p class="card-text text-center text-muted">₹ Free</p>
                                <!-- Action Buttons -->
                                <div class="d-grid gap-2">
                                    <a href="{{ url('user/template-preview/' . $template->folder) }}" target="_blank"
                                       class="btn btn-info btn-block btn-sm">Preview</a>
                                    <a href="{{ route('template.edit', $template->id) }}"
                                       class="btn btn-warning btn-block btn-sm">Edit</a>
                                    <a href="{{ route('check.template.edit', ['template_id' => $template->id, 'user_id' => auth()->id()]) }}"
                                       class="btn btn-success btn-block btn-sm">Edit About Us & Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Your cart is empty.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
