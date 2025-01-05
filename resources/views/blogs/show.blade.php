@extends('layouts.app')

@section('title', $blog->title . ' - Digital Startups')

@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2>{{ $blog->title }}</h2>
            </div>
            <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                <ul class="breadcrumb mb-0 pl-1">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li>{{ $blog->title }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="about-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid mb-4">
                @endif

                <h1>{{ $blog->title }}</h1>
                <p><small>Author: {{ $blog->author }}</small></p>
                <p><small>Published on: {{ $blog->created_at->format('F d, Y') }}</small></p>

                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
            </div>

            {{-- <div class="col-md-4">
                <h4>Other Blogs</h4>
                <ul class="list-group">
                    @foreach($otherBlogs as $otherBlog)
                        <li class="list-group-item">
                            <a href="{{ route('blogs.show', $otherBlog->id) }}">{{ $otherBlog->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div> --}}
        </div>
    </div>
</section>
@endsection
