<?php
    include('php-scripts/db.php');
    include('php-scripts/forgot-scripts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/forgot.css">
    <link rel="stylesheet" href="styles/loader.css">
    <script src="javascript/jquery-3.6.0.js"></script>
</head>
<body>
    <section class="card-container">
        <div class="card-left">
            <img class="forgot-img" src="assets/images/forgot.png" alt="">
        </div>
        <div class="loader-container">
            <div id="loader"></div>
        </div>
        <div class="success">
            <div class="check-container">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 98.5 98.5" enable-background="new 0 0 98.5 98.5" xml:space="preserve">
                    <path class="checkmark" fill="none" stroke-width="8" stroke-miterlimit="10" d="M81.7,17.8C73.5,9.3,62,4,49.2,4C24.3,4,4,24.3,4,49.2s20.3,45.2,45.2,45.2s45.2-20.3,45.2-45.2c0-8.6-2.4-16.6-6.5-23.4l0,0L45.6,68.2L24.7,47.3"/>
                </svg>
            </div>
            <h1>Email Sent!</h1>
            <p>An email with a verification code </br> has been sent to you</p>
        </div>
        <div class="card-right">
            <?php if(!isset($_GET['token'])){ ?>
                    <h1>Forgot your password?</h1>
                    <p class="subheading">A verification code will be sent to your email.</p>
                    <form id="forgot-form" method="POST">
                        <div>
                            <div class="field">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                        </div>
                        <p id="status"></p>
                        <input id="forgot-submit" name="submit" type="submit" value="Reset Password">
                    </form>
                    <p class="login"><a href="login.html">Back to log in</a></p>
            <?php } else { ?>
                    <h1>Password</h1>
                    <p class="subheading">Enter your new password</p>
                    <form id="password-form" method="POST">
                        <div>
                            <div class="field">
                                <input type="text" id="token" value="<?php echo $_GET['token']?>" hidden>

                                <label for="email">New password</label>
                                <input type="password" name="password" id="password" required>
                                
                                <label for="email">Confirm password</label>
                                <input type="password" name="cpassword" id="cpassword" required>
                            </div>
                        </div>
                        <p id="status"></p>
                        <input id="password-submit" name="password-submit" type="submit" value="Reset Password">
                    </form>
            <?php } ?>
            
        </div>
    </section>
    <script src="javascript/forgot.js"></script>
</body>
</html>