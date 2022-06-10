let global_user_data;

$(function () {
    $.ajax({
        type: "post",
        url: "../php-scripts/settings-scripts.php",
        data: {
            fetch_data: 1
        },
        dataType: "JSON",
        success: function (response) {
            global_user_data = response;
            $('.acct-image').click();
        },
        error: function (error) {
            console.log(error);
        }
    });
});

$('.nav-btn').on("click", function () {
    let layout;
    let btn_data = $(this).data('btn');
    if (btn_data == 'acct') {
        layout = `  <h1>Account Details</h1>
                    <form id="acct-details-form" method="post">
                        <div class="user-details"> 
                            <div>
                                <div class="input-field">
                                    <label class="input-label" for="fname"> First Name</label>
                                    <input type="text" name="fname" value="${global_user_data.fname}" required>
                                </div>
                                <div class="input-field">
                                    <label class="input-label" for="lname"> Last Name</label>
                                    <input type="text" name="lname" value="${global_user_data.lname}" required>
                                </div>

                                <div class="input-field">
                                    <label class="input-label" for="bdate"> Birthdate</label>
                                    <input type="date" name="bdate" value="${global_user_data.birthdate}" required>
                                </div>
                            </div>
                            <div>
                                <div class="input-field">
                                    <label class="input-label" for="email"> Email</label>
                                    <input type="text" name="email" value="${global_user_data.email}" disabled>
                                </div>
                                <div class="input-field">
                                    <label class="input-label" for="university"> University</label>
                                    <input type="text" name="university" value="Technological University of the Philippines" disabled>
                                </div>
                                <div class="input-field">
                                    <label class="input-label" for="campus"> Campus</label>
                                    <select name="campus" required>
                                        <option value="" disabled selected>Select Campus</option>
                                        <option value="Manila">Manila City</option>
                                        <option value="Taguig">Taguig City</option>
                                        <option value="Cavite">Cavite City</option>
                                        <option value="Visayas">Visayas</option>
                                    </select>
                                </div>
                            </div>            
                        </div>
                        <input class="update-details" type="submit" value="Update Details">
                    </form>`;

    } else if (btn_data == 'security') {
        layout = `  <div class="security">
                        <h1>Security</h1>
                        <p class="response"></p>
                        <form id="password-form">
                            <div class="input-field">
                                <label class="input-label" for="password"> Password</label>
                                <input type="password" name="password" required>
                            </div>
                            <div class="input-field">
                                <label class="input-label" for="npassword"> New Password</label>
                                <input type="password" name="npassword" required>
                            </div>
                            <div class="input-field">
                                <label class="input-label" for="cpassword"> Confirm Password</label>
                                <input type="password" name="cpassword" required>
                            </div>
                            <input class="update-password" type="submit" value="Update Password">
                        </form>
                    </div>
        `;
    } else {
        layout = `
                    <form method="post" id="profile-form" enctype="multipart/form-data">
                        <input type="file" name="avatar" id="profile-pic" accept="image/*" hidden>                         
                        <input type="file" name="cover" id="profile-cover" accept="image/*" hidden>                         
                        <div class="cover-photo">
                            <img src="${global_user_data.cover}" alt="">
                            <div class="cover-photo-buttons">
                                <button type="button" id="change-cover"><i class='bx bx-upload'></i><p>Change</p></button>
                                <button type="button" id="remove-cover"><i class='bx bxs-trash-alt' ></i><p>Remove</p></button>
                            </div>
                        </div>
                        <div class="avatar-container">
                            <img src="${global_user_data.avatar}" alt="">
                            <div class="avatar-buttons">
                                <button type="button" id="change-profile">CHANGE</button>
                            </div>
                        </div>
                        <div class="input-field-bio">
                            <label class="input-label" for="bio">Bio (Optional)</label>
                            <input type="text" name="bio" id="user-bio" value="${global_user_data.bio}">
                        </div>
                        <input class="update-bio-submit" type="button" value="Update Bio">
                    </form>

        `;
    }
    $('.settings-interface').html(layout);
    if(btn_data == 'acct'){
        $('select').val(global_user_data.campus);
        $('.update-details').prop("disabled",true);
    } else if (btn_data == 'image'){
        $('.update-bio-submit').prop("disabled",true);
    } else {
        $('.update-password').prop("disabled",true);
    }
});

$(document).on("input", "#user-bio", function () {
    if($(this).val() != global_user_data.bio){
        $('.update-bio-submit').removeAttr("disabled");
    } else {
        $('.update-bio-submit').prop("disabled",true);
    }
});

$(document).on("click", ".update-bio-submit", function (e) {
    let biofield = $('#user-bio').val();
    $.ajax({
        type: "post",
        url: "../php-scripts/settings-scripts.php",
        data: {
            uid: global_user_data.uid,
            biofield: biofield
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            if (response.statusCode == 200){
                global_user_data.bio = biofield;
                $('.update-bio-submit').prop("disabled",true);
            }
        },
        complete: function(){
            $(".loader-superuser").hide();
        },
        error: function (response) {
            console.log(response);
        }
    });

});

$(document).on("click", "#change-profile", function () {
    $('#profile-pic').click();
});

$(document).on("click", "#change-cover", function () {
    $('#profile-cover').click();
});

//profile form on change
$(document).on("change", "#profile-pic", function (evt) {
    var tgt = evt.target || window.event.srcElement, files = tgt.files;
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            //create a modal to confirm avatar
                let modal = `<div class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-close">&times;</span>
                        <img class="new-avatar-preview" alt="New Avatar">
                        <h2>Confirm</h2>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to change your avatar?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-btn" id="confirm-change-avatar">Yes</button>
                        <button class="modal-btn" id="cancel-change-avatar">No</button>
                    </div>
                </div>
            </div>`;
            $('body').append(modal);
            $('.new-avatar-preview').prop("src", fr.result);
        }
        fr.readAsDataURL(files[0]);
    }    
});

//profile form on change
$(document).on("change", "#profile-cover", function (evt) {
    var tgt = evt.target || window.event.srcElement, files = tgt.files;
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            //create a modal to confirm avatar
                let modal = `<div class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-close">&times;</span>
                        <img class="new-cover-preview" alt="New Cover Photo">
                        <h2>Confirm</h2>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to change your cover photo?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-btn" id="confirm-change-cover">Yes</button>
                        <button class="modal-btn" id="cancel-change-cover">No</button>
                    </div>
                </div>
            </div>`;
            $('body').append(modal);
            $('.new-cover-preview').prop("src", fr.result);
        }
        fr.readAsDataURL(files[0]);
    }    
});

$(document).on("click",".modal-close, #cancel-change-avatar, #cancel-change-cover",function () {
    $('.modal').remove();
});

$(document).on("click", "#confirm-change-avatar", function (e) {
    e.preventDefault();
    let formdata = new FormData();
    let files = $("#profile-pic")[0].files[0];
    formdata.append("profile_pic", files);
    $.ajax({
        url: '../php-scripts/settings-scripts.php',
        type: 'POST',
        data: formdata,
        contentType:false,
        processData:false,
        success:function(response){  
            if(response!=0){
                $('.avatar-container img').attr('src',response);
                $('.modal').remove();
                location.reload();
            }else{
                alert('File not uploaded');
            }
        },
        error:function(error){
            console.log(error);
        }
    });
});

$(document).on("click", "#confirm-change-cover", function (e) {
    e.preventDefault();
    let formdata = new FormData();
    let files = $("#profile-cover")[0].files[0];
    formdata.append("profile_cover", files);
    $.ajax({
        url: '../php-scripts/settings-scripts.php',
        type: 'POST',
        data: formdata,
        contentType:false,
        processData:false,
        success:function(response){  
            if(response!=0){
                $('.cover-photo img').attr('src',response);
                $('.modal').remove();
                location.reload();
            }else{
                alert('File not uploaded');
            }
        },
        error:function(error){
            console.log(error);
        }
    });
});

$(document).on("input", 'input[name="fname"], input[name="lname"], input[name="bdate"], select[name="campus"]', function () {
    if ($('input[name="fname"]').val() != global_user_data.fname || $('input[name="lname"]').val() != global_user_data.lname || $('input[name="bdate"]').val() != global_user_data.birthdate || $('select[name="campus"]').val() != global_user_data.campus) {
        $('.update-details').removeAttr("disabled");
    } else {
        $('.update-details').prop("disabled",true);
    }
});



$(document).on("submit", "#acct-details-form", function (e) {
    e.preventDefault();
    let firstname = $('input[name="fname"]').val();
    let lastname = $('input[name="lname"]').val();
    let birthdate = $('input[name="bdate"]').val();
    let campus = $('select[name="campus"]').val();
    $.ajax({
        type: "post",
        url: "../php-scripts/settings-scripts.php",
        data: {
            acct_details: 1,
            uid: global_user_data.uid,
            firstname: firstname,
            lastname: lastname,
            birthdate: birthdate,
            campus: campus
        },
        dataType: "JSON",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            if (response.statusCode == 200){
                global_user_data.fname = firstname;
                global_user_data.lname = lastname;
                global_user_data.birthdate = birthdate;
                global_user_data.campus = campus;
                $('.update-details').prop("disabled", true);
            } 
        },
        complete: function(){
            $(".loader-superuser").hide();
        },
        error: function (error) {
            console.log(error);
        }
    });
});

$(document).on("input", "input[name='password'], input[name='cpassword'], input[name='npassword']", function () {
    if($('input[name="password"]').val() != "" && $('input[name="cpassword"]').val() != "" && $('input[name="npassword"]').val() != ""){
        $('.update-password').removeAttr("disabled");
    } else {
        $('.update-password').prop("disabled", true);
    }
});

$(document).on("submit", "#password-form", function (e) {
    e.preventDefault();
    $('.response').empty();
    let old_password = $('input[name="password"]').val();
    let new_password = $('input[name="npassword"]').val();
    let confirm_password = $('input[name="cpassword"]').val();
    
    if (new_password != confirm_password) {
        $('.response').text("New password and confirm password do not match");
        return;
    }
    $.ajax({
        type: "post",
        url: "../php-scripts/settings-scripts.php",
        data: {
            uid: global_user_data.uid,
            old_password: old_password,
            new_password: new_password,
            confirm_password: confirm_password
        },
        dataType: "JSON",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            if (response.statusCode == 200){
                $('input[name="password"]').val("");
                $('input[name="npassword"]').val("");
                $('input[name="cpassword"]').val("");
                $('.update-password').prop("disabled", true);
                $('.response').text(response.message);
            } else {
                $('.response').text(response.message);
            }
        },
        complete: function(){
            $(".loader-superuser").hide();
        },
        error: function (error) {
            console.log(error);
        }
    });
});