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
            <h1>Forgot your password?</h1>
            <p class="subheading">A verification code will be sent to your email.</p>
            <form id="forgot-form" method="POST">
                <div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
                <input id="forgot-submit" name="submit" type="submit" value="Reset Password">
            </form>
            <p class="login"><a href="login.html">Back to log in</a></p>
        </div>
    </section>
    <script src="javascript/forgot.js"></script>
</body>
</html>