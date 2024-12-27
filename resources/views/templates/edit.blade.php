@extends('layouts.app')

@section('title', 'Edit Template - Digital Startups')

@section('content')
    <section class="about-bnr blue-bg-mt w-100 py-md-4 py-2">
        <div class="container">
            <div class="row align-items-center">
                <!-- Section Heading -->
                <div class="col-md-6">
                    <h2 class="mb-0">Edit Template</h2>
                </div>
                <!-- Breadcrumb -->
                <div class="col-md-6 text-md-end text-start">
                    <ul class="breadcrumb mb-0">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('admin.templates.index') }}">Templates</a></li>
                        <li class="active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 py-md-5 py-3">
        <div class="container">
            <form action="{{ route('admin.templates.update', $template->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
                @csrf
                @method('PUT')

                <!-- Template Name Input -->
                <div class="mb-3">
                    <label for="name" class="form-label">Template Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $template->name }}" required>
                </div>

                <!-- Template Description Input -->
                <div class="mb-3">
                    <label for="description" class="form-label">Template Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter template description">{{ $template->description }}</textarea>
                </div>

                <!-- Existing Thumbnail Preview -->
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Current Thumbnail</label>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $template->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail me-3" width="150">
                        <p class="mb-0">Current Thumbnail</p>
                    </div>
                </div>

                <!-- New Thumbnail Upload -->
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">New Thumbnail (optional)</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                    <small class="text-muted">Leave this empty if you don't want to change the thumbnail.</small>
                </div>

                <!-- Current Template ZIP File -->
                <div class="mb-3">
                    <label for="template" class="form-label">Current Template File</label>
                    <div>
                        <a href="{{ asset('templates-master/' . $template->folder . '.zip') }}" target="_blank" class="btn btn-link">View Current Template</a>
                    </div>
                </div>

                <!-- New Template File Upload -->
                <div class="mb-3">
                    <label for="template" class="form-label">New Template File (optional)</label>
                    <input type="file" name="template" id="template" class="form-control">
                    <small class="text-muted">Leave this empty if you don't want to change the template ZIP file.</small>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Template</button>
                </div>
            </form>
        </div>
    </section>
@endsection
