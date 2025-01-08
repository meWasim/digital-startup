@extends('layouts.app')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<style>
    /* Custom styles for buttons and accordion are unchanged */
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
    .accordion-button {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #ddd;
        font-size: 1.1rem;
        padding: 15px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-align: left;
        transition: background-color 0.3s, color 0.3s;
    }
    .accordion-button:hover {
        background-color: #e2e6ea;
        color: #007bff;
    }
    .accordion-button:not(.collapsed) {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }
    .accordion-collapse {
        padding: 15px;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }
    .accordion-body {
        font-size: 1rem;
        color: #495057;
        line-height: 1.5;
    }
    </style>
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Template - {{ $template->name }}</h2>

    <form method="POST" action="{{ route('template_section.update', $template->id) }}" enctype="multipart/form-data">
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
                        <textarea name="editor-about-us" id="editor-about-us" cols="30" rows="10" class="ckeditor form-control">
                            {{ old('editor-about-us', $sections['about-us'] ?? '') }}
                        </textarea>
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
                        <textarea name="editor-services" id="editor-services" cols="30" rows="10" class="ckeditor form-control">
                            {{ old('editor-services', $sections['services'] ?? '') }}
                        </textarea>
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
                        <textarea name="editor-blog" id="editor-blog" cols="30" rows="10" class="ckeditor form-control">
                            {{ old('editor-blog', $sections['blog'] ?? '') }}
                        </textarea>
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
                        <textarea name="editor-contact-us" id="editor-contact-us" cols="30" rows="10" class="ckeditor form-control">
                            {{ old('editor-contact-us', $sections['contact-us'] ?? '') }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="text-center mt-5">
            <button type="submit" class="custom-btn custom-btn-success px-5">
                <i class="fa fa-save"></i> Save Changes
            </button>
            <a href="{{ route('home') }}" class="custom-btn custom-btn-secondary px-5 ms-3">
                <i class="fa fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </form>
</div>

<!-- Initialize CKEditor -->
<script>
    CKEDITOR.replace('editor-about-us');
    CKEDITOR.replace('editor-services');
    CKEDITOR.replace('editor-blog');
    CKEDITOR.replace('editor-contact-us');
</script>
@endsection
