$(function () {
    $.ajax({
        type: "post",
        url: "../php-scripts/session.php",
        data: {
            session: 1
        },
        dataType: "json",
        success: function (response) {
            if(response.status == "Session Available"){
                $('head').append('<script src="../javascript/session.js"></script>');
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});


$('.create-thread').click(function () { 
    window.location.href = "create.php";
});


$('.thread').click(function (e) { 
    e.preventDefault();
    let tid = $(this).attr('data-thread');
    location.href = "thread.php?threadid=" + tid;
});
