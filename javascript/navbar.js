$(function () {
    $('.nav-links a[href^="' + location.pathname.split("/")[1] + '"]').parent().addClass('active');
    const burger = document.querySelector(".burger"); 
    const navBtn = document.querySelector(".nav-buttons");
    burger.addEventListener("click", () =>{
        burger.classList.toggle("actived");     
        navBtn.classList.toggle("actived");
   
   })
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