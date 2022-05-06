$("#registration-form").submit(function (e) {
    e.preventDefault();
    $('#status').empty();
    let inputEmail = $('#email').val();
    $.ajax({
        type: "POST",
        url: "../php-scripts/register-scripts.php",
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
                $(".verification").show();
            }
            else if(result.statusCode == 201){
                $("#status").show();
                $('#status').html('User already exists!');
            }
        },
        complete:function(data){
            $(".loader-container").fadeOut();                
        }
    });
});


$("#verification-form").submit(function (e) {
    e.preventDefault();
    $('#verify-submit').attr('disabled','disabled');
    $('#verification-status').empty();
    let inputCode = $('#verification-input').val();
    let inputFirstname = $('#firstname').val();
    let inputLastname = $('#lastname').val();
    let inputEmail = $('#email').val();
    let inputBirthdate = $('#birthdate').val();
    let inputPassword = $('#password').val();
    $.ajax({
        type: "POST",
        url: "../php-scripts/register-scripts.php",
        data: {
            code: inputCode,
            firstname: inputFirstname,
            lastname: inputLastname,
            verified_email: inputEmail,
            birthdate: inputBirthdate,
            password: inputPassword
        },
        dataType: "json",
        beforeSend: function(){
            $(".loader-container").show();
        },
        success: function (response) {
            let result = JSON.parse(JSON.stringify(response));
            if(result.statusCode == 200){
                $('.success').css('display', 'flex');
                setTimeout(() => {
                    location.href = "login.html";                    
                }, 3500);
            }
            else if(result.statusCode == 201){
                $("#verification-status").show();
                $('#verification-status').html('Incorrect code. Please try again!');
                $('#verify-submit').removeAttr('disabled');
            }
        },
        complete:function(response){
            $(".loader-container").fadeOut();                
        }
    });
});