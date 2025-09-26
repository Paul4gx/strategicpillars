@extends('layouts.app')

@section('title', 'Verify Email | Strategic Pillars')
@section('meta_description', 'Verify your email address to complete your Strategic Pillars account setup and access all features.')

@section('content')
<div class="tf-section flat-verify-email">
    <div class="cl-container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="modal-content">
                    <div class="image-left">
                        <h3>Verify Your Email</h3>
                    </div>  
                    <div class="content-right">
                        <h4>Email Verification Required</h4>
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}" class="form-login">
                                @csrf
                                <div class="button-submit w-full">
                                    <button class="tf-button-primary w-full" type="submit">Resend Verification Email<i class="icon-arrow-right-add"></i></button>
                                </div>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="flex items-center justify-center">
                                <button type="submit" class="btn-show-register">
                                    {{ __('Log Out') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
