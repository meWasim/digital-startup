@extends('layouts.app')

@section('title', 'Templates - Digital Startups')

@section('content')
    <!-- Header Section -->
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Templates</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Templates</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Templates Section -->
    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Templates List</h3>
                <a href="{{ route('admin.templates.create') }}" class="btn btn-primary">Upload New Template</a>
            </div>

            <!-- Templates Table -->
            <div class="table-responsive">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $template)
                            <tr>

                                <td>{{ $template->name }}</td>
                                <td><img src="{{ asset('storage/' . $template->thumbnail) }}" alt="{{ $template->name }}"
                                        width="100"></td>
                                <td>
                                    <div class="d-flex">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.templates.edit', $template->id) }}"
                                            class="btn btn-warning btn-sm mr-2">Edit</a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mr-2">Delete</button>
                                        </form>
                                        <a href="template-master/001-robax-pest-control/" target="_blank"></a>

                                        {{-- <a href="template-master/{{$template->folder}}" target="_blank"
                                            class="btn btn-info btn-sm">Preview</a> --}}
                                            <a href="{{ url('template-preview/' . $template->folder) }}" target="_blank" class="btn btn-info btn-sm">Preview</a>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
