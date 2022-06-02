
$(document).on("click", ".user-avatar", function () { 
    $('.dropdown-content').toggle(function () {
        $(".dropdown-content").addClass("active");
    }, function () {
        $(".dropdown-content").removeClass("active");
    });
});