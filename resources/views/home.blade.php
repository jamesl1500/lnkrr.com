@extends('layouts.auth')
@php($page = 'home')
@section('title', 'Lnkrr | Home')

@section('content')
    <div class="page container">
        <div class="page_top row">
            <!-- Welcome logged in user -->
            <div class="page_top_left col-lg-6">
                <h1>Welcome, <br>{{ Auth::user()->name }}</h1>
            </div>
        </div>
        <div class="page_content">
            <!-- Two column -->
            <div class="page_analytics">
                <div class="page_analytics_top">
                    <h4>Analytics</h4>
                </div>
                <div class="page_analytics_content row">
                    <div class="page_analytics_content_row col-lg-6">
                        <h3>Views</h3>
                        <h2>0</h2>
                    </div>
                    <div class="page_analytics_content_row col-lg-6">
                        <h3>Clicks</h3>
                        <h2>0</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection