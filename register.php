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
    <script src="javascript/jquery-3.6.0.js"></script>
</head>
<body>
    <section class="card-container">
        <div class="card-left">
            <img class="register-img" src="assets/images/signup.png" alt="">
        </div>
        <div class="card-right">
            <h1>Register</h1>
            <p class="subheading">By continuing, you are setting up `NAME` account.</p>
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
                <section class="terms-container">
                    <input type="checkbox" name="agree-terms" id="agree-terms" required>
                    <label for="agree-terms" class="terms-label">I agree to our <a href="#">User Agreement</a> and <a href="#">Privacy Policy</a></label>                
                </section>
                <input value="Create Account" id="registration-submit" name="registration-submit" type="button">
            </form>
            <p class="login">Already have an account? <a href="login.html">Log in</a></p>
        </div>
    </section>
    <script src="javascript/register.js"></script>
</body>
</html>