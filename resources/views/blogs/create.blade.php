@extends('layouts.app')

@section('title', 'Blog Create - Digital Startups')

@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2>Blog Create</h2>
            </div>
            <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                <ul class="breadcrumb mb-0 pl-1">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li>Create</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="about-bg w-100 d-block py-md-5 py-3">
    <div class="container">


        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control " rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</section>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {

            ckfinder: {
                uploadUrl: "{{ route('blogs.uploadImage') }}?_token={{ csrf_token() }}"
            },

            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'alignment', 'blockQuote', 'code', 'codeBlock', 'highlight', '|',
                'heading', 'horizontalLine', 'link', 'numberedList', 'bulletedList', '|',
                'imageUpload', 'insertTable', 'mediaEmbed', 'pageBreak', 'insertImage', '|',
                'outdent', 'indent', 'ckfinder', 'textTransformation', 'sourceEditing'
            ],
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
                ]
            }
        })
        .catch(error => {
            console.error('CKEditor error:', error);
            alert('An error occurred. Check the console for details.');
        });
</script>
@endsection
