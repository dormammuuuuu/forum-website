$(function () {
    $('.nav-links a[href^="' + location.pathname.split("/")[1] + '"]').parent().addClass('active');
    const burger = document.querySelector(".burger"); 
    const navBtn = document.querySelector(".nav-buttons");
    burger.addEventListener("click", () =>{
        burger.classList.toggle("actived");     
        navBtn.classList.toggle("actived");
   
   });
   let notif_message = 0;

   //Fetch database for notification
   setInterval(() => {
        $.ajax({
            url: "../php-scripts/notification-scripts.php",
            type: "POST",
            data: {
                loadnavnotif: 1
            },
            datatype: "json",
            success: function(response) {
                console.log(response);
                var data = JSON.parse(response);
                if (notif_message === data.notif){
                    return;
                }
                if (data.notif > 0) {
                    $('.notification-message').css('display', 'flex').text(data.notif);
                } else {
                    $('.notification-message').css('display', 'none');
                }
                notif_message = data.notif;
            },
            error: function(data) {
                console.log(data);
            }
        });
    },500);
   
});


$(document).on("click", ".user-avatar", function () { 
    $('.dropdown-content').toggle(function () {
        $(".dropdown-content").addClass("active");
    }, function () {
        $(".dropdown-content").removeClass("active");
    });
});

$(document).on("keyup", '.nav-search', function (e) { 
    if (e.key === 'Enter') {
        location.href = "/search.php?search=" + $(this).val();
    }
});

