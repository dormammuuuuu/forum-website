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
        <link rel="stylesheet" href="styles/loader.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <script src="javascript/jquery-3.6.0.js"></script>
        <script src="javascript/jquery.timeago.js"></script>
        <script src="javascript/editorjsToHTML.js"></script>
        
    </head>
    <body>
        <div class="loader-superuser">
            <div id="loader"></div>
        </div>
        <section class="main">
            <div class="tup-gif">
            </div>
            <div class="whole-container">

            <div id="dashboard">
                <p>Dashboard</p>
                <div>
                    <hr>
                </div>
            </div>
            <div class="dashboard-box">
                <div class="box">
                    <h1 class="total-title"> Active Users</h1>
                    <div class="inside-box">
                        <h1 class="total-number" id="user-number"><?php echo $user_number ?></h1>
                        <i class='icon bx bxs-user'></i>
                    </div>
                </div>
                <div class="box">
                    <h1 class="total-title"> Number of Threads</h1>
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
                        <div class="pending-threads">
                        </div>
                    </div>
                </div>
                <div class="container-1">
                    <div class="list-user">
                        <h1 class="list-user-title">Manage</h1>
                        <div class="parent-manage">
                            <div class="btn_direction">
                                    <button id="slideLeft" type="button"><</button>
                                    <button id="slideRight" type="button">></button>
                            </div>
                            <ul id="list-cate">
                                <li id="all-button">Current Threads</li>
                                <li id="pending-button">Pending Threads</li>
                                <li id="closed-button">Closed Threads</li>
                                <li id="declined-button">Declined Threads</li>
                                <li id="student-button">Students</li>
                                <li id="teacher-button">Teachers</li>
                                <li id="admin-button">Administrators</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </section>
        <script src="javascript/superuser.js"></script>
    </body>
</html>