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

$('#pending-button').click(function () { 
    $.ajax({
        type: "post",
        url: "../php-scripts/superuser-scripts.php",
        data: {
            pending: 1
        },
        dataType: "json",
        success: function (response) {
            for (let index = 0; index < response.length; index++) {
                const edjsParser = edjsHTML();
                console.log(JSON.parse(response[index].body));
                let body_data = edjsParser.parse(JSON.parse(response[index].body));
                console.log(body_data);
                let final_body = body_data.join(" ");
                console.log(final_body);
                let datetime = jQuery.timeago(response[index].date + ' ' + response[index].time);
                let layout = '<div class="pending-content">' +
                                '<div class="pending-thread-title">' +
                                    '<h1>' + response[index].title + '</h1>' +
                                '</div>' +
                                '<div class="pending-author">' +
                                    '<img class="pending-thread-avatar" src="' + response[index].avatar + '" alt="">' +
                                    '<div class="pending-details">' +
                                        '<div class="pending-user">' +
                                            '<p class="pending-name">' + response[index].firstname + ' ' + response[index].lastname + '</p>' +
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
                                    '<button class="pending-btns" type="submit">VIEW</button>' +
                                    '<button class="pending-btns" type="submit">APPROVE</button>' +
                                    '<button class="pending-btns" type="submit">CANCEL</button>' +
                                '</div>' +
                            '</div> '
                $('.pending-threads').append(layout);              
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});