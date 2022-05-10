$('#login-form').submit(function (e) { 
    e.preventDefault();
    $('#status').empty();
    let inputEmail = $('#email').val();
    let inputPassword = $('#password').val();
    $.ajax({
        type: "post",
        url: "../php-scripts/login-scripts.php",
        data: {
            email: inputEmail,
            password: inputPassword
        },
        dataType: "json",
        success: function (response) {
            let result = JSON.parse(JSON.stringify(response));
            if(result.statusCode == 200){
                location.href = 'home.php';
            }
            else if(result.statusCode == 201){
                $("#status").show();
                $('#status').html('POTANGINA NIYO UNITHIEVES');
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
        }
    });
});