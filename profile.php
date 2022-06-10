<?php
    include('php-scripts/profile-scripts.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Name | Profile</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="javascript/jquery-3.6.0.js"></script>
</head>
<body>
    
    <?php include('php-scripts/navbar.php'); ?>

    <section class="main">
        <div class="profile-container">
            <div>
                <div class="profile-details">
                    <div class="profile-images">
                        <img class="profile-cover" src="<?php echo $data['cover'] ?>" alt="">
                        <img class="profile-avatar" src="<?php echo $data['avatar'] ?>" alt="">

                    </div>
                    <div class="user-profile">
                        <div class="user-main">
                            <p class="profile-name"><?php echo $data['firstname'] . ' ' . $data['lastname'] ?></p>
                            <p class="profile-type"><?php echo ucfirst($data['account_type']) ?></p>
                        </div>
                        <p class="profile-course">Bachelor of Science in Information Technology</p>
                        <p class="profile-campus">TUP - Manila</p>
                        <div class="message-user">
                            <i class='bx bxs-message-square-dots'></i>
                            <p>Message</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>