// const burger = document.querySelector(".burger");
// const navBtn = document.querySelector(".nav-buttons ul");

// burger.addEventListener("click", () =>{

//     burger.classList.toggle(".actived");
//     navBtn.classList.toggle(".actived");

// })


$(function () {
    $('.nav-links a[href^="' + location.pathname.split("/")[1] + '"]').parent().addClass('active');
});

$(document).on("click", ".burger", function () { 
      $('.nav-buttons').toggle(function () {
          $(".nav-buttons").css("right", "100vh");
          $('.burger').children().each(function(index) {
            if (index === 0) {
                $(this).css('opacity', 0);
            }
            console.log(index);
        });
      }, function () {
          $(".nav-buttons").css("right", 0);
      });
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