<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "forum";

    $conn = mysqli_connect($server, $username, $password, $databaseName);
    

    if(mysqli_connect_errno()){
        echo "Database Error";
        exit();
    }
?>