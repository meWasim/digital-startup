@extends('layouts.app')
@section('title', 'Blog - Digital Startups')
@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
         <div class="row">
             <div class="col-md-6 col-sm-6">
                 <h2 class="d-block">Blog</h2>
             </div>
             <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                  <ul class="breadcrumb mb-0 pl-1">
                       <li><a href="/">Home</a></li>
                       <li>Blog</li>
                   </ul>
             </div>
         </div>
    </div>
</section>
<section class="blog-bg w-100 d-block py-md-5 py-3">
  <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('blog') }}" method="GET" class="form-inline">
                    <div class="form-group mr-3">
                        <label for="filterTitle" class="mr-2">Title</label>
                        <input type="text" name="title" id="filterTitle" value="{{ request('title') }}" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="form-group mr-3">
                        <label for="filterAuthor" class="mr-2">Author</label>
                        <input type="text" name="author" id="filterAuthor" value="{{ request('author') }}" class="form-control" placeholder="Enter author">
                    </div>
                    <div class="form-group mr-3">
                        <label for="filterDate" class="mr-2">Date</label>
                        <input type="date" name="date" id="filterDate" value="{{ request('date') }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('blog') }}" class="btn btn-secondary ml-2">Clear</a>
                </form>
            </div>
        </div>
        <!-- Blogs List -->
        <div class="row">
            @forelse($blogs as $blog)
            <div class="col-md-6 col-sm-6 mb-4">
                 <div class="blog w-100">
                     <div class="blogImg position-relative">
                       <div class="blog-date position-absolute">
                            <span>{{ $blog->created_at->format('d') }}</span>
                            <dd>{{ $blog->created_at->format('M Y') }}</dd>
                       </div>
                       <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default-blog.jpg') }}" alt="{{ $blog->title }}">
                     </div>
                     <h2 class="d-block pt-5 pb-3">{{ $blog->title }}</h2>
                     <p>
                         {{ Str::limit(strip_tags($blog->content), 150) }}
                         <a href="{{ route('blog.detail', $blog->slug) }}" class="more-info ml-2">Read More</a>
                     </p>
                 </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No blogs available at the moment.</p>
            </div>
            @endforelse
        </div>
 </div>
</section>
@endsection
