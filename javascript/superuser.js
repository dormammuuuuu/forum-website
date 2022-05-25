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
            }
        });
    }, 30000);
});

function renderPendingThreads(json_response, index) {
    const edjsParser = edjsHTML();
    let body_data = edjsParser.parse(JSON.parse(json_response[index].body));
    let final_body = body_data.join(" ");
    let datetime = jQuery.timeago(json_response[index].date + ' ' + json_response[index].time);
    let layout = '<div class="pending-content">' +
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
                '<div class="pending-btn">' +
                    '<button class="pending-btns" type="submit">APPROVE</button>' +
                    '<button class="pending-btns" type="submit">CANCEL</button>' +
                '</div>' +
            '</div> ';
    return layout;
}

$('#pending-button').click(function () { 
    let loadbutton = $('#load-more-button');
    console.log(loadbutton);
    $('.pending-threads').empty();
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
                let layout = renderPendingThreads(response, index);
                $('.pending-threads').append(layout);    
            }
            if (loadbutton.length == 0){
                $('.pending-container').append('<button id="load-more-button">Load more</button>');
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
    var count = $(".pending-threads").children().length;
    console.log(count);
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            loadmore: count
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
        success: function (response) {
            console.log(response);
            for (let index = 0; index < response.length; index++) {
                let layout = renderPendingThreads(response, index);
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