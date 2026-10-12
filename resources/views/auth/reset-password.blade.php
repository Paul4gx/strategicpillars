@extends('layouts.app')

@section('title', 'Reset Password | Strategic Pillars')
@section('meta_description', 'Set a new password for your Strategic Pillars account. Enter your new password to complete the reset process.')

@section('content')
<div class="tf-section flat-login bg-light">
    <div class="cl-container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="modal-content">
                    <div class="content-right">
                        <h4 class="text-center mb-10">Reset your password</h4>
                        <p class="text-center text-muted mb-20">Choose a new password for your account.</p>
                        <form method="POST" action="{{ route('password.store') }}" class="form-login">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <fieldset class="email">
                                <input type="email" name="email" placeholder="Email Address" value="{{ old('email', $request->email) }}" readonly required autocomplete="username" class="bg-light">
                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <fieldset class="password">
                                <input type="password" name="password" placeholder="New Password" required autocomplete="new-password">
                                @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <fieldset class="password">
                                <input type="password" name="password_confirmation" placeholder="Confirm New Password" required autocomplete="new-password">
                                @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <div class="button-submit w-full">
                                <button class="tf-button-primary w-full" type="submit">Reset Password<i class="icon-arrow-right-add"></i></button>
                            </div>
                        </form>
                        <div class="flex items-center justify-center mt-15">
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
