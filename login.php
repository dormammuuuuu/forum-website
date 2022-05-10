<?php

    include('php-scripts/login-scripts.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/login.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="javascript/jquery-3.6.0.js"></script>
</head>
<body>
    <section class="card-container">
        <div class="card-left">
            <h1>Hello Again!</h1>
            <p class="terms-label">By continuing, you agree to our <a href="#">User Agreement</a> and <a href="#">Privacy Policy.</a></p>
            <form id="login-form">
                <div>
                    <div class="field">
                        <p id="status"></p>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <a class="forgot-password" href="forgot.php">Forgot Password?</a>
                    </div>
                    <div class="field">
                        <button id="login-submit" name="submit" type="submit">Login</button>
                    </div>
                </div>
            </form>
            <button id="google-button" onclick="location.href = '<?php $auth = $google_client->createAuthUrl(); echo $auth;?>'" name="google-login"><i class='icon bx bxl-google'></i>Sign in with Google</button>

            <p class="signup">Don't have an account yet? <a href="register.php">Sign Up</a></p>
        </div>
        <div class="card-right">
            <img class="login-img" src="assets/images/login.png" alt="">
        </div>
            
    </section>
    <script src="javascript/login.js"></script>
</body>
</html>