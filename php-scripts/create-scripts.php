<?php

    include('db.php');

    session_start();
    
    if(!isset($_SESSION['uid'])){
        header("location: ../home.php");
    }

    if(isset($_POST["title"])){
        @session_start();
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);   
        $tags = $_POST['tags'];
        $thread_id = uniqid('thrd');

        $query = mysqli_query($conn,"INSERT INTO `threads`(`id`, `thread_id`, `author`,`title`, `body`, `tags`, `status`) VALUES (NULL,'$thread_id', '{$_SESSION['uid']}','$title','$body','$tags', 0)");
        if ($query) {
            $result_json['statusCode'] = 200;
        } else {
            $result_json['statusCode'] = 201;
        }
        
        echo json_encode($result_json);;
        mysqli_close($conn);
    }

    
?>