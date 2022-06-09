<?php
include('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
session_start();
$mail = new PHPMailer(true);

//Verify email via PHPMailer
function verifyEmail($recipient, $token){
    global $mail;
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'forum.bsit@gmail.com';                     //SMTP username
        $mail->Password   = 'ikpltsgpfjtzsoun'; //forum.bsit123                              //SMTP password
        $mail->SMTPSecure = "tls";            
        $mail->SMTPAutoTLS = false;
        $mail->Port       = 587;                                   

        //Recipients
        $mail->setFrom('forum.bsit@gmail.com', 'Forum Website');
        $mail->addAddress($recipient);     //Add a recipient
        $link = $_SERVER['SERVER_NAME'];
        //Content
        $token_link = $link . "/forgot.php?token=" . $token;
        $email_template = 'email/verification-forgot-email.html';
        $mail->AddEmbeddedImage('../assets/images/forgot-2.png', 'resetimg');
        $message = file_get_contents($email_template);
        $message = str_replace('%link%', $token_link, $message);
        $message = str_replace('%text%', 'Almost there! Press the button below to reset your password. Thank you!', $message);
        //Content
        $mail->isHTML(true);   
        $mail->Subject = 'Forum: Reset Account Password';
        $mail->MsgHTML($message);                               //Set email format to HTML

        $mail->send();
        return 200;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function duplicateCheck($email){
    global $conn;
    $stat = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    return mysqli_num_rows($stat);
}

if(isset($_SESSION['uid'])){
    header('location: ../home.php');
}

if(isset($_GET['token'])){
    $query = mysqli_query($conn, "SELECT * FROM users_verification WHERE token='{$_GET['token']}'");
    $data = mysqli_fetch_array($query);
    if(!$data){
        header("location: ../404.php");
    }
}

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $duplicate = duplicateCheck($email); 
    $token = md5(microtime(true).mt_Rand());
    if ($duplicate == 0){
        $result_json['statusCode'] = 201;
    } else {
        $query = mysqli_query($conn, "SELECT email FROM users_verification WHERE email='$email'");
        if(mysqli_num_rows($query) > 0) {
            $update = mysqli_query($conn, "UPDATE users_verification SET token='$token' WHERE email='$email'");
        } else {
            $update = mysqli_query($conn, "INSERT INTO `users_verification`(`id`, `email`, `code`, `token`) VALUES (NULL,'$email', 000000, '$token')");
        }	
        $result_json['statusCode'] = 200;
        if($update) {
            verifyEmail($email, $token);
        }
    }
    echo json_encode($result_json);
    mysqli_close($conn);
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
    $token = $_POST['token'];
    $encrypted_password = md5($password);

    $query = mysqli_query($conn, "SELECT email FROM users_verification WHERE token='$token'");
    $data = mysqli_fetch_array($query);
    $email = $data['email'];

    $update = mysqli_query($conn, "UPDATE users SET password='$encrypted_password' WHERE email='$email'");
    if ($update){
        $result_json['statusCode'] = 200;
        mysqli_query($conn, "DELETE FROM users_verification WHERE email='$email' AND token='$token'");
    } else {
        $result_json['statusCode'] = 201;
    }
    echo json_encode($result_json);
    mysqli_close($conn);
}

?>