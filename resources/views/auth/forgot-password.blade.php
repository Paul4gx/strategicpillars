@extends('layouts.app')

@section('title', 'Forgot Password | Strategic Pillars')
@section('meta_description', 'Reset your Strategic Pillars account password. Enter your email address to receive a password reset link.')

@section('content')
<div class="tf-section flat-forgot-password bg-light">
    <div class="cl-container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="modal-content">
                    <div class="content-right">
                        <h4 class="text-center">Forgot your password?</h4>
                        <div class="mb-4 text-gray-600" style="font-size: 14px;line-height: 1.5;">
                            {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" style="font-size: 14px;line-height: 1.5;padding:10px;background-color: #f0f0f0;border-radius: 5px;" />

                        <form method="POST" action="{{ route('password.email') }}" class="form-login">
                            @csrf
                            <fieldset class="email">
                                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <div class="button-submit w-full">
                                <button class="tf-button-primary w-full" type="submit">Email Password Reset Link<i class="icon-arrow-right-add"></i></button>
                            </div>
                        </form>
                        <div class="flex items-center justify-center">
                            <p>Remember your password?</p>
                            <a href="{{ route('login') }}" class="btn-show-register">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
