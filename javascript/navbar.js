const notification_empty = `
<div class="no-notification">
    <p>You have no notifications.</p>
</div>

`;

$(function () {
    $('.nav-links a[href^="' + location.pathname.split("/")[1] + '"]').parent().addClass('active');
    const burger = document.querySelector(".burger"); 
    const navBtn = document.querySelector(".nav-buttons");
    burger.addEventListener("click", () =>{
        burger.classList.toggle("actived");     
        navBtn.classList.toggle("actived");
   
   });
   let notif_message = 0;
   let notification_tmp;

   //Fetch database for notification message
   setInterval(() => {
        $.ajax({
            url: "../php-scripts/notification-scripts.php",
            type: "POST",
            data: {
                loadnotifications: 1
            },
            datatype: "json",
            success: function(response) {
                let data = JSON.parse(response);
                console.log(data);
                let notification_message = data[0].message;
                let notif_indicator = data[0].notification;
                data.shift();
                if (notif_message === notification_message && JSON.stringify(data) === JSON.stringify(notification_tmp)) {
                    return;
                }
                
                if (notification_message > 0) {
                    $('.notification-message').css('display', 'flex').text(notification_message);
                } else {
                    $('.notification-message').css('display', 'none');
                }

                if (notif_indicator > 0) {
                    $('.notification-indicator').css('display', 'block');
                } else {
                    $('.notification-indicator').css('display', 'none');
                }

                $('.notification-list').empty();

                if (data.length == 0){
                    $('.notification-list').append(notification_empty);  
                } else {
                    renderNotification(data);
                }

                notif_message = notification_message;
                notification_tmp = data;
                console.log(notification_tmp);
                console.log(notif_message);
            },
            error: function(data) {
                console.log(data);
            }
        });
    },500);
   
});


$(document).on("click", ".user-avatar", function () { 
    $('.notification-dropdown').hide();
    $('.dropdown-content').toggle(function () {
        $(".dropdown-content").addClass("active");
    }, function () {
        $(".dropdown-content").removeClass("active");
    });
});

$(document).on("click", ".notification", function () {
    $('.dropdown-content').hide();
    $('.notification-dropdown').toggle(function () {
        $(".notification-dropdown").addClass("active");
    }, function () {
        $(".notification-dropdown").removeClass("active");
    });
});

$(document).on("keyup", '.nav-search', function (e) { 
    if (e.key === 'Enter') {
        location.href = "/search.php?search=" + $(this).val();
    }
});

$(document).on("click", "#read-all", function (e) {
    e.stopPropagation();
    $.ajax({
        url: "../php-scripts/notification-scripts.php",
        type: "POST",
        data: {
            readall: 1
        },
        datatype: "json",
        success: function(response) {
            console.log(response);
        }, error: function(data) {
            console.log(data);
        }
    });
});

$(document).on("click", ".list-container", function(e){
    e.stopPropagation();
    let thread_id = $(this).attr("data-thread");
    let notif_id = $(this).attr("data-id");

    if($(this).hasClass('not-seen')){
        $.ajax({
            url: "../php-scripts/notification-scripts.php",
            type: "POST",
            data: {
                notif_id: notif_id
            },
            datatype: "json",
            success: function(response) {
                console.log(response);
                window.open("/thread.php?threadid=" + thread_id, "_blank");
            },
            error: function(data) {
                console.log(data);
            }
        });
    } else {
        window.open("/thread.php?threadid=" + thread_id, "_blank");
    }

});

function renderNotification(data) {
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        let timestamp = jQuery.timeago(data[i].timestamp);
        let notification_response;
        let seen = (data[i].seen == 0) ? "not-seen" : "";
        if (data[i].type === "approve") {
            notification_response = `
            <div class="list-container ${seen}" data-id="${data[i].notif_id}" data-thread="${data[i].thread_id}">
                <div>
                    <img class="list-avatar" src="${data[i].avatar}" alt="">
                </div>
                <div class="list-description">
                    <p class="list-main">Your thread <strong><em>${data[i].thread_title}</em></strong> has been <strong>approved</strong>.</p>
                    <p class="list-time">${timestamp}</p>
                </div>
            </div>
            `;
        } else if (data[i].type === "declined"){
            notification_response = `
            <div class="list-container ${seen}" data-id="${data[i].notif_id}" data-thread="${data[i].thread_id}">
                <div>
                    <img class="list-avatar" src="${data[i].avatar}" alt="">
                </div>
                <div class="list-description">
                    <p class="list-main">Your thread <strong><em>${data[i].thread_title}</em></strong> has been <strong>declined</strong>. See why.</p>
                    <p class="list-time">${timestamp}</p>
                </div>
            </div>
            `;
        } else {
            notification_response = `
            <div class="list-container ${seen}" data-id="${data[i].notif_id}" data-thread="${data[i].thread_id}">
                <div>
                    <img class="list-avatar" src="${data[i].avatar}" alt="">
                </div>
                <div class="list-description">
                    <p class="list-main">${data[i].fullname} responded to your thread <strong><em>${data[i].thread_title}</strong></em></p>
                    <p class="list-time">${timestamp}</p>
                </div>
            </div>
            `;
        }
        
    $('.notification-list').append(notification_response);
    }
}

