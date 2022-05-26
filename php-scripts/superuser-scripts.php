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

    function getOtherInfo($userID){
        global $conn;
        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `comments` WHERE comment_author = '$userID'");
        $data = mysqli_fetch_assoc($query);
        $out['comments'] = $data['COUNT(id)'];
        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads` WHERE author = '$userID'");
        $data = mysqli_fetch_assoc($query);
        $out['threads'] = $data['COUNT(id)'];
        return $out; 
    }

    function getData(){
        global $conn , $user_number, $thread_number, $pending_number, $closed_number;
        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `users`");
        $data = mysqli_fetch_assoc($query);
        $user_number = $data['COUNT(id)'];

        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads` WHERE status = 1");
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

    if(isset($_POST['all'])){
        $json_response = array();
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE status = 1 LIMIT 0,2");
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
        $filter = mysqli_real_escape_string($conn, $_POST['type']);
        $data = mysqli_real_escape_string($conn,$_POST['loadmore']);
        if ($filter == 0){
            $query = mysqli_query($conn, "SELECT * FROM threads WHERE status = 0 LIMIT $data,2");
        } else if ($filter == 1) {
            $query = mysqli_query($conn, "SELECT * FROM threads WHERE status = 1 LIMIT $data,2");
        } else if ($filter == 2) {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'student' ORDER BY lastname ASC LIMIT $data,2");
        } else if ($filter == 3) {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'teacher' ORDER BY lastname ASC LIMIT $data,2");

        }
        $result = mysqli_fetch_assoc($query);

        do {
            if (!empty($result)){
                if ($filter == 2 || $filter == 3){
                    $userdata = getOtherInfo($result['uid']);
                    $json_response[] = array(
                        'uid' => $result['uid'], 
                        'firstname' => $result['firstname'],
                        'lastname' => $result['lastname'],
                        'avatar' => $result['avatar'],
                        'comments' => $userdata['comments'],
                        'threads' => $userdata['threads'],
                        'restricted' => $result['restricted'],
                        'account_type' => $result['account_type']
                    );
                } else{
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
            }
        } while ($result = mysqli_fetch_assoc($query));

        echo json_encode($json_response);
        mysqli_close($conn);
    }

    if(isset($_POST['approve'])){
        $approve = mysqli_real_escape_string($conn, $_POST['approve']);
        $query = mysqli_query($conn, "UPDATE `threads` SET `status` = 1 WHERE thread_id = '$approve'");
        if ($query){
            $response['message_console'] = "Complete";
        } else {
            $response['message_console'] = "Error";
        }
        echo json_encode($response);
        mysqli_close($conn);
    }

    if(isset($_POST['account'])){
        $json_response = array();
        $data = mysqli_real_escape_string($conn,$_POST['account']);
        if ($data == 1){
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'student' ORDER BY lastname ASC LIMIT 0,2");
        } else if ($data == 2){
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'teacher' ORDER BY lastname ASC LIMIT 0,2");
        }
        $result = mysqli_fetch_assoc($query);

        do {
            if (!empty($result)){
                $userdata = getOtherInfo($result['uid']);
                $json_response[] = array(
                    'uid' => $result['uid'], 
                    'firstname' => $result['firstname'],
                    'lastname' => $result['lastname'],
                    'avatar' => $result['avatar'],
                    'comments' => $userdata['comments'],
                    'threads' => $userdata['threads'],
                    'restricted' => $result['restricted'],
                    'account_type' => $result['account_type']
                );
            }
        } while ($result = mysqli_fetch_assoc($query));

        echo json_encode($json_response);
        mysqli_close($conn);
    }

    if(isset($_POST['restrictID'])){
        $data = mysqli_real_escape_string($conn,$_POST['restrictID']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='$data'");
        $response = mysqli_fetch_assoc($query);

        $restriction_type = $response['restricted'] == true ? false : true;

        $query = mysqli_query($conn, "UPDATE `users` SET `restricted` = '$restriction_type' WHERE uid = '$data'");
        if ($query) {
            if ($restriction_type == true){
                $result['type'] = "Restricted";
            } else {
                $result['type'] = "Unrestrict";
            }
        } else {
            $result['type'] = "Error adjusting account restriction";
        }
        echo json_encode($result);
        mysqli_close($conn);
    }

    if(isset($_POST['usertype'])){
        $data = mysqli_real_escape_string($conn,$_POST['usertype']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='$data'");
        $response = mysqli_fetch_assoc($query);

        $user_type = $response['account_type'] == "student" ? "teacher" : "student";

        $query = mysqli_query($conn, "UPDATE `users` SET `account_type` = '$user_type' WHERE uid = '$data'");
        if ($query) {
            $result['type'] = "Updated";
        } else {
            $result['type'] = "Error adjusting account type";
        }
        echo json_encode($result);
        mysqli_close($conn);
    }

?>