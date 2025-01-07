@extends('layouts.app')
<style>
    .custom-btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 30px;
    text-transform: uppercase;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

.custom-btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
}

.custom-btn-primary:hover {
    background-color: #0056b3;
    color: #fff;
}

.custom-btn-success {
    background-color: #28a745;
    color: #fff;
    border: none;
}

.custom-btn-success:hover {
    background-color: #1e7e34;
    color: #fff;
}

.custom-btn-secondary {
    background-color: #6c757d;
    color: #fff;
    border: none;
}

.custom-btn-secondary:hover {
    background-color: #5a6268;
    color: #fff;
}
/* Accordion Header Styling */
.accordion-button {
    background-color: #f8f9fa; /* Light background */
    color: #495057; /* Dark text color */
    border: 1px solid #ddd; /* Border for better separation */
    font-size: 1.1rem; /* Slightly larger font for readability */
    padding: 15px 20px; /* Increased padding for better spacing */
    border-radius: 8px; /* Rounded corners */
    font-weight: 600; /* Bold text for headers */
    text-align: left; /* Align the text to the left */
    transition: background-color 0.3s, color 0.3s; /* Smooth transition */
}

/* Hover Effect */
.accordion-button:hover {
    background-color: #e2e6ea; /* Light grey background on hover */
    color: #007bff; /* Blue text on hover */
}

/* Active Accordion Header */
.accordion-button:not(.collapsed) {
    background-color: #007bff; /* Blue background when active */
    color: #fff; /* White text when active */
    border-color: #007bff; /* Matching border color */
}

/* Collapsed Accordion Header */
.accordion-button.collapsed {
    background-color: #f8f9fa; /* Default light background */
    color: #495057; /* Dark text color when collapsed */
}

/* Accordion Arrow Icon */
.accordion-button::after {
    content: '\f078'; /* FontAwesome down arrow */
    font-family: 'Font Awesome 5 Free'; /* FontAwesome font */
    font-weight: 900; /* Bold arrow */
    transform: rotate(0deg); /* Initially rotated */
    transition: transform 0.3s; /* Smooth transition for rotation */
}

/* Rotated Arrow for Active Accordion Item */
.accordion-button:not(.collapsed)::after {
    transform: rotate(180deg); /* Rotate the arrow when active */
}

/* Accordion Panel Body */
.accordion-collapse {
    padding: 15px;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}

/* Accordion Panel Body Content */
.accordion-body {
    font-size: 1rem;
    color: #495057;
    line-height: 1.5;
}

/* Responsive Design: Make the button font size smaller on mobile */
@media (max-width: 768px) {
    .accordion-button {
        font-size: 1rem; /* Smaller font size on smaller screens */
        padding: 12px 15px; /* Adjust padding */
    }
}

    </style>
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Template - {{ $template->name }}</h2>

    <form method="POST" action="{{ route('template_section.update', $template) }}" enctype="multipart/form-data">
        @csrf
        <div class="accordion" id="templateSections">

            <!-- About Us Section -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAboutUs">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#aboutUs" aria-expanded="true" aria-controls="aboutUs">
                        About Us
                    </button>
                </h2>
                <div id="aboutUs" class="accordion-collapse collapse show" aria-labelledby="headingAboutUs" data-bs-parent="#templateSections">
                    <div class="accordion-body">
                        <label for="about_us_text" class="form-label">About Us Text</label>
                        <textarea name="sections[about-us][text]" id="about_us_text" class="form-control" rows="4" placeholder="Enter About Us content">{{ old('sections.about_us.text', $customizations['about_us']['text'] ?? '') }}</textarea>

                        <label for="about_us_images" class="form-label mt-3">About Us Images</label>
                        <input type="file" name="sections[about-us][images][]" id="about_us_images" class="form-control" multiple>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingServices">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#services" aria-expanded="false" aria-controls="services">
                        Services
                    </button>
                </h2>
                <div id="services" class="accordion-collapse collapse" aria-labelledby="headingServices" data-bs-parent="#templateSections">
                    <div class="accordion-body">
                        <label for="services_text" class="form-label">Services Text</label>
                        <textarea name="sections[services][text]" id="services_text" class="form-control" rows="4" placeholder="Enter Services content">{{ old('sections.services.text', $customizations['services']['text'] ?? '') }}</textarea>

                        <label for="services_images" class="form-label mt-3">Services Images</label>
                        <input type="file" name="sections[services][images][]" id="services_images" class="form-control" multiple>
                    </div>
                </div>
            </div>

            <!-- Blog Section -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingBlog">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#blog" aria-expanded="false" aria-controls="blog">
                        Blog
                    </button>
                </h2>
                <div id="blog" class="accordion-collapse collapse" aria-labelledby="headingBlog" data-bs-parent="#templateSections">
                    <div class="accordion-body">
                        <label for="blog_text" class="form-label">Blog Text</label>
                        <textarea name="sections[blog][text]" id="blog_text" class="form-control" rows="4" placeholder="Enter Blog content">{{ old('sections.blog.text', $customizations['blog']['text'] ?? '') }}</textarea>

                        <label for="blog_images" class="form-label mt-3">Blog Images</label>
                        <input type="file" name="sections[blog][images][]" id="blog_images" class="form-control" multiple>
                    </div>
                </div>
            </div>

            <!-- Contact Us Section -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingContactUs">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#contactUs" aria-expanded="false" aria-controls="contactUs">
                        Contact Us
                    </button>
                </h2>
                <div id="contactUs" class="accordion-collapse collapse" aria-labelledby="headingContactUs" data-bs-parent="#templateSections">
                    <div class="accordion-body">
                        <label for="contact_us_text" class="form-label">Contact Us Text</label>
                        <textarea name="sections[contact-us][text]" id="contact_us_text" class="form-control" rows="4" placeholder="Enter Contact Us content">{{ old('sections.contact_us.text', $customizations['contact_us']['text'] ?? '') }}</textarea>

                        <label for="contact_us_images" class="form-label mt-3">Contact Us Images</label>
                        <input type="file" name="sections[contact-us][images][]" id="contact_us_images" class="form-control" multiple>
                    </div>
                </div>
            </div>

        </div>

        <!-- Buttons -->
        <div class="text-center mt-5">
            <button type="submit" class="custom-btn custom-btn-success px-5">
                <i class="fa fa-save"></i> Save Changes
            </button>
            {{-- <a href="{{ route('template.preview', $template->id) }}" class="custom-btn custom-btn-primary px-5 ms-3">
                <i class="fa fa-eye"></i> Preview
            </a> --}}
            <a href="{{ route('home') }}" class="custom-btn custom-btn-secondary px-5 ms-3">
                <i class="fa fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </form>
</div>
@endsection
