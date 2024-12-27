@extends('layouts.app')
@section('title', 'Login - Digital Startups')
@section('content')
    <div class="container blue-bg-mt py-md-5 pt-3">
        <div class="row w-100 d-block text-center">
            <h2 class="header-txt pb-3 mb-md-4 mb-3">Login or Create an Account</h2>
        </div>
        <div class="row d-flex flex-wrap justify-content-center mb-4">
            <div class="col-md-4 col-sm-4 crt-act-bg p-3">
                <p class="w-100 text-center">Already registered?</p>
                <p class="w-100 text-center">If you have an account with us, please log in.</p>
                <div class="col-md-12">
                    <form method="POST" id="loginFrm" action="{{ route('login') }}" class="mb-3">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control crt-act-fild @error('email') is-invalid @enderror"
                                id="email" placeholder="Email Address" name="email" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control crt-act-fild @error('password') is-invalid @enderror"
                                id="password" placeholder="Enter password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot pb-3">Forgot Your Password?</a>
                        <button type="submit" class="btn crtBtn mb-1" id="loginButton">Login</button>
                        <div class="crt-act-line mt-4"></div>
                        <p class="w-100 text-center pt-3">New Here?</p>
                        <a href="{{ route('register') }}" class="crtBtn" style="line-height: 30px;">Create an Account</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
