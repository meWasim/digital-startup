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
                    <li><a href="{{ route('blog') }}">Blogs</a></li>
                    <li>{{ $blog->title }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="blog-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="blog w-100">
                    <div class="blogdetilsImg">
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid">
                    </div>
                    <ul class="post pl-0 pt-3">
                        <li class="mr-2">
                            <i class="fa fa-calendar mr-1" aria-hidden="true"></i>{{ $blog->created_at->format('d/m/Y H:i:s') }}
                        </li>
                        <li class="mr-2">
                            <i class="fa fa-user mr-1" aria-hidden="true"></i>Posted by {{ $blog->author ?? 'Admin' }}
                        </li>
                        <li class="mr-1">Share this:</li>
                        <li>
                            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li class="mr-1">
                            <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li class="mr-1">
                            <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li class="mr-1">
                            <a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <h2 class="d-block pb-3">{{ $blog->title }}</h2>
                    <p class="d-block">{!! nl2br(e($blog->content)) !!}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="popular-pst">
                    <h2 class="d-block pb-md-5 pb-3">POPULAR POSTS</h2>
                    <ul class="d-block">
                        @foreach ($popularBlogs as $popular)
                        <li class="d-block position-relative mb-4">
                            <dd>
                                <img src="{{ asset('storage/' . $popular->featured_image) }}" alt="{{ $popular->title }}" class="img-fluid">
                            </dd>
                            <span class="d-block">
                                <a href="{{ route('blog.detail', $popular->slug) }}">{{ $popular->title }}</a>
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
