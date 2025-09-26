@extends('layouts.app')

@section('title', 'Confirm Password | Strategic Pillars')
@section('meta_description', 'Confirm your password to access secure areas of your Strategic Pillars account.')

@section('content')
<div class="tf-section flat-confirm-password">
    <div class="cl-container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="modal-content">
                    <div class="image-left">
                        <h3>Confirm Your Password</h3>
                    </div>  
                    <div class="content-right">
                        <h4>Security Verification</h4>
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}" class="form-login">
                            @csrf
                            <fieldset class="password">
                                <input type="password" name="password" placeholder="Current Password" required autocomplete="current-password">
                                @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <div class="button-submit w-full">
                                <button class="tf-button-primary w-full" type="submit">Confirm Password<i class="icon-arrow-right-add"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
