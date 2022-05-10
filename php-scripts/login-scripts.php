<?php

    include('db.php');
    
    require 'vendor/autoload.php';



    $google_client = new Google_Client();
    $google_client->setClientId('19064399980-57o0n2utlfolf736ler29oq4up435mvq.apps.googleusercontent.com');
    $google_client->setClientSecret('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');
    $google_client->setRedirectUri('http://localhost/login.php');
    $google_client->addScope('email');
    $google_client->addScope('profile');

    session_start();
    if(isset($_SESSION['uid'])){
        header('location: ../home.php');
    }

    function loginAccount($email, $password, $type){
        global $conn;

        if ($type == 1){
            $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        } else {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        }

        $user_data = mysqli_fetch_array($query);

        if($user_data){
            @session_start();
            $_SESSION['uid'] = $user_data['uid'];
            header('location: ../home.php');
        } else {
            return 201;
        }
    }

    function duplicateCheck($email){
        global $conn;
        $stat = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
        return mysqli_num_rows($stat);
    }


    if(isset($_POST['email'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $result_json['statusCode'] = loginAccount($email, $password, 1);
        
        echo json_encode($result_json);
        mysqli_close($conn);
    }

    //Function that will save the user's google account details at the server
    if(isset($_GET["code"])){
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
        if(!isset($token['error'])){
            $google_client->setAccessToken($token['access_token']);
            $_SESSION['access_token'] = $token['access_token'];
            $google_service = new Google_Service_Oauth2($google_client);
            $data = $google_service->userinfo_v2_me->get();
            if(!empty($data['email'])){
                $email = $data['email'];
                $duplicate = duplicateCheck($email);
                if ($duplicate > 0){
                    loginAccount($email, "", 2);
                }
            }
        }
        mysqli_close($conn);    
    }


?>