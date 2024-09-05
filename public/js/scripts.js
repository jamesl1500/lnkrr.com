// jQuery
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

// Global variables
var base_url = $('meta[name="base-url"]').attr('content');
var csrf = $('meta[name="csrf-token"]').attr('content');
var api_token = $('meta[name="api-token"]').attr('content');

/**
 * EditProfileNavigation
 * ---------------------
 * This will provide the sidebar navigation of our edit profile page
 */
const EditProfileNavigation = (e) => {
    var id = e.currentTarget.getAttribute('data-open');
    
    // Remove the active class from all the edit forms
    document.querySelector('.edit_form.active').classList.remove('active');
    document.getElementById('edit_form_' + id).classList.toggle('active');

    // Remove the active class from all the edit links
    document.querySelector('.profile_edit_link.active').classList.remove('active');
    e.currentTarget.classList.toggle('active');
}

// Add the event listener to the profile_edit_link class
document.querySelectorAll('.profile_edit_link').forEach(item => {
    item.addEventListener('click', EditProfileNavigation)
});

/**
 * EditUsernameUpdate
 * ------------------
 * This will update the username of the user in real time as they type
 **/
const EditUsernameUpdate = (e) => {
    var username = e.currentTarget.value;

    if(username.length > 0) {
        document.getElementById('username_update').innerHTML = username;
        e.currentTarget.classList.remove('error');
    }else{
        e.currentTarget.classList.add('error');
        e.currentTarget.focus();
        e.currentTarget.attributes['placeholder'].value = 'Username cannot be empty';
        document.getElementById('username_update').innerHTML = 'Username cannot be empty';
    }
}

// Add the event listener to the username input
document.getElementById('profile_username').addEventListener('keyup', EditUsernameUpdate);

/**
 * EditNameUpdate
 * ------------------
 * This will update the name of the user in real time as they type
 **/
const EditNameUpdate = (e) => {
    var username = e.currentTarget.value;

    if(username.length > 0) {
        document.getElementById('name_update').innerHTML = username;
        e.currentTarget.classList.remove('error');
    }else{
        e.currentTarget.classList.add('error');
        e.currentTarget.focus();
        e.currentTarget.attributes['placeholder'].value = 'Username cannot be empty';
        document.getElementById('name_update').innerHTML = 'Username cannot be empty';
    }
}

// Add the event listener to the username input
document.getElementById('profile_name').addEventListener('keyup', EditNameUpdate);


/**
 * EditProfilePictureUpdatePreview
 * -------------------------------
 * This will update the profile picture preview in real time as the user selects a new image
 * to upload
 **/
const EditProfilePictureUpdatePreview = (e) => {
    var file = e.currentTarget.files[0];
    var reader = new FileReader();

    reader.addEventListener('load', function () {
        document.getElementById('preview_phone_top_background_img').setAttribute('style', 'background-image: url(' + this.result + ');');
        document.getElementById('profile_pic_file_preview').setAttribute('style', 'background-image: url(' + this.result + ');');
    });

    if(file) {
        reader.readAsDataURL(file);
    }
}

// Add the event listener to the profile_picture input
document.getElementById('profile_pic').addEventListener('change', EditProfilePictureUpdatePreview);

/**
 * EditBackgroundPictureUpdatePreview
 * -------------------------------
 * This will update the profile picture preview in real time as the user selects a new image
 * to upload
 **/
const EditBackgroundPictureUpdatePreview = (e) => {
    var file = e.currentTarget.files[0];
    var reader = new FileReader();

    reader.addEventListener('load', function () {
        document.getElementById('preview_phone_top').setAttribute('style', 'background-image: url(' + this.result + ');');
        document.getElementById('banner_pic_file_preview').setAttribute('style', 'background-image: url(' + this.result + ');');
    });

    if(file) {
        reader.readAsDataURL(file);
    }
}

// Add the event listener to the profile_picture input
document.getElementById('banner_pic').addEventListener('change', EditBackgroundPictureUpdatePreview);

/**
 * EditProfileAppendLink
 * ---------------------
 * This will append a new link to the edit profile page
 */
const EditProfileAppendLink = (e) => {
    e.preventDefault();
    var newInputRow = "<div class='input_add_row'>" +
                        "<input type='text' class='form-control' id='profile_links' name='profile_links[]' placeholder='Link'>" +
                        "<button class='btn btn-primary btn-sm warning btn-delete-row' id='add_social_link_btn'><i class='fa-regular fa-minus'></i></button>" +
                        "</div>";
    
    // Append now
    document.getElementById('inner_add_social_links_hold').insertAdjacentHTML('beforeend', newInputRow);

    // Add the event listener to the btn-delete-row
    addEventListenerToDelBtn();
    return false;
}

// Add the event listener to the add_social_link_btn
document.getElementById('add_social_link_btn').addEventListener('click', EditProfileAppendLink);

/**
 * DeleteSocialLinkRow
 * -------------------
 * This will delete the social link row
 */
const DeleteSocialLinkRow = (e) => {
    e.preventDefault();

    // Remove the parent element
    e.currentTarget.parentElement.remove();
}

// Add the event listener to the btn-delete-row
const addEventListenerToDelBtn = (e) => {
    document.querySelectorAll('.btn-delete-row').forEach(item => {
        item.addEventListener('click', DeleteSocialLinkRow)
    });
}

addEventListenerToDelBtn();

/**
 * EditProfileFormSubmit
 * ---------------------
 * This will submit the edit profile form
 */
const EditProfileFormSubmit = async (e) => {
    e.preventDefault();

    // Get the form data
    var formData = new FormData(e.currentTarget);
    var values = [...formData.entries()];

    // Get the form action
    var formAction = e.currentTarget.getAttribute('action');

    // Get the form method
    var formMethod = e.currentTarget.getAttribute('method');

    // Make post request
    var post = await fetch(formAction, {
        method: formMethod,
        body: formData,
        accept: "application/json",
        headers: {
            'X-CSRF-TOKEN': csrf,
            '_token': csrf,
        }
    });

    // Get the response
    var response = await post.json();

    // Check if the response was successful
    if(post.status == 200) {
        Alert("Profile Saved Successfully!", "success", "Success", "top-right", 5000);
    } else {
        Alert("Profile was not added successfully!", "danger", "Error", "top-right", 5000);
    }

}

// Add the event listener to the edit_profile_form
document.getElementById('edit_profile_form').addEventListener('submit', EditProfileFormSubmit);

/**
 * AddNewLinkSubmit
 * ----------------
 * This will submit the add new link form
 */
const AddNewLinkSubmit = async (e) => {
    e.preventDefault();

    // Get the form data
    var formData = new FormData(e.currentTarget);

    // Get the form action
    var formAction = e.currentTarget.getAttribute('action');

    // Get the form method
    var formMethod = e.currentTarget.getAttribute('method');

    // Make post request
    var post = await fetch(formAction, {
        method: formMethod,
        body: formData,
        accept: "application/json",
        headers: {
            'X-CSRF-TOKEN': csrf,
            '_token': csrf,
        }
    });

    // Get the response
    var response = await post.json();

    // Check if the response was successful
    if(post.status == 200) {
        var link_image = document.getElementById('link_image');
        var link_name = document.getElementById('link_name');
        var link_url = document.getElementById('link_url');

        // Empty the form
        link_image.value = "";
        link_name.value = "";
        link_url.value = "";

        // Append the new link to the links hold
        var newLink = "<div class='link_main_row' id='link-"+response.link.id+"' data-linkID='"+response.link.id+"'>" +
            "<div class='link_row_preview'>" +
                "<div class='inner_row'>" +
                    "<div class='image' style='background-image: url(data:image;base64,"+response.link.image+");'></div>" +
                    "<div class='link_info'>" +
                        "<h4>"+response.link.name+"</h4>" +
                        "<a href='"+response.link.url+"' target='_blank'>"+response.link.url+"</a>" +
                    "</div>" +
                "</div>" +
            "</div>" +
            "<div class='link_row hide saved_link' draggable='true'>" +
                "<form action='"+base_url+"/me/editProfileForm_Links/update/"+response.link.id+"' method='post' enctype='multipart/form-data'>"+
                    "<div class='inner_row'>"+
                        "<div class='image' style='background-image: url(data:image;base64,"+response.link.image+");'>"+
                            "<input type='file' name='link_image' id='link_image-"+response.link.id+"' class='link_image' data-toggle='tooltip' data-placement='top' title='Link Image'>"+
                        "</div>"+
                        "<div class='link_info'>"+
                            "<input type='text' id='link_name-"+response.link.id+"' name='link_name' placeholder='Link Name' value='"+response.link.name+"'>"+
                            "<div class='bottom_link_info'>" +
                                "<input type='text' id='link_url-"+response.link.id+"' name='link_url' placeholder='Link URL' value='"+response.link.url+"'>" +
                                "<button class='btn btn-update'>Update</button> <a data-linkid='"+response.link.id+"' class='btn delete_link_btn warning' href='"+base_url+"/me/editProfileForm_Links/delete/"+response.link.id+"'><i class='fa-solid fa-x'></i></a>" +
                            "</div>" +
                        "</div>"+
                    "</div>"+
                    "<input type='hidden' name='_token' value='"+csrf+"'>" +
                    "<input type='hidden' name='link_id' value='"+response.link.id+"'>" +
                "</form>"+
            "</div>"+
        "</div>";

        document.getElementById('link_pri_hold').insertAdjacentHTML('beforeend', newLink);

        // Append to the preview hold
        var newPreviewLink = '<li>' +
                                '<a href="">' +
                                    '<div class="image" style="background-image: url(data:image;base64,' + response.link.image + ');"></div>' +
                                    '<div class="link_info">' + 
                                        
                                        '<h5>'+response.link.name+'</h5>' + 
                                        '<p>'+response.link.url+'</p>' +

                                    '</div>' +
                                '</a>' +
                                '</li>';

        document.getElementById('preview_phone_links').insertAdjacentHTML('beforeend', newPreviewLink);

        // Add the event listener to the delete link button
        add_hover_link_effect_function();
        addEventListenerToDeleteLinkBtn();

        Alert("Link was added successfully!", "success", "Success", "top-right", 5000);
    } else {
        Alert("Link was not added successfully!", "danger", "Error", "top-right", 5000);
    }
}

// Add the event listener to the add_new_link_form
document.getElementById('add_new_link_form').addEventListener('submit', AddNewLinkSubmit);

/**
 * Alert
 * -----
 * This will show an alert box on the screen
 * 
 * @param {string} message
 * @param {string} type
 * @param {string} title
 * @param {string} position
 * @param {string} timer
 */
const Alert = (message, type, title, position, timer) => {
    var alert_hold = document.getElementById('alert_hold');
    var alert = document.createElement('div');
    alert.classList.add('alert');
    alert.classList.add('alert-' + type);
    alert.classList.add('alert-dismissible');
    alert.classList.add('fade');
    alert.classList.add('show');
    alert.setAttribute('role', 'alert');
    alert.setAttribute('data-auto-dismiss', timer);

    var alert_title = document.createElement('strong');
    alert_title.innerHTML = title;

    var alert_message = document.createElement('p');
    alert_message.innerHTML = message;

    alert.appendChild(alert_title);
    alert.appendChild(alert_message);

    alert_hold.appendChild(alert);

    setTimeout(() => {
        alert.remove();
    }, timer);
}

/**
 * HoverLinkEffect
 * ---------------
 * This will add a hover effect to the links where link_row will show and hide link_row_preview
 */
const HoverLinkEffect = (e) => {
    e.currentTarget.nextElementSibling.classList.toggle('hide');
    e.currentTarget.classList.toggle('hide');
}

// Add the event listener to the link_row_preview
const add_hover_link_effect_function = (e) => {
    document.querySelectorAll('.link_row_preview').forEach(item => {
        item.addEventListener('click', HoverLinkEffect);
        //item.addEventListener('mouseout', HoverLinkEffect);
    });
}
add_hover_link_effect_function();

/**
 * DeleteLink
 * ----------
 * This will delete the link
 */
const DeleteLink = async (e) => {
    e.preventDefault();

    // Get the link id
    var link_id = e.currentTarget.getAttribute('data-linkid');
    var action = e.currentTarget.getAttribute('href');

    // Make post request
    var post = await fetch(action, {
        method: 'DELETE',
        accept: "application/json",
        body: JSON.stringify({
            link_id: link_id
        }),
        headers: {
            'X-CSRF-TOKEN': csrf,
            '_token': csrf,
            '_method': 'DELETE',
        }
    });

    // Get the response
    var response = await post.json();

    // Check if the response was successful
    if(post.status == 200) {
        $("#link-" + link_id).remove();
        Alert("Link was deleted successfully!", "success", "Success", "top-right", 5000);
    } else {
        Alert("Link was not deleted successfully!", "danger", "Error", "top-right", 5000);
    }
}

// Add the event listener to the delete_link_btn
const addEventListenerToDeleteLinkBtn = (e) => {
    document.querySelectorAll('.delete_link_btn').forEach(item => {
        item.addEventListener('click', DeleteLink);
    });
}
addEventListenerToDeleteLinkBtn();

/**
 * EditLinkPreviewPhoto
 * --------------------
 * This will edit the link preview photo
 */
const AddNewLinkPhotoPreview = (e) => {
    var file = e.currentTarget.files[0];
    var reader = new FileReader();

    reader.addEventListener('load', function () {
        document.getElementById('new_link_image').setAttribute('style', 'background-image: url(' + this.result + ');');
    });

    if(file) {
        reader.readAsDataURL(file);
    }
}

// Add the event listener to the profile_picture input
document.getElementById('link_image').addEventListener('change', AddNewLinkPhotoPreview);
