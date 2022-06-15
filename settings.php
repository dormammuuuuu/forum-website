<?php
    include('php-scripts/settings-scripts.php');
?>

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
    <div class="loader-superuser">
        <div id="loader"></div>
    </div>
    <section class="main">
        <div class="heading-details">
            <h1>Account Settings</h1>
            <p>Change your account settings.</p>
        </div>

        <div class="account-container">


            <div class="acct-navigation">
                <p data-btn="image" class="nav-btn acct-image"><i class='icons bx bxs-user'></i> Profile</p>
                <p data-btn="acct" class="nav-btn acct-details"><i class='icons bx bxs-user-account'></i>Account Details</p>
                <p data-btn="security" class="nav-btn acct-security"><i class='icons bx bxs-lock' ></i>Security</p>
            </div>


            <div class="settings-interface">
            </div>
        </div>

    </section>
    <script src="javascript/settings.js"></script>
</body>
</html>