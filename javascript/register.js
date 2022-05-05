$("#registration-submit").click(function (e) { 
    let inputFirstname = $('#firstname').val();
    let inputLastname = $('#lastname').val();
    let inputEmail = $('#email').val();
    let inputBirthdate = $('#birthdate').val();
    let inputPassword = $('#password').val();
    let inputConfirmPassword = $('#c_password').val();
    console.log("CLICKED")
    let form_data = $('#registration-form').serialize();
    $.ajax({
        type: "POST",
        url: "../php-scripts/register-scripts.php",
        //data: form_data,
        data: {
             firstname: inputFirstname,
             lastname: inputLastname,
             email: inputEmail,
             birthdate: inputBirthdate,
             password: inputPassword
        },
        dataType: "json",
        success: function (response) {
            var result = JSON.parse(JSON.stringify(response));
            console.log(response);
            if(result.statusCode == 200){
                $("#status").show();
                $('#status').html('Registration successful !');
                location.href = 'login.html'; 						
            }
            else if(result.statusCode == 201){
                $("#status").show();
                $('#status').html('User already exists!');
            }
        }
    });
});