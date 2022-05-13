<?php

    include('db.php');

    function fetchComments($tid){
        global $conn;
        $query = mysqli_query($conn, "SELECT * FROM comments WHERE thread_id='$tid'");
        $data_comment = $query->fetch_assoc();

        if (!empty($data_comment)){
            do{
                $user = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$data_comment["comment_author"]}'");
                $data = mysqli_fetch_array($user);
                if ($data){
                    $author_given_name = $data['firstname'];
                    $author_family_name = $data['lastname'];
                    $author_avatar = $data['avatar'];
                }
                echo '
                <div class="main-comment">
                    <div class="author-comment">
                        <img class="thread-avatar" src="'. $author_avatar .'" alt="">
                        <div class="details">
                            <div class="user">
                                <p class="name">'. $author_given_name . " " . $author_family_name .'</p>
                                <p class="user-type">Student</p>
                            </div>
                            <p class="date-published"><script>document.write(jQuery.timeago("'. $data_comment['comment_date'] . " " . $data_comment['comment_time'] .'"))</script></p>
                        </div>
                    </div>
                    <p id="main-answer"> '.$data_comment['comment'].'</p>
                </div>
                ';
            } while ($data_comment = $query->fetch_assoc());
        }
    }

    if(isset($_POST['commentLoad'])){
        $status = $_POST['commentLoad'];
        $threadID = mysqli_real_escape_string($conn, $_POST['threadID']);
        fetchComments($threadID);
    }

    if(isset($_GET['threadid'])){
        $tid = $_GET['threadid'];
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE thread_id = '$tid'");
        $data = mysqli_fetch_array($query);

        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid = '{$data['author']}'");
        $user_data = mysqli_fetch_array($query);
    }

    if(isset($_POST['comment'])){
        @session_start();
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $threadID = mysqli_real_escape_string($conn, $_POST['threadID']);
        $commentID = uniqid('C');
        $query = mysqli_query($conn, "INSERT INTO `comments`(`thread_id`, `comment_id`, `comment_author`, `comment`) VALUES ('$threadID','$commentID','{$_SESSION['uid']}','$comment')");
        
        if ($query){
            $query = mysqli_query($conn, "SELECT * FROM comments WHERE comment_id='$commentID'");
            $data_comment = mysqli_fetch_array($query);
            if (!empty($data_comment)){
                $user = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$_SESSION['uid']}'");
                $data = mysqli_fetch_array($user);
                if ($data){
                    $given_name = $data['firstname'];
                    $family_name = $data['lastname'];
                    $avatar = $data['avatar'];
                }
                echo '
                <div class="main-comment">
                    <div class="author-comment">
                        <img class="thread-avatar" src="'. $avatar .'" alt="">
                        <div class="details">
                            <div class="user">
                                <p class="name">'. $given_name . " " . $family_name .'</p>
                                <p class="user-type">Student</p>
                            </div>
                            <p class="date-published" data-datetime="'. $data_comment['comment_date'] . " " . $data_comment['comment_time'] .'"></p>
                        </div>
                    </div>
                    <p id="main-answer"> '.$comment.'</p>
                </div>
                ';
            }
        } else {
           echo "ERROR";
        }

        mysqli_close($conn);
    }

?>