@extends('layouts.guest')
@php($page = 'login')
@php($title = 'Login | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = 'Login to your account')

@section('content')
    <div class="page page-login">
        <div class="page_inner">
            <div
                class="page_banner"style="background-image: url(https://images.unsplash.com/photo-1610879068855-4189e55be5c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80)">
                <div class="page_banner_inner">
                    <div class="page_banner_content">
                        <h1>Login</h1>
                        <p>Log in to your account.</p>
                    </div>
                </div>
            </div>
            <div class="page_content container">
                <div class="page_content_inner">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="display_errors">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="errors_list">
                                        @foreach ($errors->all() as $error)
                                            <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="login_buttons">
                            <!-- Display One click login buttons -->
                            <a href="{{ url('/auth/redirect/google') }}" class="login_button btn google">
                                <i class="fab fa-google"></i>
                                <span>Google</span>
                            </a>
                            <a href="{{ url('/auth/redirect/twitter') }}" class="login_button btn twitter">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="{{ url('/auth/redirect/facebook') }}" class="login_button btn facebook">
                                <i class="fab fa-facebook"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                        <hr>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" value="__('Email')">Email</label>
                            <input id="email" class="block mt-1 w-full" placeholder="Email" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" value="__('Password')">Password</label>
                            <input id="password" class="block mt-1 w-full" placeholder="Password" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="form-group submit">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                            <input type="submit" class="btn " value="Log In">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
