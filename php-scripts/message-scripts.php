<?php

    include('db.php');
    session_start();
    $firstload = true;
    
    if(isset($_GET['id'])){
        if ($firstload == true){
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $query = mysqli_query($conn, "SELECT * FROM users WHERE uid = '$id'");
            $row = mysqli_fetch_array($query);
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $avatar = $row['avatar'];
            $firstload = false;
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

?>