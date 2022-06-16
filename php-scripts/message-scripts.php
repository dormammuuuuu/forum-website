<?php

    include('db.php');
    session_start();
    $firstload = true;

    function fetchmessages($id){
        $messages = array();
        global $conn;
        $sql = mysqli_query($conn, "SELECT * FROM messages WHERE sender = '".$_SESSION['uid']."' AND receiver = '".$id."' OR sender = '".$id."' AND receiver = '".$_SESSION['uid']."'");
        while($row = mysqli_fetch_assoc($sql)){
            $messages[] = $row;
        }
        return $messages;
    }

    function fetchlist($id){
        $list = array();
        $templist = array();
        $uniquelist = array();
        $final = array();
        global $conn;
        $sql = mysqli_query($conn, "SELECT DISTINCT sender,receiver FROM messages WHERE sender = '".$id."' OR receiver = '".$id."' ");
        
        while($row = mysqli_fetch_assoc($sql)){
            $list[] = $row;
        }

        foreach ($list as $key) {
            if($key['sender'] == $id){
                $templist[] = $key['receiver'];
            } else {
                $templist[] = $key['sender'];
            }
        }
        unset($list);
        $list = array_unique($templist);

        foreach ($list as $key) {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE uid = '".$key."'");
            $sql_message = mysqli_query($conn, "SELECT * FROM messages WHERE (sender = '".$id."' AND receiver = '".$key."') OR (sender = '".$key."' AND receiver = '".$id."') ORDER BY id DESC LIMIT 1");
            $sql_messageResult = mysqli_fetch_assoc($sql_message);
            while($row = mysqli_fetch_assoc($sql)){
                $final[] = array(
                    'uid' => $row['uid'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'avatar' => $row['avatar'],
                    'lastmessage' => $sql_messageResult['message'],
                    'lastmessage_date' => $sql_messageResult['date'],
                    'lastmessage_time' => $sql_messageResult['time'],
                    'lastmessage_seen' => $sql_messageResult['seen'],
                    'lastmessage_sender' => $sql_messageResult['sender'],
                    'session_id' => $_SESSION['uid']
                );
            }
            mysqli_free_result($sql);
            mysqli_free_result($sql_message);
        }

        return $final;
    }

    if(isset($_POST['fetchconversation'])){
        $conversation = mysqli_real_escape_string($conn, $_POST['fetchconversation']);
        $query = mysqli_query($conn, "UPDATE messages SET seen = '1' WHERE sender = '$conversation' AND receiver = '{$_SESSION['uid']}' ");
        $messages = fetchmessages($conversation);
        echo json_encode($messages);
        mysqli_close($conn);
    }

    if(isset($_POST['fetchlist'])){
        $user = $_SESSION['uid'];
        $list = fetchlist($user);
        echo json_encode($list);
        mysqli_close($conn);
    }
    
    if(isset($_GET['id'])){
        if ($firstload == true){
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $query = mysqli_query($conn, "SELECT * FROM users WHERE uid = '$id'");
            $row = mysqli_fetch_array($query);
            $query = mysqli_query($conn, "UPDATE messages SET seen = '1' WHERE sender = '".$id."' AND receiver = '".$_SESSION['uid']."' ");
            if (empty($row)){
                header("Location: ../404.php");
            } else {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $avatar = $row['avatar'];
                $firstload = false;
            }   
        } 
        mysqli_close($conn);
    }


    if(isset($_POST['searchuser'])){
        $json_array = array();
        $searchterm = mysqli_real_escape_string($conn, $_POST['searchuser']);
        $sql = "SELECT * FROM users WHERE firstname LIKE '%".$searchterm."%' or lastname LIKE '%".$searchterm."%'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        while($row = mysqli_fetch_assoc($result)){
            $json_array[] = array(
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'avatar' => $row['avatar'],
                'uid' => $row['uid'],
            );
        }
        echo json_encode($json_array);
        mysqli_close($conn);
    }

    if(isset($_POST['message'])){
        $sender = $_SESSION['uid'];
        $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $sql = "INSERT INTO messages (sender, receiver, message, seen) VALUES ('$sender', '$receiver', '$message', '0')";
        $query = mysqli_query($conn, $sql);
        if ($query){
            $result_json['message'] = "Complete";
        } else {
            $result_json['message'] = "Error";
        }
        echo json_encode($result_json);
        mysqli_close($conn);
        
    }
?>