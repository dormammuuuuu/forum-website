<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/loader.css">
    <script src="javascript/jquery-3.6.0.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include('php-scripts/navbar.php'); ?>
    <section class="main">
        <div class="heading-details">
            <h1>Account Settings</h1>
            <p>Change your account settings.</p>
        </div>

        <div class="account-container">
            <div class="acct-navigation">
                <p class="nav-btn acct-image"><i class='icons bx bxs-user'></i> Profile</p>
                <p class="nav-btn acct-details"><i class='icons bx bxs-user-account'></i>Account Details</p>
                <p class="nav-btn acct-security"><i class='icons bx bxs-lock' ></i>Security</p>
            </div>
            <div class="acct-menu">
                    <h4>Account Details</h4>
                <div class="user-details">             
                    <div class="input-field">
                        <label class="input-label" for="fname"> First Name</label>
                        <input type="text" name="fname">
                    </div>

                    <div class="input-field">
                        <label class="input-label" for="lname"> Last Name</label>
                        <input type="text" name="lname">
                    </div>

                    <div class="input-field">
                        <label class="input-label" for="email"> Email</label>
                        <input type="text" name="email">
                    </div>

                    <div class="input-field">
                        <label class="input-label" for="bdate"> Birthdate</label>
                        <input type="date" name="bdate">
                    </div>
                    
                </div>
            </div>
            <!-- 
            <div class="security">
                <h4>Security</h4>
                <div class="input-field">
                    <label class="input-label" for="password"> Password</label>
                    <input type="password" name="password">
                </div>
                <div class="input-field">
                    <label class="input-label" for="npassword"> New Password</label>
                    <input type="password" name="npassword">
                </div>
                <div class="input-field">
                    <label class="input-label" for="cpassword"> Confirm Password</label>
                    <input type="password" name="cpassword">
                </div>
            </div>
            <div class="avatar">
                <div class="avatar-form">
                    <img class="user-avatar" src="assets/images/avatar/default.jpg" alt="Avatar">
                </div>
            </div> -->
        </div>

    </section>
</body>
</html>