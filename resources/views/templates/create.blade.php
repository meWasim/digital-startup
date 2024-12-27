@extends('layouts.app')

@section('title', 'Upload Template - Digital Startups')

@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Upload New Template</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <ul class="breadcrumb mb-0">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('admin.templates.index') }}">Templates</a></li>
                    <li>Upload</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="about-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Upload New Template</h4>
            </div>
            <div class="card-body">
                <form id="upload-form" action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">

                        <!-- Template File Input -->
                        <div class="col-lg-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <label for="template-file" class="form-label font-weight-bold">Template File (ZIP)</label>
                                    <div class="dropzone" id="template-dropzone">
                                        <p>Drag & drop your template file here, or click to upload</p>
                                        <input type="file" name="template" id="template-file" class="form-control d-none" accept=".zip" required>
                                    </div>
                                    <small id="template-name" class="text-muted mt-2 d-block"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail Image -->
                        <div class="col-lg-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <label for="thumbnail-file" class="form-label font-weight-bold">Thumbnail Image</label>
                                    <div class="dropzone" id="thumbnail-dropzone">
                                        <p>Drag & drop your thumbnail here, or click to upload</p>
                                        <input type="file" name="thumbnail" id="thumbnail-file" class="form-control d-none" accept="image/*" required>
                                    </div>
                                    <div id="thumbnail-preview" class="mt-3"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Template Name Input -->
                        <div class="col-md-6">
                            <label for="template-name-input" class="form-label font-weight-bold">Template Name</label>
                            <input type="text" class="form-control shadow-sm" id="template-name-input" name="name" placeholder="Enter template name" required>
                        </div>

                        <!-- Template Description -->
                        <div class="col-md-6">
                            <label for="description" class="form-label font-weight-bold">Template Description</label>
                            <textarea name="description" class="form-control shadow-sm" id="description" placeholder="Enter a brief description of the template"></textarea>
                        </div>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <span>Upload Template</span>
                            <div id="upload-spinner" class="spinner-border spinner-border-sm text-light ms-2 d-none"></div>
                        </button>
                        <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Template File Input
        const templateFileInput = document.getElementById('template-file');
        const templateDropzone = document.getElementById('template-dropzone');

        templateDropzone.addEventListener('click', () => templateFileInput.click());

        templateFileInput.addEventListener('change', () => {
            const fileName = templateFileInput.files[0]?.name || '';
            document.getElementById('template-name').textContent = `Selected File: ${fileName}`;
        });

        // Thumbnail Image Input
        const thumbnailFileInput = document.getElementById('thumbnail-file');
        const thumbnailDropzone = document.getElementById('thumbnail-dropzone');

        thumbnailDropzone.addEventListener('click', () => thumbnailFileInput.click());

        thumbnailFileInput.addEventListener('change', () => {
            const file = thumbnailFileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('thumbnail-preview').innerHTML = `
                        <img src="${e.target.result}" alt="Thumbnail Preview" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                    `;
                };
                reader.readAsDataURL(file);
            }
        });

        // Submit Handler
        const form = document.getElementById('upload-form');
        const uploadSpinner = document.getElementById('upload-spinner');

        form.addEventListener('submit', (e) => {
            uploadSpinner.classList.remove('d-none');
        });
    });
</script>
@endpush

<style>
    .dropzone {
        border: 2px dashed #0d6efd;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #f8f9fa;
        cursor: pointer;
    }

    .dropzone:hover {
        background-color: #e9ecef;
    }

    .card {
        height: 100%;
    }
</style>
@endsection
