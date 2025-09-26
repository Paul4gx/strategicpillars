@extends('layouts.app')

@section('title', 'Register | Strategic Pillars')
@section('meta_description', 'Create your Strategic Pillars account to access exclusive luxury properties, personalized recommendations, and premium real estate services.')

@section('content')
<div class="tf-section flat-register">
    <div class="cl-container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="modal-content">
                    <div class="image-left">
                        <h3>Join Strategic Pillars</h3>
                    </div>  
                    <div class="content-right">
                        <h4>Create your account</h4>
                        <form method="POST" action="{{ route('register') }}" class="form-login">
                            @csrf
                            <fieldset class="name">
                                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <fieldset class="email">
                                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <fieldset class="password">
                                <input type="password" name="password" placeholder="Password" required>
                                @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <fieldset class="password">
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
                            </fieldset>
                            <div class="flex items-center justify-between">
                                <div class="checkbox-item">
                                    <label>
                                        <p>I agree with terms & conditions</p>
                                        <input type="checkbox" name="terms" required>
                                        <span class="btn-checkbox"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="button-submit w-full">
                                <button class="tf-button-primary w-full" type="submit">Register<i class="icon-arrow-right-add"></i></button>
                            </div>
                        </form>
                        <div class="flex items-center justify-center">
                            <p>Have an account?</p>
                            <a href="{{ route('login') }}" class="btn-show-register">Log in</a>
                        </div>
                        <ul class="wg-social-1">
                            <li><a href="#"><i class="flaticon-google"></i></a></li>
                            <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                            <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
