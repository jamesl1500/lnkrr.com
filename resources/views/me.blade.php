@extends('layouts.auth')
@php($page = 'me')
@php($title = 'Me | ' . env('APP_NAME') . '')
@php($no_padding = true)
@php($description = 'View and Edit your profile.')

@section('content')
<div class="edit_profile_page">
    <div class="edit_profile_left_container">
        <div class="edit_profile_center">
            <div class="left_sidebar">
                <!-- Vertical links -->
                <div class="inner_sidebar">
                    <div class="profile_image">
                        <img src="data:image;base64,<?php echo Auth::user()->profile_pic; ?>" alt="">
                    </div>
                    <ul>
                        <li data-toggle="tooltip" data-placement="top" title="Basic Info" class="profile_edit_link active" data-open='1'><i class="fa-regular fa-circle-user"></i></li>
                        <li data-toggle="tooltip" data-placement="top" title="Links" class="profile_edit_link" data-open='2'><i class="fa-solid fa-list"></i></li>
                        <li data-toggle="tooltip" data-placement="top" title="Edit Design" class="profile_edit_link" data-open='3'><i class="fa-solid fa-paintbrush"></i></li>
                        <li data-toggle="tooltip" data-placement="top" title="Donations" class="profile_edit_link" data-open='4'><i class="fa-solid fa-credit-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="right_edit_area">
                <div class="edit_profile_top">
                    <h4>Me</h4>
                    <p>This is your unique link page. Customize it to your liking!</p>
                </div>
                <div class="inner_edit_forms">
                    <div class="edit_form active" id="edit_form_1">
                        <h2>Basic Info</h2>
                        <form action="{{ route('me.editProfileForm_BasicInfo') }}" method="post" enctype="multipart/form-data" id="edit_profile_form">
                            <div class="form-group">
                                <label class="md" for="profile_pic">Images</label>
                                <div class="input-file-group">
                                    <div class="input-file photo-sm" id="profile_pic_file_preview" style="background-image: url(data:image;base64,<?php echo Auth::user()->profile_pic; ?>);">
                                        <input data-toggle="tooltip" data-placement="top" title="Profile Pic" type="file" name="profile_pic" id="profile_pic" placeholder="Profile Picture">
                                    </div>
                                    <div class="input-file photo-lg" id="banner_pic_file_preview" style="background-image: url(data:image;base64,<?php echo Auth::user()->background_pic; ?>);">
                                        <input data-toggle="tooltip" data-placement="top" title="Banner Pic" type="file" name="banner_pic" id="banner_pic" placeholder="Banner Picture">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="md" for="profile_username">Username</label>
                                <p>URL: lnkrr.com/to/<span id="username_update"><?php echo Auth::user()->url; ?></span></p>
                                <input type="text" name="profile_username" id="profile_username" placeholder="Username" value="<?php echo Auth::user()->url; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="md" for="profile_name">Name</label>
                                <input type="text" name="profile_name" id="profile_name" placeholder="Name" value="<?php echo Auth::user()->name; ?>">
                            </div>
                            <div class="form-group">
                                <label class="md" for="profile_bio">Bio</label>
                                <input type="text" name="profile_bio" id="profile_bio" placeholder="Bio" value="<?php echo Auth::user()->bio; ?>">
                            </div>
                            <div class="form-group">
                                <!-- Add multiple links -->
                                <label class="md" for="profile_links">Social Links</label>

                                <div class="add_social_links_hold">
                                    <div class="inner_add_social_links_hold" id="inner_add_social_links_hold">
                                        <?php if(count(unserialize(Auth::user()->bio_links)) == 0){ ?>
                                            <div class="input_add_row">
                                                <input type="text" class="form-control" id="profile_links" name="profile_links[]" placeholder="Link">
                                            </div>
                                        <?php }else{ ?>
                                            <?php foreach(unserialize(Auth::user()->bio_links) as $link){ ?>
                                                <div class="input_add_row">
                                                    <input type="text" class="form-control" id="profile_links" name="profile_links[]" placeholder="Link" value="<?php echo $link; ?>">
                                                    <button class='btn btn-primary btn-sm warning btn-delete-row' id='add_social_link_btn'><i class='fa-regular fa-minus'></i></button>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <button class="btn btn-primary btn-sm" id="add_social_link_btn"><i class="fa-regular fa-plus"></i></button>
                                </div>
                            </div>
                            <hr />
                            @csrf
                            <input type="hidden" id="save_status" value="0">
                            <input type="submit" value="Save Changes" class="btn btn-primary btn-block btn-lg" id="save_changes_btn">
                        </form>
                    </div>
                    <div class="edit_form" id="edit_form_2">
                        <h2>Links</h2>
                        <div class="links_holder">
                            <div class="form-group" id="link_pri_hold">
                                <?php
                                // Fetch all links from database belonging to logged in user
                                $links = DB::table('links')->where('user_id', Auth::user()->id)->get();

                                // Loop through links and display them
                                if(count($links) > 0)
                                {
                                    // Loop
                                    foreach($links as $link)
                                    {
                                        ?>
                                        <div class="link_main_row" id="link-<?php echo $link->id; ?>" data-linkID="<?php echo $link->id; ?>">
                                            <div class="link_row_preview">
                                                <div class="inner_row">
                                                    <div class="image" style="background-image: url(data:image;base64,<?php echo $link->image; ?>);"></div>
                                                    <div class="link_info">
                                                        <h4><?php echo $link->name; ?></h4>
                                                        <a href="<?php echo $link->url; ?>" target="_blank"><?php echo $link->url; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="link_row hide saved_link" draggable="true">
                                                <form action="{{ route('links.update', $link->id) }}" method="post" enctype="multipart/form-data">
                                                    <div class="inner_row">
                                                        <div class="image" style="background-image: url(data:image;base64,<?php echo $link->image; ?>);">
                                                            <input type="file" name="link_image" id="link_image-<?php echo $link->id; ?>" class="link_image" data-toggle="tooltip" data-placement="top" title="Link Image">
                                                        </div>
                                                        <div class="link_info">
                                                            <input type="text" id="link_name-<?php echo $link->id; ?>" name="link_name" placeholder="Link Name" value="<?php echo $link->name; ?>">
                                                            <div class="bottom_link_info">
                                                                <input type="text" id="link_url-<?php echo $link->id; ?>" name="link_url" placeholder="Link URL" value="<?php echo $link->url; ?>">
                                                                <button class="btn btn-update">Update</button> <a data-linkid="<?php echo $link->id; ?>" class="btn delete_link_btn warning" href="{{ route('links.destroy', $link->id) }}"><i class="fa-solid fa-x"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @csrf
                                                    <input type="hidden" name="link_id" value="<?php echo $link->id; ?>">
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <h3>You have no links!</h3>
                                    <p>Add some links using the form below. They'll be added to your profile!</p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <hr />
                        <p>Add a new link!</p>
                        <form action="{{ route('links.addLink') }}" method="post" enctype="multipart/form-data" id="add_new_link_form">
                            <div class="form-group">
                                <div class="link_row actual_form" draggable="true">
                                    <div class="inner_row">
                                        <div class="image" id="new_link_image" style="background-image: url({{ asset('imgs/no_image_selected.png') }});">
                                            <input type="file" name="link_image" id="link_image" class="link_image" data-toggle="tooltip" data-placement="top" title="Link Image">
                                        </div>
                                        <div class="link_info">
                                            <input required type="text" id="link_name" name="link_name" placeholder="Link Name">
                                            <div class="bottom_link_info">
                                                <input required type="text" id="link_url" name="link_url" placeholder="Link URL">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            <input type="hidden" id="save_status" value="0">
                            <input type="submit" value="Save New Link" class="btn btn-primary btn-block btn-lg" id="save_changes_btn">
                        </form>
                    </div>
                    <div class="edit_form" id="edit_form_3">
                        <form action="">
                            Page Style
                        </form>
                    </div>
                    <div class="edit_form" id="edit_form_4">
                        <form action="">
                            Basic Info
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="edit_profile_right_container">
        <div class="preview_phone">
            <div class="inner_preview_phone">
                <div id="preview_phone_top" class="preview_phone_top" style="background-image: url(data:image;base64,<?php echo Auth::user()->background_pic; ?>);" >
                    <div class="preview_phone_top_cover">
                        <div id="preview_phone_top_background_img" class="preview_phone_top_background_img" style="background-image: url(data:image;base64,<?php echo Auth::user()->profile_pic; ?>);"></div>
                    </div>
                </div>
                <div class="preview_phone_bottom">
                    <div class="top_profile">
                        <div class="inner_top_profile">
                            <div class="top_profile_info">
                                <h4><a id="name_update" href="<?php echo env('APP_URL'); ?>/to/<?php echo Auth::user()->url; ?>"><?php echo Auth::user()->name; ?></a></h4>
                                <p><?php echo Auth::user()->bio; ?></p>
                            </div>
                        </div>
                        <div class="top_links">
                            <div class="inner_links">
                                <?php foreach(unserialize(Auth::user()->bio_links) as $link){ ?>
                                    <a data-toggle="tooltip" data-placement="top" title="<?php echo $link; ?>" href="<?php echo $link; ?>" class="btn pill sm" target="_blank"><i class="fa-regular fa-link"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="preview_phone_links" >
                    <ul id="preview_phone_links">
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
    </div>
</div>
@endsection
