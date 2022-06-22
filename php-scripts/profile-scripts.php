<?php

    include('db.php');

    session_start();

    function getUserData($userID){
        global $conn;
        $query = mysqli_query($conn, "SELECT firstname, lastname, avatar, account_type FROM `users` WHERE uid = '$userID'");
        $data = mysqli_fetch_assoc($query);
        $out['firstname'] = $data['firstname'];
        $out['lastname'] = $data['lastname'];
        $out['avatar'] = $data['avatar'];
        $out['user_type'] = ucfirst($data['account_type']);
        return $out; 
    }

    function getDeclineReason($tid){
        global $conn;
        $query = mysqli_query($conn, "SELECT message FROM `declined` WHERE thread_id = '$tid'");
        $data = mysqli_fetch_assoc($query);
        return $data['message'];
    }

    function checkSaved($uid, $tid){
        global $conn;
        $query = mysqli_query($conn, "SELECT id FROM `save` WHERE uid = '$uid' AND thread_id = '$tid'");
        return (mysqli_num_rows($query) > 0) ? true : false;
    }

    if(isset($_GET['view'])){
        $id = mysqli_real_escape_string($conn, $_GET['view']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='$id'");
        $data = mysqli_fetch_array($query);
        mysqli_close($conn);
    }

    if(isset($_POST['fetch'])){
        $json_response = array();
        $thread = mysqli_real_escape_string($conn, $_POST['fetch']);
        $userprofile = mysqli_real_escape_string($conn, $_POST['user_id']);

        switch($thread){
            case 'all':
                $status = "SELECT title, body, date_posted, time_posted, author, thread_id, thread_status FROM threads WHERE thread_status IN ('open', 'close') AND author = '{$userprofile}' ORDER BY id DESC LIMIT 0,10";
                break;
            case 'saved':
                $status = "SELECT title, body, date_posted, time_posted, author, thread_id, thread_status FROM threads WHERE thread_status IN ('open', 'close') AND thread_id IN (SELECT thread_id FROM save WHERE uid = '{$userprofile}') ORDER BY id DESC LIMIT 0,10";
                break;
            case 'pending':
                $status = "SELECT title, body, date_posted, time_posted, author, thread_id, thread_status FROM threads WHERE thread_status = 'pending' AND author = '{$_SESSION['uid']}' ORDER BY id DESC LIMIT 0,10";
                break;
            case 'declined':
                $status = "SELECT title, body, date_posted, time_posted, author, thread_id, thread_status FROM threads WHERE thread_status = 'declined' AND author = '{$_SESSION['uid']}' ORDER BY id DESC LIMIT 0,10";
                break;
        }

        $query = mysqli_query($conn, $status);
        $result = mysqli_fetch_assoc($query);

        if (!empty($result)){
            do {
                $userdata = getUserData($result['author']);
                $saved = ($thread === 'saved') ? true : checkSaved($result['author'], $result['thread_id']);
                $reason = ($thread === 'declined') ? getDeclineReason($result['thread_id']) : '';
                $json_response[] = array(
                    'title' => $result['title'], 
                    'firstname' => $userdata['firstname'],
                    'lastname' => $userdata['lastname'],
                    'avatar' => $userdata['avatar'],
                    'type' => $userdata['user_type'],
                    'thread_id' => $result['thread_id'], 
                    'body' => $result['body'], 
                    'date' => $result['date_posted'], 
                    'time' => $result['time_posted'],
                    'saved' => $saved,
                    'status' => $result['thread_status'],
                    'reason' => $reason
                );
            } while ($result = mysqli_fetch_assoc($query));    
        }
        echo json_encode($json_response);
        mysqli_close($conn);
    }

    if(isset($_POST['savethread'])){
        $savethread = mysqli_real_escape_string($conn, $_POST['savethread']);
        $user = mysqli_real_escape_string($conn, $_SESSION['uid']);
        $sql = mysqli_query($conn, "SELECT * FROM `save` WHERE thread_id='$savethread' AND uid='$user'");
        if(mysqli_num_rows($sql) == 0){
            $sql = mysqli_query($conn, "INSERT INTO `save` (thread_id, uid) VALUES ('$savethread', '$user')");
            $result_json['statusCode'] = 200;
            $result_json['message'] = "Added to Saved";
        }else{
            $sql = mysqli_query($conn, "DELETE FROM `save` WHERE thread_id='$savethread' AND uid='$user'");
            $result_json['statusCode'] = 202;
            $result_json['message'] = "Removed to Saved";
        }
        echo json_encode($result_json);
        mysqli_close($conn);
    }

?>