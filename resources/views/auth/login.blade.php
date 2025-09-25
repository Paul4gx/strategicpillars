<x-guest-layout>
<div class="login-container">
    <div class="modal-content modal-sm" style="margin: 40px auto; max-width: 400px;">
        <div class="image-left" style="text-align: center;">
            <img src="{{ asset('template/images/section/login.jpg') }}" alt="" style="max-width: 100px; margin-bottom: 10px;">
            <h3>Welcome to Your Real Estate Website</h3>
        </div>
        <div class="content-right">
            <h4>Sign into your account</h4>
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
                <div class="button-submit w-full" style="margin-top: 20px;">
                    <button class="tf-button-primary w-full" type="submit">Login<i class="icon-arrow-right-add"></i></button>
                </div>
            </form>
            <div class="flex items-center justify-center" style="margin-top: 10px;">
                <p>Not a member?</p>
                <a href="{{ route('register') }}" class="btn-show-register">Register here</a>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>
