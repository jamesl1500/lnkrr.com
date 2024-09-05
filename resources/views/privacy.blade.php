@extends('layouts.guest')
@php($page = 'about')
@php($title = 'Privacy Policy | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = 'Privacy Policy')

@section('content')
    <div class="page page-login">
        <div class="page_inner">
            <div
                class="page_banner"style="background-image: url(https://images.unsplash.com/photo-1610879068855-4189e55be5c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80)">
                <div class="page_banner_inner">
                    <div class="page_banner_content">
                        <h1>Privacy Policy</h1>
                        <p>How do we handle your data?</p>
                    </div>
                </div>
            </div>
            <div class="page_content container">
                <div class="page_content_inner">
                    <p>Lnkrr does not sale any of your data or personal information. All of your information is kept safely on our backend and is encrypted!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
