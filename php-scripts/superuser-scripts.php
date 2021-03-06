<?php

    include('db.php');
    $user_number; $thread_number; $pending_number; $closed_number;

    session_start();
    if(!isset($_SESSION['uid'])){
        header('location: ../home.php');
    }

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

        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads`");
        $data = mysqli_fetch_assoc($query);
        $thread_number = $data['COUNT(id)'];

        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads` WHERE thread_status = 'pending'");
        $data = mysqli_fetch_assoc($query);
        $pending_number = $data['COUNT(id)'];

        $query = mysqli_query($conn, "SELECT COUNT(id) FROM `threads` WHERE thread_status = 'close'");
        $data = mysqli_fetch_assoc($query);
        $closed_number = $data['COUNT(id)'];
    }

    if(isset($_SESSION['uid'])){
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$_SESSION['uid']}'");
        $result = mysqli_fetch_array($query);
        if ($result['privileged'] != 1){
            header('location: ../404.php');
        } else {
            getData();
        }
    }

    //Fire continuous request from the server
    if(isset($_POST['continuous'])){
        if(!isset($_SESSION['uid'])){
            header('location: ../home.php');
        } else {
            getData();
            $response = array(
                'user' => $user_number, 
                'thread' => $thread_number, 
                'pending' => $pending_number, 
                'closed' => $closed_number 
            );
        }
        

        echo json_encode($response);
        mysqli_close($conn);
    }

    //Fetch Pending Threads (Initial = 2)
    if(isset($_POST['pending'])){
        $json_response = array();
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE thread_status = 'pending' LIMIT 0,10");
        $result = mysqli_fetch_assoc($query);

        if (!empty($result)){
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
        }
        

        echo json_encode($json_response);
        mysqli_close($conn);
    }

    if(isset($_POST['all'])){
        $json_response = array();
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE thread_status = 'open' LIMIT 0,10");
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
            $query = mysqli_query($conn, "SELECT * FROM threads WHERE thread_status = 'pending' LIMIT $data,10");
        } else if ($filter == 1) {
            $query = mysqli_query($conn, "SELECT * FROM threads WHERE thread_status = 'open' LIMIT $data,10");
        } else if ($filter == 2) {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'student' ORDER BY lastname ASC LIMIT $data,10");
        } else if ($filter == 3) {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'teacher' ORDER BY lastname ASC LIMIT $data,10");

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
        $target_query = mysqli_query($conn, "SELECT author FROM threads WHERE thread_id = '$approve'");
        $target = mysqli_fetch_array($target_query);
        $target_uid = $target['author'];
        $query = mysqli_query($conn, "UPDATE `threads` SET `status` = 1, `thread_status` = 'open' WHERE thread_id = '$approve'");
        if ($query){
            $query = mysqli_query($conn, "INSERT INTO `notification`(`thread_id`, `target_user`, `notif_author`, `notification_type`) VALUES ('$approve', '$target_uid','system','approve')");
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
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'student' ORDER BY lastname ASC LIMIT 0,10");
        } else if ($data == 2){
            $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'teacher' ORDER BY lastname ASC LIMIT 0,10");
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

    if(isset($_POST['restrict'])){
        $data = mysqli_real_escape_string($conn,$_POST['restrict']);
        $reason = mysqli_real_escape_string($conn,$_POST['reason']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='$data'");
        $response = mysqli_fetch_assoc($query);

        $restriction_type = $response['restricted'] == true ? false : true;
        $reason = $response['restricted_reason'] == NULL ? $reason : NULL;

        $query = mysqli_query($conn, "UPDATE `users` SET `restricted` = '$restriction_type', `restricted_reason`='$reason' WHERE uid = '$data'");
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
        $data = mysqli_real_escape_string($conn,$_POST['uid']);
        $type = mysqli_real_escape_string($conn,$_POST['usertype']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='$data'");
        $response = mysqli_fetch_assoc($query);

        $query = ($type == "admin") ? mysqli_query($conn, "UPDATE `users` SET `account_type` = '$type', `privileged` = 1 WHERE uid = '$data'") : mysqli_query($conn, "UPDATE `users` SET `account_type` = '$type',  `privileged` = 0 WHERE uid = '$data'");

        if ($query) {
            $result['type'] = "Updated";
        } else {
            $result['type'] = "Error adjusting account type";
        }
        echo json_encode($result);
        mysqli_close($conn);
    }

    //Close thread
    if(isset($_POST['closethread'])){
        $data = mysqli_real_escape_string($conn,$_POST['closethread']);
        $query = mysqli_query($conn, "UPDATE `threads` SET `thread_status` = 'close' WHERE thread_id = '$data'");
        if ($query) {
            $result['type'] = "Closed";
        } else {
            $result['type'] = "Error closing thread";
        }
        echo json_encode($result);
        mysqli_close($conn);
    }

    //load closed threads
    if(isset($_POST['closed'])){
        $json_response = array();
        $data = mysqli_real_escape_string($conn,$_POST['closed']);
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE thread_status = 'close' ORDER BY date_posted DESC LIMIT 0,10");
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

    //open thread
    if(isset($_POST['openthread'])){
        $data = mysqli_real_escape_string($conn,$_POST['openthread']);
        $query = mysqli_query($conn, "UPDATE `threads` SET `thread_status` = 'open' WHERE thread_id = '$data'");
        if ($query) {
            $result['type'] = "Opened";
        } else {
            $result['type'] = "Error opening thread";
        }
        echo json_encode($result);
        mysqli_close($conn);
    }

    //load admin accounts
    if(isset($_POST['admin'])){
        $json_response = array();
        $query = mysqli_query($conn, "SELECT * FROM users WHERE account_type = 'admin' ORDER BY lastname ASC LIMIT 0,10");
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

    //decline a thread
    if(isset($_POST['declinethread'])){
        $data = mysqli_real_escape_string($conn,$_POST['declinethread']);
        $reason = mysqli_real_escape_string($conn,$_POST['reason']);
        $query = mysqli_query($conn, "SELECT * FROM declined WHERE thread_id = '$data'");
        $user = mysqli_query($conn, "SELECT author FROM threads WHERE thread_id = '$data'");
        $user = mysqli_fetch_assoc($user);
        $user = $user['author'];
        if (mysqli_num_rows($query) > 0) {
            $query = mysqli_query($conn, "UPDATE `declined` SET `message` = 'reason' WHERE thread_id = '$data'");
            if ($query) {
                $result['type'] = "Thread declined successfully";
            } else {
                $result['type'] = "Thread declined failed";
            }
        } else {
            $query = mysqli_query($conn, "INSERT INTO `declined` (`thread_id`, `message`) VALUES ('$data', '$reason')");
            $result['type'] = "Error declining thread";
        }
        $query = mysqli_query($conn, "UPDATE `threads` SET `thread_status` = 'declined' WHERE thread_id = '$data'");
        $query = mysqli_query($conn, "INSERT INTO `notification`(`thread_id`, `target_user`, `notif_author`, `notification_type`) VALUES ('$data', '$user','system','declined')");
        echo json_encode($result);
        mysqli_close($conn);

    }

    function getDeclineReason($thread_id){
        global $conn;
        $query = mysqli_query($conn, "SELECT * FROM declined WHERE thread_id = '$thread_id'");
        $result = mysqli_fetch_assoc($query);
        return $result['message'];
    }

    //load declined threads
    if(isset($_POST['decline'])){
        $json_response = array();
        $data = mysqli_real_escape_string($conn,$_POST['decline']);
        $query = mysqli_query($conn, "SELECT * FROM threads WHERE thread_status = 'declined' ORDER BY date_posted DESC LIMIT 0,10");
        $result = mysqli_fetch_assoc($query);

        do {
            if (!empty($result)){
                $declinereason = getDeclineReason($result['thread_id']);
                $userdata = getUserData($result['author']);
                $json_response[] = array(
                    'title' => $result['title'], 
                    'firstname' => $userdata['firstname'],
                    'lastname' => $userdata['lastname'],
                    'avatar' => $userdata['avatar'],
                    'thread_id' => $result['thread_id'], 
                    'body' => $result['body'], 
                    'date' => $result['date_posted'], 
                    'time' => $result['time_posted'],
                    'decline_message' => $declinereason
                );
            }
        } while ($result = mysqli_fetch_assoc($query));

        echo json_encode($json_response);
        mysqli_close($conn);
    }
?>