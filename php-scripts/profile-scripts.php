<?php

    include('db.php');

    session_start();

    if(isset($_GET['view'])){
        $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$_GET['view']}'");
        $result = mysqli_fetch_array($query);
    }

?>