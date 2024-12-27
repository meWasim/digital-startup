@extends('layouts.app')
@section('title', 'Register - Digital Startups')
@section('content')
    <div class="container blue-bg-mt py-md-5 pt-3">
        <div class="row w-100 d-block text-center">
            <h2 class="header-txt pb-3 mb-md-4 mb-3">Create An Account</h2>
        </div>
        <div class="row d-flex flex-wrap justify-content-center mb-4">
            <div class="col-md-4 col-sm-4 crt-act-bg p-3">
                <p class="w-100 text-center">Register Using</p>
                <p class="w-100 text-center">Please enter the following information to create your account.</p>
                <div class="col-md-12">
                    <form action="{{ route('register') }}" method="POST" id="loginFrm">
                        @csrf <!-- Laravel CSRF token for form security -->

                        <!-- First Name -->
                        <div class="form-group">
                            <input type="text" class="form-control crt-act-fild @error('Fname') is-invalid @enderror"
                                placeholder="First Name" name="Fname" value="{{ old('Fname') }}">
                            @error('Fname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <input type="text" class="form-control crt-act-fild @error('Lname') is-invalid @enderror"
                                placeholder="Last Name" name="Lname" value="{{ old('Lname') }}">
                            @error('Lname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <input type="email" class="form-control crt-act-fild @error('email') is-invalid @enderror"
                                placeholder="Email Address" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Phone -->

                        <div class="input-box">

                            <!-- Country Code Select -->
                            <select name="registration_countrycode" class="crt-act-fild">
                                @foreach ($countryCodes as $countryCode)
                                    <option value="{{ $countryCode }}"
                                            {{ old('registration_countrycode', '(+91)') == $countryCode ? 'selected' : '' }}>
                                        {{ $countryCode }}
                                    </option>
                                @endforeach
                            </select>
                            @error('registration_countrycode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Phone Number Input -->
                            <input type="text" name="telephone" id="phone" placeholder="Mobile No."
                                class="crt-act-fild w-75 @error('telephone') is-invalid @enderror"
                                value="{{ old('telephone') }}">

                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" class="form-control crt-act-fild @error('password') is-invalid @enderror"
                                placeholder="Password" name="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <input type="password"
                                class="form-control crt-act-fild @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm Password" name="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mt-3">
                            <button type="submit" class="btn crtBtn mb-1" id="loginButton">Create Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
