@extends('layouts.app')

@section('title', 'Roles - Digital Startups')
@section('content')
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Roles</h2>
                </div>
                <!-- Breadcrumb -->
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Roles</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Roles List</h3>
                <a href="{{ route('roles.create') }}" class="btn btn-primary">Create New Role</a>
            </div>

            <!-- Roles List Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge bg-info">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <!-- Edit Button -->
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="btn btn-warning btn-sm mr-2">Edit</a>

                                        <!-- Delete Button -->
                                        <!-- Delete Button -->
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                            style="display:inline-block;" id="delete-form-{{ $role->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $role->id }})">Delete</button>
                                        </form>

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
