$(function () {
    if ($('#comments').children().length == 0 ) {
        $('#comments').html('<div class="no-comment">Be the first to answer the question.</div>');
    }
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
            location.reload();
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$(function (){ 
    setInterval(() => {
        let width = $(window).width();
        if(width < 400){
            $(".correct-status").empty().append("<i class='bx bx-check-double'></i>");
        }else
        {
            $(".correct-status").empty().append("Correct");
        }
    }, 500);
   
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
            if (result.message == "upvote"){
                $('[data-icon=d' + commentID + ']').removeClass("bxs-dislike").addClass("bx-dislike");
                $('[data-icon=u' + commentID + ']').removeClass("bx-like").addClass("bxs-like");
            } else if (result.message == "downvote") {
                $('[data-icon=u' + commentID + ']').removeClass("bxs-like").addClass("bx-like");
                $('[data-icon=d' + commentID + ']').removeClass("bx-dislike").addClass("bxs-dislike");
            } else {
                $('[data-icon=u' + commentID + ']').removeClass("bxs-like").addClass("bx-like");
                $('[data-icon=d' + commentID + ']').removeClass("bxs-dislike").addClass("bx-dislike");
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

$('.correct-button').click(function () { 
    let commentID = $(this).parent().attr('data-comment');

    $.ajax({
        type: "post",
        url: "../php-scripts/thread-scripts.php",
        data: {
            correct: commentID
        },
        dataType: "json",
        success: function (response) {
            let result = JSON.parse(JSON.stringify(response));
            if (response.answer){
                $('[data-correct=c' + commentID + ']').addClass('remove').html("<i class='bx bx-x'></i><span>Remove from correct answers</span>");
            } else {
                $('[data-correct=c' + commentID + ']').removeClass('remove').html("<i class='bx bx-check'></i><span>Mark as correct</span>");
            }
        }
    });
});

$('.dropdown-button').click(function () { 
    $('.dropdown-menu').toggle();
});

$('#close-thread').click(function () { 
    let threadID = $(this).parent().attr('data-thread');
    $.ajax({
        type: "post",
        url: "../php-scripts/thread-scripts.php",
        data: {
            close: threadID
        },
        dataType: "json",
        success: function (response) {
            if (response.statusCode == 200){
                location.reload();
            }
        }, 
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$('#delete-thread').click(function () { 
    let threadID = $(this).parent().attr('data-thread');
    $.ajax({
        type: "post",
        url: "../php-scripts/thread-scripts.php",
        data: {
            delete: threadID
        },
        dataType: "json",
        success: function (response) {
            if (response.statusCode == 200){
                location.href = "home.php";
            }
        }, 
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

//edit thread onclick
$('#edit-thread').click(function () { 
    let threadID = $(this).parent().attr('data-thread');
    location.href = "edit.php?id=" + threadID;
});

//save thread onclick
$('#save-thread').click(function () { 
    let threadID = $(this).parent().attr('data-thread');
    $.ajax({
        type: "post",
        url: "../php-scripts/thread-scripts.php",
        data: {
            save: threadID
        },
        dataType: "json",
        success: function (response) {
            if (response.statusCode == 200){
                $("#save-thread p").text("Unsave thread");
            } else {
                $("#save-thread p").text("Save thread");
            }
        }, 
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$(document).on("click", ".name", (function (e) {
    e.stopPropagation();
    let acct = $(this).data('acct');
    window.open('profile.php?view=' + acct, '_blank');
}));


$(document).on('click','.close',function () { 
    $('#report-modal').hide();
    $('#report-modal').remove();
});

$('#user-comment').on("input", function () {
    if ($(this).val().length > 0) {
        $('#submit-comment').removeAttr('disabled');
    } else {
        $('#submit-comment').prop('disabled', true);
    }
});
