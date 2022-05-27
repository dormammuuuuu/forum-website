$(function () {
    setInterval(() => {
        $.ajax({
            type: "post",
            url: "../php-scripts/superuser-scripts.php",
            dataType: "json",
            data: {
                continuous: 0
            },
            success: function (response) {
                $('#user-number').html(response.user);
                $('#thread-number').html(response.thread);
                $('#pending-number').html(response.pending);
                $('#closed-number').html(response.closed);
            },
            error: function (request, status, error) {
                location.href = "../expired.php";
            }
        });
    }, 1000);
    $('#student-button').click();
});

function renderThreads(json_response, index, filter) {
    const edjsParser = edjsHTML();
    let body_data = edjsParser.parse(JSON.parse(json_response[index].body));
    let final_body = body_data.join(" ");
    let datetime = jQuery.timeago(json_response[index].date + ' ' + json_response[index].time);
    let layout = '<div class="pending-content" data-mainthread="' + json_response[index].thread_id + '" >' +
                '<div class="pending-thread-title">' +
                    '<h1>' + json_response[index].title + '</h1>' +
                '</div>' +
                '<div class="pending-author">' +
                    '<img class="pending-thread-avatar" src="' + json_response[index].avatar + '" alt="">' +
                    '<div class="pending-details">' +
                        '<div class="pending-user">' +
                            '<p class="pending-name">' + json_response[index].firstname + ' ' + json_response[index].lastname + '</p>' +
                            '<p class="pending-user-type">Student</p>' +
                        '</div>' +
                        '<p class="pending-date-published">' + datetime + '</p>' +
                    '</div>' +
                '</div>' +
                '<div class="pending-content-text">' +
                    '<div class="pending-main-threads">' + final_body +
                    '</div>' +
                '</div>' +
                '<div class="pending-btn" data-thread="'+ json_response[index].thread_id +'" >';

                if (filter == 0){
                    layout += '<button class="pending-btns approve">APPROVE</button>' +
                              '<button class="pending-btns">DECLINE</button>';
                } else {
                    layout += '<button class="pending-btns">EDIT TAGS</button>' +
                              '<button class="pending-btns viewthread-btn">VIEW THREAD</button>' +
                              '<button class="pending-btns">CLOSE THREAD</button>' +
                              '<button class="pending-btns">MARK AS DUPLICATE THREAD</button>';
                }
                layout += '</div>' +
                        '</div> ';
    return layout;
}

function renderAccount(json_response, index, type){
    let restrictionClass = (json_response[index].restricted == 1) ? "restricted" : "";
    let restrictionLabel = (json_response[index].restricted == 1) ? "Remove account restriction" : "Restrict Account";
    let accountType = (json_response[index].account_type == "student") ? "<option value='student' selected>Student</option><option value='teacher'>Teacher</option>'" : "<option value='student'>Student</option><option value='teacher' selected>Teacher</option>'";

    let layout = '<div class="user-container">' +
                    '<div class="user-details">' + 
                        '<img class="user-icon" src="' + json_response[index].avatar + '" alt="">' +
                        '<div class="user-info">' +
                            '<p class="user-name">' + json_response[index].lastname + ", " + json_response[index].firstname + '</p>' +
                            '<p class="user-thread-post">Threads: ' + json_response[index].threads +', Comments: ' + json_response[index].comments +'</p>' +
                        '</div>' +
                    '</div>' +
                    '<div class="user-btn" data-user="' + json_response[index].uid + '">' +
                        '<button class="view-btn">View Profile</button>' +
                        '<button class="restrict-btn ' + restrictionClass +'" data-restriction="' + json_response[index].restricted + '">' + restrictionLabel + '</button>' +
                        '<select name="select-user-type" class="user-type">' + accountType + '</select>' +
                    '</div>' +
                '</div>';
    return layout;
}

function restriction(userID, reason){

    let restrictReason = (reason == 0) ?  $('.restrict-select').val() : 0;
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            restrict: userID,
            reason: restrictReason
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            if (reason == 0){
                $('[data-user=' + userID +'] > .restrict-btn').addClass("restricted").text("Remove Account Restriction");
            } else {
                $('[data-user=' + userID +'] > .restrict-btn').removeClass("restricted").text("Restrict Account");
            }
            reason = reason == 0 ? 1 : 0;
            $('[data-user=' + userID +'] > .restrict-btn').attr("data-restriction", reason);
            $('#restrict-modal').hide();
            $('#restrict-modal').remove();
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
}

$('#pending-button').click(function () { 
    let loadbutton = $('#load-more-button');
    $('.pending-threads').empty();
    $('.pending-title').text('Pending Threads');
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            pending: 1
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            for (let index = 0; index < response.length; index++) {
                let layout = renderThreads(response, index, 0);
                $('.pending-threads').append(layout);    
            }
            if (loadbutton.length == 0){
                $('.pending-container').append('<button data-num="0" id="load-more-button">Load more</button>');
            } else {
                $('#load-more-button').attr('data-num', 0);
            }
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$('#all-button').click(function () { 
    let loadbutton = $('#load-more-button');
    $('.pending-threads').empty();
    $('.pending-title').text('All Approved Threads');
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            all: 1
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            for (let index = 0; index < response.length; index++) {
                let layout = renderThreads(response, index, 1);
                $('.pending-threads').append(layout);    
            }
            if (loadbutton.length == 0){
                $('.pending-container').append('<button data-num="1" id="load-more-button">Load more</button>');
            } else {
                $('#load-more-button').attr('data-num', 1);
            }
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$(document).on('click', '#load-more-button', function () { 
    let count = $(".pending-threads").children().length;
    let type = $('#load-more-button').attr('data-num');
    console.log(count);
    let layout;
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            loadmore: count,
            type: type
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            console.log(response);
            if(response.length == 0){
                $('#load-more-button').remove();
            }
            for (let index = 0; index < response.length; index++) {
                if (type == 2 || type == 3){
                    layout = renderAccount(response, index, 0);
                } else {
                    layout = renderThreads(response, index, type);
                }
                $('.pending-threads').append(layout);    
            }
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$(document).on("click", ".approve", function () { 
    let approve = $(this).parent().attr('data-thread');

    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            approve: approve
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            console.log(response);
            $('[data-mainthread=' + approve + "]").fadeOut();
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$('#student-button').click(function () {
    let loadbutton = $('#load-more-button');
    $('.pending-threads').empty();
    $('.pending-title').text('List of Students');
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            account: 1
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            console.log(response);
            for (let index = 0; index < response.length; index++) {
                let layout = renderAccount(response, index, 0);
                $('.pending-threads').append(layout);    
            }
            if (loadbutton.length == 0){
                $('.pending-container').append('<button data-num="2" id="load-more-button">Load more</button>');
            } else {
                $('#load-more-button').attr('data-num', 2);
            }
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$('#teacher-button').click(function () {
    let loadbutton = $('#load-more-button');
    $('.pending-threads').empty();
    $('.pending-title').text('List of Teachers');
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            account: 2
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            console.log(response);
            for (let index = 0; index < response.length; index++) {
                let layout = renderAccount(response, index, 0);
                $('.pending-threads').append(layout);    
            }
            if (loadbutton.length == 0){
                $('.pending-container').append('<button data-num="3" id="load-more-button">Load more</button>');
            } else {
                $('#load-more-button').attr('data-num', 3);
            }
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$(document).on("click", ".view-btn", function () { 
    window.open('http://localhost/profile.php', '_blank');
});

$(document).on("click", ".restrict-btn", function () { 
    let accountID = $(this).parent().attr('data-user');
    let restrictType = $(this).attr('data-restriction');
    //create a modal with select box

    if (restrictType == '0'){
    let layout = `<div id="restrict-modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Restrict Account</h2>
                        </div>
                        <div class="modal-body">
                            <div class="restrict-container">
                                <div class="restrict-title">Select a reason to restrict</div>
                                <select class="restrict-select">
                                    <option value="1" selected>Account has been flagged</option>
                                    <option value="2">Account has been flagged by another user</option>
                                    <option value="3">Account has been flagged by admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-user="` + accountID + `" data-restriction= "` + restrictType + `" class="restrict-button">Restrict</button>
                        </div>
                    </div>
                </div>`;
    $('body').append(layout);
    $('.restrict-button').attr('data-user', accountID);
    $('#restrict-modal').show();

    $('.close').click(function () { 
        $('#restrict-modal').hide();
        $('#restrict-modal').remove();
    });
    } else {
        restriction(accountID, restrictType);
    }
});

$(document).on("click", ".restrict-button", function () { 
    let accountID = $(this).attr('data-user');
    let restrictType = $(this).attr('data-restriction');
    restriction(accountID, restrictType);
});

$(document).on("change", ".user-type", function () {
    let accountID = $(this).parent().attr('data-user');
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            usertype: accountID
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            console.log(response);
            $('[data-user=' + accountID +']').empty().append("<p class='moved-notice'>Account moved to Teacher's tab</p>");
        },
        complete:function(data){
            $(".loader-superuser").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

//onclick view thread
$(document).on("click", ".viewthread-btn", function () { 
    let threadID = $(this).parent().attr('data-thread');
    window.open('http://localhost/thread.php?threadid=' + threadID, '_blank');
});