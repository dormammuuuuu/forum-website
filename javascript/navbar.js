
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