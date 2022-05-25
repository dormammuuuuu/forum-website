<?php

    include('db.php');
    $user_number; $thread_number; $pending_number; $closed_number;

    function getUserData($userID){
        global $conn;
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE uid = '$userID'");
        $data = mysqli_fetch_assoc($query);
        $out['firstname'] = $data['firstname'];
        $out['lastname'] = $data['lastname'];
        $out['avatar'] = $data['avatar'];
        return $out; 
    }

    function getData(){
        global $conn , $user_number, $thread_number, $pending_number, $closed_number;
        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `users`");
        $data = mysqli_fetch_assoc($query);
        $user_number = $data['COUNT(id)'];

        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads`");
        $data = mysqli_fetch_assoc($query);
        $thread_number = $data['COUNT(id)'];

        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads` WHERE status = 0");
        $data = mysqli_fetch_assoc($query);
        $pending_number = $data['COUNT(id)'];

        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads` WHERE thread_status = 'close'");
        $data = mysqli_fetch_assoc($query);
        $closed_number = $data['COUNT(id)'];
    }

    session_start();
    if(isset($_SESSION['uid'])){
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$_SESSION['uid']}'");
        $result = mysqli_fetch_array($query);
        if ($result['privileged'] != 1){
            header('location: ../404.php');
        } else {
            getData();
        }
    }

    //Fire continous request from the server
    if(isset($_POST['continuous'])){
        getData();
        $response = array(
            'user' => $user_number, 
            'thread' => $thread_number, 
            'pending' => $pending_number, 
            'closed' => $closed_number 
        );

        echo json_encode($response);
        mysqli_close($conn);
    }

    //Fetch Pending Threads (Initial = 2)
    if(isset($_POST['pending'])){
        $json_response = array();
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE status = 0 LIMIT 0,2");
        $result = mysqli_fetch_assoc($query);

        do {
            $userdata = getUserData($result['author']);
            $json_response[] = array(
                'title' => $result['title'], 
                'firstname' => $userdata['firstname'],
                'lastname' => $userdata['lastname'],
                'avatar' => $userdata['avatar'],
                'thread_id' => $result['thread_id'], 
                'body' => $result['body'], 
                'date' => $result['date_posted'], 
                'time' => $result['time_posted']
            );
        } while ($result = mysqli_fetch_assoc($query));

        echo json_encode($json_response);
        mysqli_close($conn);
    }

    //Fetch Pending Threads (+2 to initial displayed thread)
    if(isset($_POST['loadmore'])){
        $json_response = array();
        $data = mysqli_real_escape_string($conn,$_POST['loadmore']);
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE status = 0 LIMIT $data,2");
        $result = mysqli_fetch_assoc($query);

        do {
            if (!empty($result)){
                $userdata = getUserData($result['author']);
                $json_response[] = array(
                    'title' => $result['title'], 
                    'firstname' => $userdata['firstname'],
                    'lastname' => $userdata['lastname'],
                    'avatar' => $userdata['avatar'],
                    'thread_id' => $result['thread_id'], 
                    'body' => $result['body'], 
                    'date' => $result['date_posted'], 
                    'time' => $result['time_posted']
                );
            }
        } while ($result = mysqli_fetch_assoc($query));

        echo json_encode($json_response);
        mysqli_close($conn);
    }

?>