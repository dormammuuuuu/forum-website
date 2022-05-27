<?php

    @session_start();

    if(isset($_POST['session'])){

        if(!isset($_SESSION['uid'])){
            $response['status'] = "Session Destroyed or Expired";
        } else {
            $response['status'] = "Session Available";
        }
        
        echo json_encode($response);
    }


?>