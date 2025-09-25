<x-guest-layout>
<div class="register-container">
    <div class="modal-content modal-sm" style="margin: 40px auto; max-width: 400px;">
        <div class="image-left" style="text-align: center;">
            <img src="{{ asset('template/images/section/login.jpg') }}" alt="" style="max-width: 100px; margin-bottom: 10px;">
            <h3>Welcome to Your Real Estate Website</h3>
        </div>
        <div class="content-right">
            <h4>Create an account</h4>
            <form method="POST" action="{{ route('register') }}" class="form-login">
                @csrf
                <fieldset class="name">
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </fieldset>
                <fieldset class="email">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                </fieldset>
                <fieldset class="password">
                    <input type="password" name="password" placeholder="Password" required>
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                </fieldset>
                <fieldset class="password">
                    <input type="password" name="password_confirmation" placeholder="Retype Password" required>
                    @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
                </fieldset>
                <div class="flex items-center justify-between">
                    <div class="checkbox-item">
                        <label>
                            <p>I agree with terms & conditions</p>
                            <input type="checkbox" required>
                            <span class="btn-checkbox"></span>
                        </label>
                    </div>
                </div>
                <div class="button-submit" style="margin-top: 20px;">
                    <button class="tf-button-primary w-full" type="submit">Register<i class="icon-arrow-right-add"></i></button>
                </div>
            </form>
            <div class="flex items-center justify-center" style="margin-top: 10px;">
                <p>Have an account?</p>
                <a href="{{ route('login') }}" class="btn-show-register">Log in</a>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>
