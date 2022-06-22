<?php
    include('php-scripts/profile-scripts.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $data['firstname'] . ' ' . $data['lastname'] ?> | Profile</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/jquery.timeago.js"></script>
    <script src="javascript/editorjsToHTML.js"></script>
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
                        <p class="profile-campus">Technological University of the Philippines - <?php echo $data['campus'] ?></p>
                        <p class="profile-course"><?php echo $data['bio'] ?></p>
                        <?php if ($_SESSION['uid'] !== $_GET['view']) {?>
                            <div class="message-user">
                                <i class='bx bxs-message-square-dots'></i>
                                <p>Message</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div id="profile-view">
                <div class="panel left">
                    <div class="panel-menu">
                        <button data-btn="all">All threads</button>
                        <?php if ($_SESSION['uid'] === $_GET['view']) {?>
                            <button data-btn="saved">Saved threads</button>
                            <button data-btn="pending">Pending threads</button>
                            <button data-btn="declined">Declined threads</button>
                        <?php } ?>
                    </div>
                    <div id="panel-content">
                    </div>
                </div>
                
                <div class="panel right">
                    <div class="create-btn" href="create.php">Start a new thread</div>
                    <div class="panel-detailed-view">
                        <h1>User Summary</h1>
                        <p>Threads: 0</p>
                        <p>Comments: 0</p>
                        <p>Votes: 0</p>
                    </div>
                </div>
            </div>
        </div>
       
    </section>

    <script src="javascript/profile.js"></script>
</body>
</html>