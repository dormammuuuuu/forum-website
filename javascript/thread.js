$('#comment-form').submit(function (e) { 
    e.preventDefault();
    let inputComment = $('#user-comment').val();
    let threadID = $('#thread-id').val();
/*
    $('.comments').load("../php-scripts/thread-scripts.php", {
        comment: inputComment,
        threadID: threadID
    }, function (response, status, request) {
        //let result = JSON.parse(JSON.stringify(response));
        $('.comments').html(response)
        console.log("status: " + status);
        console.log(result);
        if(result.statusCode == 200){
            $('#user-comment').val("");
            $('.comments').load("../php-scripts/thread-scripts.php", { commentLoad: true, threadID: threadID });
        } else if (result.statusCode == 201){
            console.log("FAILED");
        }
    });
    */

    $.ajax({
        type: "post",
        url: "../php-scripts/thread-scripts.php",
        //contentType: 'application/json; charset=utf-8',
        dataType: "html",
        data: {
            comment: inputComment,
            threadID: threadID
        },
        success: function (response) {
            $('#user-comment').val("");
            //let result = JSON.parse(JSON.stringify(response));
            console.log(response);
            $('#comments').append(response);
            /*if(result.statusCode == 200){
                $('#user-comment').val("");
            } else if (result.statusCode == 201){
                console.log("FAILED");
            }*/
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