@extends('layouts.guest')
@php($page = 'welcome')
@php($title = 'Welcome | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = 'Login to your account')

@section('content')
    <div class="page page-index">
        <div class="page_row row">
            <div class="page_left col-lg-8">
                <div class="page_banner">
                    <div class="page_banner_inner">
                        <div class="page_banner_content container">
                            <h1>Welcome to lnkrr</h1>
                            <p>We're making it easier for people like you to share your most important links by giving you the power to list them all in one custom page</p>
                            <div class="page_buttons">
                                <a href="{{ route('register') }}" class="btn">Get Started</a>
                                <a href="{{ route('login') }}" class="btn">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page_right col-lg-4">
                <div class="inner_page_right">
                    <div class="small_container_vertical_centered">
                        <!-- Vertically centered container -->
                        <div class="cont_head">
                            <h2>Login</h2>
                            <p>Login to your account</p>
                        </div>
                        <div class="cont_form">
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

                                <div class="form-group submit" style="padding-bottom: 0px;">
                                    @if (Route::has('password.request'))
                                        <a style="display: block;padding-bottom: 10px;" class="underline text-sm text-gray-600 hover:text-gray-900"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                    <input style="width: 100%;" type="submit" class="btn " value="Log In">
                                </div>
                            </form>
                        </div>
                        <hr/>
                        <div class="cont_link">
                            <a style="width: 100%;" class="btn" href="{{ route('register') }}">Don't have an account? Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
