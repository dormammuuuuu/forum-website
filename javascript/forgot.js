$("#forgot-form").submit(function (e) {
    e.preventDefault();
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