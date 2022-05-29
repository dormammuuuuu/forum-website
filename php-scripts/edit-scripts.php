<?php

    include('db.php');

    session_start();
    
    if(!isset($_SESSION['uid'])){
        header("location: ../home.php");
    }

    if(isset($_POST['thread_data'])){
        $thread = mysqli_query($conn, "SELECT * FROM `threads` WHERE `thread_id` = '{$_POST['thread_data']}'");
        $thread_id = mysqli_fetch_assoc($thread);

        //create an array
        $thread_data = array(
            'thread_id' => $thread_id['thread_id'],
            'title' => $thread_id['title'],
            'body' => $thread_id['body'],
            'tags' => $thread_id['tags'],
            'author' => $thread_id['author']
        );

        //sending json string through ajax and encoding array to json string and
        echo json_encode($thread_data);
        mysqli_close($conn);
    }

?>