@extends('layouts.app')

@section('title', 'Blogs - Digital Startups')

@section('content')
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2>Blogs</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Blogs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Blogs List</h3>
                <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create New Blog</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Featured Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                {{-- {{dd($blog)}} --}}
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->author}}</td>
                                <td>
                                    @if ($blog->featured_image)
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured Image" class="img-thumbnail" style="width: 100px; height: auto;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>

                                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm mr-2">Preview</a>

                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                            style="display:inline-block;" id="delete-form-{{ $blog->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $blog->id }})">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No blogs available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this blog?')) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
@endsection
