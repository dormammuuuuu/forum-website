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


$(document).on('click','.thread',function (e) { 
    e.preventDefault();
    let tid = $(this).attr('data-thread');
    location.href = "thread.php?threadid=" + tid;
});

    //load more button
$(document).on("click", "#load-more", (function () { 
    let loadmore_btn = $('#load-more');
    if (loadmore_btn.length > 0){
        loadmore_btn.remove();
    }
    let count = $('.threads-container').children().length;
    console.log(count);
    $.ajax({
        type: "post",
        url: "../php-scripts/home-scripts.php",
        data: {
            loadmore: count
        },
        dataType: "html",
        success: function (response) {
            $('.threads-container').append(response);
            $('.threads-container').append('<button id="load-more">Load More</button>');
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
}));

$(document).on("click", ".thread-save", (function (e) {
    e.stopPropagation();
    let thread_id = $(this).data('threadid');

    $.ajax({
        type: "post",
        url: "../php-scripts/home-scripts.php",
        data: {
            savethread: thread_id
        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            if (response.statusCode == 200){
                $('[data-threadid=' + thread_id + ']').addClass('saved');
                $('[data-threadid=' + thread_id + ']').children('i').removeClass('bx-star').addClass('bxs-star');
            } else {
                $('[data-threadid=' + thread_id + ']').removeClass('saved');
                $('[data-threadid=' + thread_id + ']').children('i').removeClass('bxs-star').addClass('bx-star');
            }
        }
    });
}));
