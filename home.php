<?php
    include('php-scripts/home-scripts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="color-scheme" content="light">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/jquery.timeago.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
    <?php include('php-scripts/navbar.php'); ?>

    <section class="main">
        <div class="container">
            <div class="content-area">
                <?php
                    if(isset($_SESSION['uid'])){ ?>
                        <div class="create-thread">
                            <p>Add a new thread</p>
                            <span>+</span>
                        </div>
                <?php } else { ?>
                    <div class="login">
                        <p style="text-align: center">Log in to create a thread</p>
                    </div>
                <?php } ?>
                <div class="divider">
                    <p>Recent Threads </p>
                    <div>
                        <hr>
                    </div>
                    <label for="tags">Category: </label>
                    <select name="tags" id="select-tags">
                        <option value="">All</option>
                        <option value="general">General</option>
                        <option value="event">Event</option>
                        <option value="registrar">Registrar</option>
                        <option value="cos">COS</option>
                        <option value="coe">COE</option>
                        <option value="cafa">CAFA</option>
                        <option value="cie">CIE</option>
                        <option value="cit">CIT</option>
                        <option value="library">Library</option>
                        <option value="vandalism">Vandalism</option>
                        <option value="bullying">Bullying</option>
                        <option value="missingitem">Missing Item</option>
                        <option value="lgbtq">LGBTQ+</option>
                        <option value="suspension">Suspension</option>
                    </select>
                </div>

                <div class="threads-container">
                    
                    <?php fetchThreads(0, ""); ?>
                    <button id="load-more">Load more</button>

                </div>
            </div>
            <div class="content-more">
                <div>
                    <div class="status">
                        <div>
                            <p class="status-label">Questions</p>
                            <p class="status-num"><?php echo $questions ?></p>
                        </div>
                        <div>
                            <p class="status-label">Answers</p>
                            <p class="status-num"><?php echo $answers ?></p>
                        </div>
                        <div>
                            <p class="status-label">Users</p>
                            <p class="status-num"><?php echo $users ?></p>
                        </div>
                        <span class="lines"></span>
                        <span class="lines second"></span>
                    </div>
                    <div class="like">
                        <p class="heading">Threads you might like</p>
                        <?php
                            if(isset($_SESSION['uid'])){
                                $thread_list = mysqli_query($conn, "SELECT * FROM threads WHERE author != '$_SESSION[uid]' AND thread_status = 'open' ORDER BY RAND() LIMIT 5");
                            } else {
                                $thread_list = mysqli_query($conn, "SELECT * FROM threads WHERE thread_status = 'open' ORDER BY RAND() LIMIT 5");
                            }
                            while ($result = $thread_list->fetch_assoc()) {
                                $count = mysqli_query($conn, "SELECT COUNT(id) FROM comments WHERE thread_id = '$result[thread_id]'");
                                $count = $count->fetch_assoc();
                                $count = $count['COUNT(id)'];
                                $count = ($count <= 1) ? $count . " response" : $count . " responses";
                                echo '
                                    <a class="like-container" href="thread.php?threadid='.$result['thread_id'].'">
                                        <div class="like-info">
                                            <p class="like-title">'.$result['title'].'</p>
                                            <p class="like-datetime">'.date('F d h:i A', strtotime($result['date_posted'] . " " . $result['time_posted'])).'</p>
                                        </div>
                                        <div class="like-count">'.$count.'</div>
                                    </a>
                                ';
                            }
                        ?>
                    </div>
                </div>
                
                <footer>
                    <p>Email us: forum.bsit@gmail.com</p>
                    <p>&copy; 2022 Copyright: TUP Speak!</p>
                </footer>
            </div>
            
        </div>
    </section>
    <script src="javascript/home.js"></script>
</body>
</html>