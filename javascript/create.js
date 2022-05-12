$(function () {
    $(".guide-expanded").hide();
    var globalGuide = 1;
    $('.guide')[0].click(); 
    let secondElement = new Choices('#tags');
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
    $('#error').empty();

    let inputTitle = $('#input-title').val();
    console.log("Title: " + inputTitle);
    let inputBody = $('#input-body').val();
    console.log("Body: " + inputBody);
    let inputTags = $('#tags').val();
    var tags = new Object();
    tags.selected = inputTags;
    var json_tags = JSON.stringify(tags);
    console.log(json_tags);    
    $.ajax({
        type: "post",
        url: "../php-scripts/create-scripts.php",
        data: {
            title: inputTitle,
            body: inputBody,
            tags: json_tags
        },
        
        success: function (response) {
            location.href = "home.php";
        },
        error: function(jqXHR, exception) {
            //Ajax request failed.
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            $('#error').html(msg);
        }
    });
});

