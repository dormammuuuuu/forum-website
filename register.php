<?php
    include('php-scripts/db.php');
    include('php-scripts/register-scripts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/loader.css">
    <script src="javascript/jquery-3.6.0.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <section class="card-container">
        <div class="card-left">
            <img class="register-img" src="assets/images/signup.png" alt="">
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
            <h1>Account Registered!</h1>
            <p>You will be redirected to the login page.</p>
        </div>
        <div class="verification">
            <h1>Verify your email</h1>
            <p>An email with a verification code has been sent to you</p>
            <form id="verification-form" method="POST">
                <label for="verification-input">Enter code</label>
                <input name="verification-input" id="verification-input" type="text" required>
                <p id="verification-status"></p>
                <input type="submit" id="verification-submit" value="Continue">
            </form>
        </div>
        <div class="card-right">
            <h1>Create your account</h1>
            <section class="terms-container">
                    <p class="terms-label">By continuing, you agree to our Terms of Service and Privacy Policy</p>
                </section>
            <p id="status"></p>
            <form id="registration-form" method="POST">
                <div>
                    <div class="field">
                        <label for="first_name">First Name</label>
                        <input type="text" id="firstname" name="first_name" required>
                    </div>
                    <div class="field">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="lastname" name="last_name" required>
                    </div>
                </div>
                <div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="field">    
                        <label for="birthdate">Birthdate</label>
                        <input type="date" id="birthdate" name="birthdate" required>
                    </div>
                </div>
                <div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="field">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="c_password" name="confirm_password" required>
                    </div>
                </div>
                <input value="Create Account" type="submit" id="registration-submit" name="registration-submit">
            </form>
            <div class="divider">
                <hr> <span>or</span> <hr>
            </div>
            <button onclick="location.href = '<?php $auth = $google_client->createAuthUrl(); echo $auth;?>'" id="google-signup" name="google-signup"><i class='icon bx bxl-google'></i>Sign up with google</button>
            <p class="google-error">Account already exist.</p>
            <p class="login">Already have an account? <a href="login.html">Log in</a></p>
        </div>
    </section>
    <script src="javascript/register.js"></script>
</body>
</html>