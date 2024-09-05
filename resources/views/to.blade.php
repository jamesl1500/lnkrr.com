<?php
$links = DB::table('links')->where('user_id', $user->id)->get();

// Insert view for every page view. 1 per IP Address
if(!isset($_COOKIE['viewed-'.$user->id.'']))
{
    // Get IP address user_agent and country

    // Get country
    $country = isset($ip['country_name']) ? $ip['country_name'] : 'Unknown';
    $city = isset($ip['city']) ? $ip['city'] : 'Unknown';
    $region = isset($ip['region']) ? $ip['region'] : 'Unknown';
    $timezone = isset($ip['timezone']) ? $ip['timezone'] : 'Unknown';

    // Insert view
    DB::table('views')->insert([
        'user_id' => Auth::user()->id ? Auth::user()->id : $_SERVER['REMOTE_ADDR'],
        'viewed_user_id' => $user->id,
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'country' => $country ? $country : 'Unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown',
        'region' => $region ? $region : 'Unknown',
        'city' => $city ? $city : 'Unknown',
        'timezone' => $timezone ? $timezone : 'Unknown',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // Set cookie
    setcookie('viewed-' . $user->id, 'true', time() + (86400 * 30), "/");
}
?>
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
                        <div class="img" style="background-image: url(data:image;base64,<?php echo $user->profile_pic; ?>);" alt="Profile Picture"></div>
                    </div>
                    <div class="profile_info">
                        <h3><?php echo $user->name; ?></h3>
                        <p>URL: <?php echo $user->url; ?></p>
                    </div>
                    <div class="profile_stats">
                        <div class="profile_stat">
                            <h3><?php echo count($links); ?></h3>
                            <p><?php echo (count($links) == 1) ? 'Link' : 'Links'; ?></p>
                        </div>
                        <div class="profile_stat">
                            <?php
                            $views = DB::table('views')->where('viewed_user_id', $user->id)->get();
                            ?>
                            <h3><?php echo count($views); ?></h3>
                            <p><?php echo (count($views) == 1) ? 'View' : 'Views'; ?></p>
                        </div>
                        <div class="profile_stat">
                            <?php
                            $clicks = DB::table('clicks')->where('user_id', $user->id)->get();
                            ?>
                            <h3><?php echo count($clicks); ?></h3>
                            <p><?php echo (count($clicks) == 1) ? 'Click' : 'Clicks'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile_links_main_area container col-lg-7">
        <div class="left_blank_area"></div>
        <div class="middle_links_area">
            <p class="bio"><?php echo $user->bio; ?></p>
            <div class="top_links">
                <div class="inner_links">
                    <?php foreach(unserialize($user->bio_links) as $link){ ?>
                        <a title="<?php echo $link; ?>" href="<?php echo $link; ?>" class="btn pill sm" target="_blank"><i class="fa-regular fa-link"></i> <span><?php echo $link; ?></span></a>
                    <?php } ?>
                </div>
            </div>
            <h2>Links</h2>
            <ul class="links_area">
                <?php

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