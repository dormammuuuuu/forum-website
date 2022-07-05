<?php

    include('db.php');
    session_start();

    function fetchThread($tid){
        global $conn;
        $query = mysqli_query($conn, "SELECT title FROM threads WHERE thread_id = '$tid'");
        $row = mysqli_fetch_assoc($query);
        $out = $row['title'];
        return $out;
    }

    function fetchUserData($uid){
        global $conn;
        if ($uid === "system"){
            $out['fullname'] = "";
            $out['avatar'] = '../assets/images/system_notif.png';
            return $out;
        }
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid = '$uid'");
        $row = mysqli_fetch_assoc($query);
        $out['fullname'] = $row['firstname']." ".$row['lastname'];
        $out['avatar'] = $row['avatar'];
        return $out;
    }

    if(isset($_POST['loadnotifications'])){
        $json_response = array();
        $uid = @$_SESSION['uid'] ?: "";
        $query = "SELECT COUNT(id) FROM messages WHERE receiver = '$uid' AND seen = '0'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        $message_count = $data['COUNT(id)'];
        $query = "SELECT COUNT(id) FROM notification WHERE target_user = '$uid' and seen = 0";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        $notification_count = $data['COUNT(id)'];
        $json_response[] = array(
            'message' => $message_count,
            'notification' => $notification_count
        );
        $query = "SELECT * FROM notification WHERE target_user = '$uid' ORDER BY id DESC LIMIT 10";
        $result = mysqli_query($conn, $query);
        while($data = mysqli_fetch_assoc($result)){
            $thread = fetchThread($data['thread_id']);
            $user = fetchUserData($data['notif_author']);
            $json_response[] = array(
                'type' => $data['notification_type'],
                'thread_title' => $thread,
                'fullname' => $user['fullname'],
                'avatar' => $user['avatar'],
                'timestamp' => $data['timestamp'],
                'seen' => $data['seen'],
                'thread_id' => $data['thread_id'],
                'notif_id' => $data['id'] 
            );
        }
        echo json_encode($json_response);
        mysqli_close($conn);
    }

    if(isset($_POST['readall'])){
        $query = mysqli_query($conn, "UPDATE `notification` SET `seen` = '1' WHERE target_user = '{$_SESSION['uid']}'");
        if ($query) {
            $result['type'] = "Read all";
        } else {
            $result['type'] = "Error reading all";
        }
        echo json_encode($result);
        mysqli_close($conn);
    }

    if(isset($_POST['notif_id'])){
        $notif_id = mysqli_real_escape_string($conn, $_POST['notif_id']);
        $query = mysqli_query($conn, "UPDATE `notification` SET `seen` = '1' WHERE id = '$notif_id'");
        if ($query) {
            $result['type'] = "Read";
        } else {
            $result['type'] = "Error reading";
        }
        echo json_encode($result);
        mysqli_close($conn);
    }

?>