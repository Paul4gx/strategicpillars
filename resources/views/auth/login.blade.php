@extends('layouts.app')

@section('title', 'Login | Strategic Pillars')
@section('meta_description', 'Sign in to your Strategic Pillars account to access exclusive luxury properties and personalized real estate services.')

@section('content')
<div class="tf-section flat-login bg-light">
    <div class="cl-container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="modal-content">
                    <div class="content-right">
                        <h4 class="text-center">Sign into your account</h4>
                        <form method="POST" action="{{ route('login') }}" class="form-login">
                            @csrf
                            <fieldset class="email">
                                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <fieldset class="password">
                                <input type="password" name="password" placeholder="Password" required>
                                @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <div class="flex items-center justify-between w-full">
                                <div class="checkbox-item">
                                    <label>
                                        <p>Remember me</p>
                                        <input type="checkbox" name="remember">
                                        <span class="btn-checkbox"></span>
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="lost-password">Lost your password?</a>
                                @endif
                            </div>
                            <div class="button-submit w-full">
                                <button class="tf-button-primary w-full" type="submit">Login<i class="icon-arrow-right-add"></i></button>
                            </div>
                        </form>
                        {{-- <div class="flex items-center justify-center">
                            <p>Not a member?</p>
                            <a href="{{ route('register') }}" class="btn-show-register">Register here</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
