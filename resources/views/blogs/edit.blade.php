@extends('layouts.app')

@section('title', 'Edit Blog - Digital Startups')

@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2>Edit Blog</h2>
            </div>
            <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                <ul class="breadcrumb mb-0 pl-1">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li>Edit</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="about-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" id="content" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <div class="form-group">
                <label>Featured Image</label>
                <input type="file" name="featured_image" class="form-control">
                @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Blog</button>
        </form>
    </div>
</section>

<script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
@endsection
