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