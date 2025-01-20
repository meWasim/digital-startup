@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Template</h2>
    <form method="POST" action="{{ route('template.update', $templateId) }}" enctype="multipart/form-data">
        @csrf

        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Header</h4>
            </div>
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
                                <div class="form-group">
                                    <label for="menu_url_{{ $index }}">Menu URL</label>
                                    <input type="text" name="header[menu_links][{{ $index }}][url]" id="menu_url_{{ $index }}" class="form-control" value="{{ $menu['url'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="menu_text_{{ $index }}">Menu Text</label>
                                    <input type="text" name="header[menu_links][{{ $index }}][text]" id="menu_text_{{ $index }}" class="form-control" value="{{ $menu['text'] ?? '' }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Social Links -->
                <div class="form-group">
                    <label>Social Links</label>
                    <div id="social-links-container">
                        @foreach ($header->social_links ?? [['url' => '', 'icon' => '']] as $index => $social)
                            <div class="social-link-item border p-3 mb-3 rounded">
                                <div class="form-group">
                                    <label for="social_url_{{ $index }}">Social URL</label>
                                    <input type="text" name="header[social_links][{{ $index }}][url]" id="social_url_{{ $index }}" class="form-control" value="{{ $social['url'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="social_icon_{{ $index }}">Social Icon Class</label>
                                    <input type="text" name="header[social_links][{{ $index }}][icon]" id="social_icon_{{ $index }}" class="form-control" value="{{ $social['icon'] ?? '' }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="header[phone_number]" id="phone_number" class="form-control" value="{{ $header->phone_number ?? '' }}">
                </div>

                <!-- Image Upload Fields -->
                <div class="form-group">
                    <label for="header_logo">Header Logo</label>
                    <input type="file" name="header[logo]" id="header_logo" class="form-control">
                    @if ($header && $header->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $header->logo) }}" alt="Logo" class="img-fluid" style="max-width: 200px;">
                    </div>
                @endif
                </div>
            </div>
        </div>

        <!-- About Us Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>About Us</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="ourStory">Our Story</label>
                    <textarea name="our_story" id="ourStory" class="form-control" rows="3">{{ $aboutUs->our_story ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="mission">Mission</label>
                    <textarea name="mission" id="mission" class="form-control" rows="3">{{ $aboutUs->mission ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="vision">Vision</label>
                    <textarea name="vision" id="vision" class="form-control" rows="3">{{ $aboutUs->vision ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Services</h4>
            </div>
            <div class="card-body">
                @foreach (range(0, 2) as $index)
                    @php $service = $services[$index] ?? null; @endphp
                    <div class="service-item border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="service_title_{{ $index }}">Service Title</label>
                            <input type="text" name="services[{{ $index }}][title]" id="service_title_{{ $index }}" class="form-control" value="{{ $service->title ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="service_subtitle_{{ $index }}">Service Subtitle</label>
                            <input type="text" name="services[{{ $index }}][subtitle]" id="service_subtitle_{{ $index }}" class="form-control" value="{{ $service->subtitle ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="service_image_{{ $index }}">Service Image</label>
                            <input type="file" name="services[{{ $index }}][image]" id="service_image_{{ $index }}" class="form-control">
                            @if ($service && $service->image_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $service->image_path) }}" alt="Service Image" class="img-fluid" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
<!-- Blog Section -->
<h3>Our Blog</h3>
<div class="form-group">
    <label>Blog Posts</label>
    <div id="blog-container">
        @foreach ($header->blog_posts ?? [['title' => '', 'image_url' => '', 'published_at' => '', 'content' => '']] as $index => $post)
        <div class="blog-post-item border p-3 mb-3">
            <div class="form-group">
                <label for="blog_title_{{ $index }}">Blog Title</label>
                <input type="text" name="header[blog_posts][{{ $index }}][title]" id="blog_title_{{ $index }}" class="form-control" value="{{ $post['title'] ?? '' }}">
            </div>

            <div class="form-group">
                <label for="blog_image_{{ $index }}">Blog Image</label>
                <input type="file" name="header[blog_posts][{{ $index }}][image]" id="blog_image_{{ $index }}" class="form-control">
                @if(isset($post['image_url']))
                    <img src="{{ asset('storage/' . $post['image_url']) }}" alt="{{ $post['title'] ?? 'Blog Image' }}" class="mt-2" style="max-width: 100px;">
                @endif
            </div>

            <div class="form-group">
                <label for="blog_published_at_{{ $index }}">Published Date</label>
                <input type="date" name="header[blog_posts][{{ $index }}][published_at]" id="blog_published_at_{{ $index }}" class="form-control" value="{{ $post['published_at'] ?? '' }}">
            </div>

            <div class="form-group">
                <label for="blog_content_{{ $index }}">Blog Content</label>
                <textarea name="header[blog_posts][{{ $index }}][content]" id="blog_content_{{ $index }}" class="form-control" rows="3">{{ $post['content'] ?? '' }}</textarea>
            </div>
        </div>
        @endforeach
    </div>
</div>
        <!-- Features Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Features</h4>
            </div>
            <div class="card-body">
                @foreach (range(0, 2) as $index)
                    @php $feature = $features[$index] ?? null; @endphp
                    <div class="feature-item border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="feature_title_{{ $index }}">Feature Title</label>
                            <input type="text" name="features[{{ $index }}][title]" id="feature_title_{{ $index }}" class="form-control" value="{{ $feature->title ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="feature_description_{{ $index }}">Feature Description</label>
                            <textarea name="features[{{ $index }}][description]" id="feature_description_{{ $index }}" class="form-control" rows="3">{{ $feature->description ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="feature_image_{{ $index }}">Feature Image</label>
                            <input type="file" name="features[{{ $index }}][image]" id="feature_image_{{ $index }}" class="form-control">
                            @if ($feature && $feature->image_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $feature->image_path) }}" alt="Feature Image" class="img-fluid" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">Cancel</a>
        </div>
    </form>
</div>
@endsection
