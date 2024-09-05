@extends('layouts.guest')
@php($page = 'about')
@php($title = 'About | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = 'About Lnkrr')

@section('content')
    <div class="page page-login">
        <div class="page_inner">
            <div
                class="page_banner"style="background-image: url(https://images.unsplash.com/photo-1610879068855-4189e55be5c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80)">
                <div class="page_banner_inner">
                    <div class="page_banner_content">
                        <h1>About</h1>
                        <p>What is Lnkrr (link-er)?</p>
                    </div>
                </div>
            </div>
            <div class="page_content container">
                <div class="page_content_inner">
                    <p>Lnkrr is a new website aimed at making it easier for you to display all of your links to your audience in one simple and easy to remember link!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
