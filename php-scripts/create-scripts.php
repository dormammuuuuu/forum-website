<?php

    include('db.php');

    if(isset($_POST['title'])){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $tags = json_decode($_POST['tags']);
        $thread_id = uniqid('thrd');
        echo $tags;
        $query = mysqli_query($conn,"INSERT INTO `threads`(`id`, `thread_id`, `title`, `body`, `tags`, `status`) VALUES (NULL,'$thread_id','$title','$body','$tags', 0)");
        if ($query) {
            $result_json['statusCode'] = 201;
        } else {
            $result_json['statusCode'] = 200;
        }

        echo json_encode($result_json);
        mysqli_close($conn);
    }

?>