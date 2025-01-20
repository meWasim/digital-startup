@extends('layouts.app')

@section('title', 'Edit User - Digital Startups')

@section('content')
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Edit User</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                        <li>Edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <h3 class="mb-4">Edit User</h3>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="Fname">First Name</label>
                    <input type="text" name="Fname" id="Fname" class="form-control @error('Fname') is-invalid @enderror" value="{{ old('Fname', $user->Fname) }}" required>
                    <div class="invalid-feedback">Please enter the first name.</div>
                </div>

                <div class="form-group">
                    <label for="Lname">Last Name</label>
                    <input type="text" name="Lname" id="Lname" class="form-control @error('Lname') is-invalid @enderror" value="{{ old('Lname', $user->Lname) }}" required>
                    <div class="invalid-feedback">Please enter the last name.</div>
                </div>

                <div class="form-group">
                    <label for="subdomain">Subdomain</label>
                    <input type="text" name="subdomain" id="subdomain" class="form-control @error('subdomain') is-invalid @enderror" value="{{ old('subdomain', $user->subdomain) }}" required>
                    <div class="invalid-feedback">Please enter the subdomain.</div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="form-group">
                    <label for="registration_countrycode">Country Code</label>
                    <input type="text" name="registration_countrycode" id="registration_countrycode" class="form-control @error('registration_countrycode') is-invalid @enderror" value="{{ old('registration_countrycode', $user->registration_countrycode) }}" required>
                    <div class="invalid-feedback">Please enter the country code.</div>
                </div>

                <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input type="text" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $user->telephone) }}" required>
                    <div class="invalid-feedback">Please enter the telephone number.</div>
                </div>

                <div class="form-group">
                    <label for="password">Password (Leave blank to keep current password)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->role == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a role.</div>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </section>
@endsection
