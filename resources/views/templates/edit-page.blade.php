@extends('layouts.app')

@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Templates</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end justify-content-left">
                <ul class="breadcrumb mb-0 pl-1">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Templates</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="about-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <form method="POST" action="{{ route('template.update', $templateId) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- AI Writing Button -->
            <button id="writeWithAI" type="button" class="btn btn-info mb-3">Write with AI</button>

            <!-- Header Section -->
            <div class="card mb-4">
                <div class="card-header"><h4>Header</h4></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="home_url">Home URL</label>
                        <input type="text" name="header[home_url]" id="home_url" class="form-control" value="{{ $header->home_url ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="logo_text">Logo Text</label>
                        <input type="text" name="header[logo_text]" id="logo_text" class="form-control" value="{{ $header->logo_text ?? '' }}">
                    </div>

                    <!-- Menu Links -->
                    <div class="form-group">
                        <label>Menu Links</label>
                        <div id="menu-links-container">
                            @foreach ($header->menu_links ?? [['url' => '', 'text' => '']] as $index => $menu)
                                <div class="menu-link-item border p-3 mb-3 rounded">
                                    <input type="text" name="header[menu_links][{{ $index }}][url]" placeholder="Menu URL" class="form-control mb-2" value="{{ $menu['url'] ?? '' }}">
                                    <input type="text" name="header[menu_links][{{ $index }}][text]" placeholder="Menu Text" class="form-control" value="{{ $menu['text'] ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success" onclick="addMenuLink()">+ Add Link</button>
                    </div>

                    <!-- Social Links -->
                    <div class="form-group">
                        <label>Social Links</label>
                        <div id="social-links-container">
                            @foreach ($header->social_links ?? [['url' => '', 'icon' => '']] as $index => $social)
                                <div class="social-link-item border p-3 mb-3 rounded">
                                    <input type="text" name="header[social_links][{{ $index }}][url]" placeholder="Social URL" class="form-control mb-2" value="{{ $social['url'] ?? '' }}">
                                    <input type="text" name="header[social_links][{{ $index }}][icon]" placeholder="Social Icon Class" class="form-control" value="{{ $social['icon'] ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success" onclick="addSocialLink()">+ Add Social Link</button>
                    </div>
                </div>
            </div>

            <!-- About Us Section -->
            <div class="card mb-4">
                <div class="card-header"><h4>About Us</h4></div>
                <div class="card-body">
                    <textarea name="our_story" class="form-control mb-3" placeholder="Our Story" rows="3">{{ $header->our_story ?? '' }}</textarea>
                    <textarea name="mission" class="form-control mb-3" placeholder="Mission" rows="3">{{ $header->mission ?? '' }}</textarea>
                    <textarea name="vision" class="form-control" placeholder="Vision" rows="3">{{ $header->vision ?? '' }}</textarea>
                </div>
            </div>

            <!-- Blog Section -->
            <div class="card mb-4">
                <div class="card-header"><h4>Our Blog</h4></div>
                <div class="card-body">
                    <div id="blog-container">
                        @foreach ($header->blog_posts ?? [['title' => '', 'image_url' => '', 'published_at' => '', 'content' => '']] as $index => $post)
                            <div class="blog-post-item border p-3 mb-3">
                                <input type="text" name="header[blog_posts][{{ $index }}][title]" placeholder="Blog Title" class="form-control mb-2" value="{{ $post['title'] ?? '' }}">
                                <input type="date" name="header[blog_posts][{{ $index }}][published_at]" class="form-control mb-2" value="{{ $post['published_at'] ?? '' }}">
                                <textarea name="header[blog_posts][{{ $index }}][content]" class="form-control" placeholder="Blog Content" rows="3">{{ $post['content'] ?? '' }}</textarea>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-success" onclick="addBlogPost()">+ Add Blog Post</button>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">Cancel</a>
            </div>
        </form>
    </div>
</section>

<script>
    function addMenuLink() {
        let container = document.getElementById('menu-links-container');
        let index = container.children.length;
        let div = document.createElement('div');
        div.classList.add('menu-link-item', 'border', 'p-3', 'mb-3', 'rounded');
        div.innerHTML = `<input type="text" name="header[menu_links][${index}][url]" placeholder="Menu URL" class="form-control mb-2">
                         <input type="text" name="header[menu_links][${index}][text]" placeholder="Menu Text" class="form-control">`;
        container.appendChild(div);
    }

    function addSocialLink() {
        let container = document.getElementById('social-links-container');
        let index = container.children.length;
        let div = document.createElement('div');
        div.classList.add('social-link-item', 'border', 'p-3', 'mb-3', 'rounded');
        div.innerHTML = `<input type="text" name="header[social_links][${index}][url]" placeholder="Social URL" class="form-control mb-2">
                         <input type="text" name="header[social_links][${index}][icon]" placeholder="Social Icon Class" class="form-control">`;
        container.appendChild(div);
    }
</script>
@endsection
