$('#login-form').submit(function (e) { 
    e.preventDefault();
    $('#status').empty();
    $('.restricted-container').empty();
    $('.restricted-container').hide();
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
            console.log(response);
            if(response.statusCode == 200){
                location.href = 'home.php';
            }
            else if(response.statusCode == 201){
                $('#status').html('Account doesn\'t exist');
            } else if (response.statusCode == 202){
                //create a javascript array with strings
                let restrictions = ["Posting Spam", "Using inappropriate words","Using plagiarized work","It's harmful/abusive","Spreading false information","Sexual Violence/Nudity"];
                let layout = `<p>Account Restricted</p>
                              <p class="reason"> Reason: ` + restrictions[response.reason - 1] + `</p>
                              <p>Please contact the administrator for more information.</p>`;
                $('.restricted-container').append(layout);
                $('.restricted-container').show();
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});