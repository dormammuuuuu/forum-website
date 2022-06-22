<?php

    include('db.php');

    session_start();

    if(!isset($_SESSION['uid'])){
        header('Location: login.php');
    }
    
    if (isset($_POST['fetch_data'])) {
        $uid = $_SESSION['uid'];
        $query = "SELECT * FROM users WHERE uid = '$uid'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $data = array(
            'uid' => $row['uid'],
            'fname' => $row['firstname'],
            'lname' => $row['lastname'],
            'email' => $row['email'],
            'avatar' => $row['avatar'],
            'cover' => $row['cover'],
            'birthdate' => $row['birthdate'],
            'campus' => $row['campus'],
            'bio' => $row['bio']
        );

        echo json_encode($data);
        mysqli_close($conn);
    }

    if(isset($_POST['acct_details'])){
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $bdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
        $campus = mysqli_real_escape_string($conn, $_POST['campus']);

        $query = "UPDATE users SET firstname = '$fname', lastname = '$lname', birthdate = '$bdate', campus = '$campus' WHERE uid = '$uid'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $result_json['statusCode'] = 200;
        } else {
            $result_json['statusCode'] = 201;
        }

        echo json_encode($result_json);
        mysqli_close($conn);
    }

    if(isset($_FILES['profile_pic']['name'])){
        $file = $_FILES['profile_pic']['name'];
        $location = "../assets/images/avatar/";
        $uploadok = 1;
        $imageFileType = pathinfo($file, PATHINFO_EXTENSION);
        $filename = $_SESSION['uid'] . '.' . $imageFileType;
        $valid_extensions = array('jpg', 'jpeg', 'png');
        if (!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadok = 0;
        }
        if ($uploadok == 0) {
            echo 0;
        } else {
            foreach ($valid_extensions as $ext) {
                $tmp_filename = $location.$_SESSION['uid'] . '.' . $ext;
                if (file_exists($tmp_filename)) {
                    unlink($tmp_filename);
                }
            }
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $location . $filename)) {
                $query = mysqli_query($conn, "UPDATE users SET avatar = '$location$filename' WHERE uid = '{$_SESSION['uid']}'");
                echo $location . $filename;
            } else {
                echo 0;
            }
        }
    }

    if(isset($_FILES['profile_cover']['name'])){
        $file = $_FILES['profile_cover']['name'];
        $location = "../assets/images/avatar/";
        $uploadok = 1;
        $imageFileType = pathinfo($file, PATHINFO_EXTENSION);
        $filename = $_SESSION['uid'] . '-cover.' . $imageFileType;
        $valid_extensions = array('jpg', 'jpeg', 'png');
        if (!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadok = 0;
        }
        if ($uploadok == 0) {
            echo 0;
        } else {
            foreach ($valid_extensions as $ext) {
                $tmp_filename = $location.$_SESSION['uid'] . '-cover.' . $ext;
                if (file_exists($tmp_filename)) {
                    unlink($tmp_filename);
                }
            }
            if (move_uploaded_file($_FILES['profile_cover']['tmp_name'], $location . $filename)) {
                $query = mysqli_query($conn, "UPDATE users SET cover = '$location$filename' WHERE uid = '{$_SESSION['uid']}'");
                echo $location . $filename;
            } else {
                echo 0;
            }
        }
    }

    if(isset($_POST['biofield'])){
        $bio = mysqli_real_escape_string($conn, $_POST['biofield']);
        $query = mysqli_query($conn, "UPDATE users SET bio = '$bio' WHERE uid = '{$_SESSION['uid']}'");
        if($query){
            $result_json['statusCode'] = 200;
        } else {
            $result_json['statusCode'] = 201;
        }
        echo json_encode($result_json);
        mysqli_close($conn);
    }

    if(isset($_POST['new_password'])){
        $password = md5(mysqli_real_escape_string($conn, $_POST['old_password']));
        $new_password = md5(mysqli_real_escape_string($conn, $_POST['new_password']));
        $query = mysqli_query($conn, "SELECT password FROM users WHERE uid = '{$_SESSION['uid']}'");
        $query = mysqli_fetch_assoc($query);
        $old_password = $query['password'];

        if ($password != $old_password){
            $result_json['message'] = "Incorrect old password";
            $result_json['statusCode'] = 201;      
        } else {
            if ($new_password == $old_password){
                $result_json['message'] = "New password cannot be the same as the old password.";
                $result_json['statusCode'] = 201;      
            } else {
                $query = mysqli_query($conn, "UPDATE users SET password = '$new_password' WHERE uid = '{$_SESSION['uid']}'");
                if($query){
                    $result_json['statusCode'] = 200;
                    $result_json['message'] = "Password successfully changed.";
                } else {
                    $result_json['statusCode'] = 201;
                    $result_json['message'] = "Password change failed.";
                }
            }
        }
        echo json_encode($result_json);
        mysqli_close($conn);
    }
?> 