$("#forgot-form").submit(function (e) {
    e.preventDefault();
    $('#status').empty();
    let inputEmail = $('#email').val();
    $.ajax({
        type: "POST",
        url: "../php-scripts/forgot-scripts.php",
        data: {
            email: inputEmail
        },
        dataType: "json",
        beforeSend: function(){ 
            $(".loader-container").show();
        },
        success: function (response) {
            console.log(response);
            let result = JSON.parse(JSON.stringify(response));
            if(result.statusCode == 200){
                $(".success").css('display','flex');
            }
            else if(result.statusCode == 201){
                $("#status").show();
                $('#status').html("Account doesn't exist");
            }
        },
        complete:function(data){
            $(".loader-container").fadeOut();                
        },
        error: function (request, status, error) {
            console.log(request.responseText);
        }
    });
});


$("#password-form").submit(function (e) {
    e.preventDefault();
    $('#status').empty();
    let inputToken = $('#token').val();
    let inputPassword = $('#password').val();
    let inputCPassword = $('#cpassword').val();
    console.log(inputToken + " " + inputPassword + " " + inputCPassword);

    if(inputPassword == inputCPassword){
        $.ajax({
            type: "POST",
            url: "../php-scripts/forgot-scripts.php",
            data: {
                token: inputToken,
                password: inputPassword
            },
            dataType: "json",
            beforeSend: function(){ 
                $(".loader-container").show();
            },
            success: function (response) {
                console.log(response);
                let result = JSON.parse(JSON.stringify(response));
                if(result.statusCode == 200){
                    $(".success").css('display','flex');
                    $(".success h1").html('Password changed!');
                    $(".success p").html('Your password was successfully changed');
                    setTimeout(() => {
                        location.href = "../login.php";
                    }, 3500);     
                } else {
                    $("#status").show();
                    $('#status').html("Something went wrong.");
                }
            },
            complete:function(data){
                $(".loader-container").fadeOut();              
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    } else {
        $("#status").show();
        $('#status').html("Password doesn't match");
    }
});