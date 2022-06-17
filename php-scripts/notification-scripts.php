<?php

    include('db.php');
    session_start();
    if(isset($_POST['loadnavnotif'])){
        $json_response = array();
        $uid = $_SESSION['uid'];
        $query = "SELECT COUNT(id) FROM messages WHERE receiver = '$uid' AND seen = '0'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        $json_response['notif'] = $data['COUNT(id)'];
        echo json_encode($json_response);
        mysqli_close($conn);
    }

?>