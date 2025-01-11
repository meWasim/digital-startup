@extends('layouts.app')

@section('title', 'User Details - Digital Startups')

@section('content')
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">User Details</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <h3 class="mb-4">User Information</h3>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Name:</div>
                        <div class="col-md-9">{{ $user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Email:</div>
                        <div class="col-md-9">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Role:</div>
                        <div class="col-md-9">{{ ucfirst($user->role) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Created At:</div>
                        <div class="col-md-9">{{ $user->created_at->format('d M Y, h:i A') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Updated At:</div>
                        <div class="col-md-9">{{ $user->updated_at->format('d M Y, h:i A') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
            </div>
        </div>
    </section>
@endsection
