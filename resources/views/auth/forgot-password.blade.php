@extends('layouts.guest')
@php($page = 'forgot-password')
@php($title = 'Forgot Password | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = "Forgot your password? Don't worry we can help you reset it.")

@section('content')
    <div class="page page-login">
        <div class="page_inner">
            <div
                class="page_banner"style="background-image: url(https://images.unsplash.com/photo-1610879068855-4189e55be5c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80)">
                <div class="page_banner_inner">
                    <div class="page_banner_content">
                        <h1>Forgot Password</h1>
                        <p><?php echo $description; ?></p>
                    </div>
                </div>
            </div>
            <div class="page_content container">
                <div class="page_content_inner">
                    <form method="POST" action="<?php echo env('APP_URL'); ?>/forgot-password">
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
                            <input id="email" class="block mt-1 w-full" placeholder="Email" type="email"
                                name="email" value="{{old('email')}}" required autofocus />
                        </div>

                        <div class="form-group submit">
                            <input type="submit" class="btn " value="Email Password Reset Link">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection