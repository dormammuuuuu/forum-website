$('#comment-form').submit(function (e) { 
    e.preventDefault();
    let inputComment = $('#user-comment').val();
    let threadID = $('#thread-id').val();

    $.ajax({
        type: "post",
        url: "../php-scripts/thread-scripts.php",
        dataType: "html",
        data: {
            comment: inputComment,
            threadID: threadID
        },
        success: function (response) {
            $('#user-comment').val("");
            console.log(response);
            if ($('#comments').children('div.no-comment').length > 0){
                $('#comments').empty();
            }
            $('#comments').append(response);
        },
        error: function(jqXHR, exception) {
            let msg = '';
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
            console.log(msg);
        }
    });
});



$(function () {
    if ($('#comments').children().length == 0 ) {
        $('#comments').html('<div class="no-comment">Be the first to answer the question.</div>');
    }
});

$('.vote-button').click(function () { 
    let commentID = $(this).parent().attr('data-comment');
    let vote = $(this).attr('data-vote');

    $.ajax({
        type: "post",
        url: "../php-scripts/thread-scripts.php",
        data: {
            commentID: commentID,
            vote: vote
        },
        dataType: "JSON",
        success: function (response) {
            let result = JSON.parse(JSON.stringify(response));
            console.log(result);
            if (result.message == "upvote"){
                $('[data-icon=d' + commentID + ']').removeClass("bxs-dislike");
                $('[data-icon=d' + commentID + ']').addClass("bx-dislike");
                $('[data-icon=u' + commentID + ']').removeClass("bx-like");
                $('[data-icon=u' + commentID + ']').addClass("bxs-like");
            } else if (result.message == "downvote") {
                $('[data-icon=u' + commentID + ']').removeClass("bxs-like");
                $('[data-icon=u' + commentID + ']').addClass("bx-like");
                $('[data-icon=d' + commentID + ']').removeClass("bx-dislike");
                $('[data-icon=d' + commentID + ']').addClass("bxs-dislike");
            } else {
                $('[data-icon=u' + commentID + ']').removeClass("bxs-like");
                $('[data-icon=u' + commentID + ']').addClass("bx-like");
                $('[data-icon=d' + commentID + ']').removeClass("bxs-dislike");
                $('[data-icon=d' + commentID + ']').addClass("bx-dislike");
            }
            $('[data-icon=u' + commentID + ']').next('.comment-upvote').html(result.upvotes);
            $('[data-icon=d' + commentID + ']').next('.comment-downvote').html(result.downvotes);
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});