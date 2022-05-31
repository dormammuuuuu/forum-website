<?php

    include('db.php');

    session_start();
    

    if(!isset($_SESSION['uid'])){
        header("location: ../home.php");
    } else {
        $id = (isset($_GET['id'])) ? $_GET['id'] : NULL;
        $query = mysqli_query($conn, "SELECT * FROM `threads` WHERE `thread_id` = '$id'");
        $data = mysqli_fetch_assoc($query);
        if (!empty($data)){
            $authorID = $data['author'];
            if($_SESSION['uid'] != $authorID){
                header("location: ../404.php");
            }
        } 
    }

    if(isset($_POST['thread_data'])){
        $thread = mysqli_query($conn, "SELECT * FROM `threads` WHERE `thread_id` = '{$_POST['thread_data']}'");
        $thread_id = mysqli_fetch_assoc($thread);

        if ($thread_id){
            $thread_data = array(
                'thread_id' => $thread_id['thread_id'],
                'title' => $thread_id['title'],
                'body' => $thread_id['body'],
                'tags' => $thread_id['tags'],
                'author' => $thread_id['author']
            );
        } else {
            
        }
        //create an array
        

        //sending json string through ajax and encoding array to json string and
        echo json_encode($thread_data);
        mysqli_close($conn);
    }

    //edit thread
    if(isset($_POST['editID'])){
        $title = $_POST['title'];
        $body = $_POST['body'];
        $tags = $_POST['tags'];
        $thread_id = $_POST['editID'];
        $author = $_SESSION['uid'];

        $sql = "UPDATE `threads` SET `title` = '$title', `body` = '$body', `tags` = '$tags' WHERE `thread_id` = '$thread_id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            $response['status'] = "success";
        } else {
            $response['status'] = "failed";
        }
        echo json_encode($response);
        mysqli_close($conn);
    }

?>