$(function () {
    $(".guide-expanded").hide();
    var globalGuide = 1;
    $('.guide')[0].click(); 
});

var globalGuide = 0;

$('.guide').click(function () {
    
    let current = $(this).attr("data-number");
    if(current != globalGuide){
        $(".guide-expanded").slideUp();
        $(this).children(".guide-expanded").slideDown();
        globalGuide = current;
    } else {
        $(this).children(".guide-expanded").slideUp();
        globalGuide = current;
        if ($(this).children(".guide-expanded").css("display") == "none"){
            $(this).children(".guide-expanded").slideDown();
        }
    }
});

