$(function () {
    $(".guide-expanded").hide();
    var globalGuide = 1;
    $('.guide')[0].click(); 
    let secondElement = new Choices('#tags', { allowSearch: false });
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

$('#create-form').submit(function (e) { 
    e.preventDefault();
    let inputTitle = $('#title').val();
    let inputBody = $('#body').val();
    let inputTags = JSON.stringify($('#tags').val());
    console.log(inputTags);
    $.ajax({
        type: "post",
        url: "../php-scripts/create-scripts.php",
        data: {
            title: inputTitle,
            body: inputBody,
            tags: inputTags
        },
        dataType: "json",
        success: function (response) {
            
        },
        error: function (request, status, error) {
            console.log(request);
            console.log(status);
            console.log(error);
        }
    });
});
