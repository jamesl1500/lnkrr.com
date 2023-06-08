@extends('layouts.auth')
@php($page = 'home')
@php($title = 'Home | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = "Your home to view your analytics and manage your links")

@section('content')
    <div class="page page-home">
        <div class="page-banner" style="background-image: url(https://images.unsplash.com/photo-1610879068855-4189e55be5c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80)">
            <div class="page-banner-cover">
                <div class="page-banner-content">

                </div>
            </div>
        </div>
        <div class="page_top container col-lg-8">
            <!-- Welcome logged in user -->
            <div class="page_top_left col-lg-6">
                <h1>Welcome, <br>{{ Auth::user()->name }}</h1>
            </div>
        </div>
        <div class="page_content container col-lg-8">
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
            </div><br />
            <hr/><br />
            <!-- Links -->
            <div class="links_hold">
                <h2>Links</h2>
                <p>These are your current links!</p>
                <ul class="links_area">
                    <?php
                    $links = DB::table('links')->where('user_id', Auth::user()->id)->get();

                    // Loop through links and display them
                    if(count($links) > 0)
                    {
                        // Loop
                        foreach($links as $link)
                        {
                            ?>
                                <li><a href="<?php echo $link->url; ?>">
                                    <div class="image" style="background-image: url(data:image;base64,<?php echo $link->image; ?>);"></div>
                                    <div class="link_info">
                                        <h5><?php echo $link->name; ?></h5>
                                        <p><?php echo $link->url; ?></p>
                                    </div>
                                </a></li>
                            <?php
                        }
                    }else{
                        ?>
                        
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
@endsection