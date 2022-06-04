<?php

    include('db.php');

    session_start();

    if(isset($_GET['view'])){
        $id = mysqli_real_escape_string($conn, $_GET['view']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='$id'");
        $data = mysqli_fetch_array($query);
        mysqli_close($conn);
    }

?>