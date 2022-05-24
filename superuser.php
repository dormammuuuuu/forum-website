<?php
    include('php-scripts/superuser-scripts.php');
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="styles/default.css">
        <link rel="stylesheet" href="styles/superuser.css">
        <link rel="stylesheet" href="styles/navbar.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <script src="javascript/jquery-3.6.0.js"></script>
        <script src="javascript/jquery.timeago.js"></script>
        <script src="javascript/editorjsToHTML.js"></script>
        
    </head>
    <body>
        <section class="main">
            <div class="tup-gif">
            </div>
            <div id="dashboard">
                <p>Dashboard</p>
                <div>
                    <hr>
                </div>
            </div>
            <div class="dashboard-box">
                <div class="box">
                    <h1 class="total-title"> Total number of Users</h1>
                    <div class="inside-box">
                        <h1 class="total-number" id="user-number"><?php echo $user_number ?></h1>
                        <i class='icon bx bxs-user'></i>
                    </div>
                </div>
                <div class="box">
                    <h1 class="total-title"> Total number of Threads</h1>
                    <div class="inside-box">
                        <h1 class="total-number" id="thread-number"><?php echo $thread_number ?></h1>
                        <i class='icon bx bxs-message-square-detail'></i>
                    </div>
                </div>
                <div class="box">
                    <h1 class="total-title"> Pending Threads</h1>
                    <div class="inside-box">
                        <h1 class="total-number" id="pending-number"><?php echo $pending_number ?></h1>
                        <i class='icon bx bxs-time-five'></i>
                    </div>
                </div>
                <div class="box">
                    <h1 class="total-title"> Close Threads</h1>
                    <div class="inside-box">
                        <h1 class="total-number" id="closed-number"><?php echo $closed_number ?></h1>
                        <i class='icon bx bxs-message-square-x'></i>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div class="container">
                    <div class="pending-container">
                        <h1 class="pending-title">Pending Threads</h1>
                        <!-- <div class="pending-nav">
                            <ul id="pending-cate">
                               <li>COS</li>
                               <li>CIE</li>
                               <li>COE</li>
                               <li>CAFA</li>
                               <li>CLA</li>
                               <li>CIT</li>
                            </ul>
                            </div> -->
                        <div class="pending-threads">
                            
                        </div>
                    </div>
                </div>
                <div class="container-1">
                    <div class="list-user">
                        <h1 class="list-user-title">Manage</h1>
                        <ul id="list-cate">
                            <li>Student</li>
                            <li>Teacher</li>
                            <li id="pending-button">Pending Restrictions of user</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <script src="javascript/superuser.js"></script>
    </body>
</html>