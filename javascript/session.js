$(function () {
    setInterval(() => {
        $.ajax({
            type: "post",
            url: "../php-scripts/session.php",
            data: {
                session: 1
            },
            dataType: "json",
            success: function (response) {
                if(response.status == "Session Destroyed or Expired"){
                    location.reload();
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }, 1000);
});