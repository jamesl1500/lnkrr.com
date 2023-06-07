@extends('layouts.auth')
@php($page = 'to')
@php($title = ''.$user->name.' | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = $user->bio)

@section('content')
<div class="profile_page">
    <div class="profile_banner" style="background-image: url(data:image;base64,<?php echo $user->background_pic; ?>);">
        <div class="profile_banner_cover">
            <div class="bottom_profile_main container">
                <div class="inner_bottom_profile_main">
                    <div class="profile_pic">
                        <img src="data:image;base64,<?php echo $user->profile_pic; ?>" alt="Profile Picture">
                    </div>
                    <div class="profile_info">
                        <h3><?php echo $user->name; ?></h3>
                        <p>URL: <?php echo $user->url; ?></p>
                        <p class="bio"><?php echo $user->bio; ?></p>
                    </div>
                    <div class="profile_stats">
                        <div class="profile_stat">
                            <h3>100</h3>
                            <p>Links</p>
                        </div>
                        <div class="profile_stat">
                            <h3>100</h3>
                            <p>Views</p>
                        </div>
                        <div class="profile_stat">
                            <h3>100</h3>
                            <p>Clicks</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile_links_main_area container col-lg-7">
        <div class="left_blank_area"></div>
        <div class="middle_links_area">
            <h2>Links</h2>
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