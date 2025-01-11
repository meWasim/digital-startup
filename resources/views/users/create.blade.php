@extends('layouts.app')

@section('title', 'Create User - Digital Startups')

@section('content')
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Create User</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                        <li>Create</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <h3 class="mb-4">Create New User</h3>

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="form-group">
                    <label for="Fname">First Name</label>
                    <input type="text" name="Fname" id="Fname" class="form-control @error('Fname') is-invalid @enderror" required>
                    <div class="invalid-feedback">Please enter the first name.</div>
                </div>

                <div class="form-group">
                    <label for="Lname">Last Name</label>
                    <input type="text" name="Lname" id="Lname" class="form-control @error('Lname') is-invalid @enderror" required>
                    <div class="invalid-feedback">Please enter the last name.</div>
                </div>

                <div class="form-group">
                    <label for="subdomain">Subdomain</label>
                    <input type="text" name="subdomain" id="subdomain" class="form-control @error('subdomain') is-invalid @enderror" required>
                    <div class="invalid-feedback">Please enter the subdomain.</div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="form-group">
                    <label for="registration_countrycode">Country Code</label>
                    <input type="text" name="registration_countrycode" id="registration_countrycode" class="form-control @error('registration_countrycode') is-invalid @enderror" required>
                    <div class="invalid-feedback">Please enter the country code.</div>
                </div>

                <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input type="text" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" required>
                    <div class="invalid-feedback">Please enter the telephone number.</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    <div class="invalid-feedback">Please enter a password.</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    <div class="invalid-feedback">Please confirm the password.</div>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                        @forelse ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @empty
                            <option value="">No role available</option>
                        @endforelse
                    </select>
                    <div class="invalid-feedback">Please select a role.</div>
                </div>

                <button type="submit" class="btn btn-primary">Create User</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Bootstrap custom form validation
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission if invalid
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
