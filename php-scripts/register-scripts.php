<?php

    include ('db.php');

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'vendor/autoload.php';

    $google_client = new Google_Client();
    $google_client->setClientId('19064399980-57o0n2utlfolf736ler29oq4up435mvq.apps.googleusercontent.com');
    $google_client->setClientSecret('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');
    $google_client->setRedirectUri('http://localhost/register.php');
    $google_client->addScope('email');
    $google_client->addScope('profile');

    session_start();
    if(isset($_SESSION['uid'])){
        header('location: ../home.php');
    }

    $mail = new PHPMailer(true);

    //Verify email via PHPMailer
    function verifyEmail($recipient, $code){
        global $mail;
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'forum.bsit@gmail.com';                     //SMTP username
            $mail->Password   = 'ikpltsgpfjtzsoun';     //forum.bsit123                          //SMTP password
            $mail->SMTPSecure = "tls";            
            $mail->SMTPAutoTLS = false;
            $mail->Port       = 587;                                   

            //Recipients
            $mail->setFrom('forum.bsit@gmail.com', 'Forum Website');
            $mail->addAddress($recipient);     //Add a recipient

            //Email Content
            $email_template = 'email/code-register-email.html';
            $mail->AddEmbeddedImage('../assets/images/email-verification.png', 'verifyimg');
            $message = file_get_contents($email_template);
            $message = str_replace('%code%', $code, $message);
            $message = str_replace('%text%', 'Almost there! Enter the verification code below to continue. Thank you!', $message);
            //Content
            $mail->isHTML(true);   
            $mail->MsgHTML($message);                               //Set email format to HTML
            $mail->Subject = 'Forum: Verification Code';
            
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


    function duplicateCheck($email){
        global $conn;
        $stat = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
        return mysqli_num_rows($stat);
    }


    //Function that will add the account to the database.
	function accountCreate($uid, $firstname, $lastname, $email, $encrypted_password, $birthdate, $avatar){
		global $conn;
		$sql = "INSERT INTO `users`(`id`,`uid`, `firstname`, `lastname`, `email`, `password`, `birthdate`, `avatar`) VALUES (NULL,'$uid','$firstname','$lastname','$email','$encrypted_password', '$birthdate', '$avatar')";
		if (mysqli_query($conn, $sql)) {
			return 200;
		} else {
			return 201;
		}
	}

    //If an email wass posted, the function will generate a verification code in the database.
	if(isset($_POST['email'])){
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $code = random_int(100000, 999999);
		
		$duplicate = duplicateCheck($email); 
		if ($duplicate > 0){
            $result_json['statusCode'] = 201;
		} else {
			$query = mysqli_query($conn, "SELECT email FROM users_verification WHERE email='$email'");
            if($query) {
                $update = mysqli_query($conn, "UPDATE users_verification SET code='$code' WHERE email='$email'");
            } else {
                $update = mysqli_query($conn, "INSERT INTO `users_verification`(`id`, `email`, `code`) VALUES (NULL,'$email', $code)");
            }	
            if($update) {
                $result_json['statusCode'] = 200;
                verifyEmail($email, $code);
            }
		}
        echo json_encode($result_json);
		mysqli_close($conn);
	}

    //If the user's code and database code match, the function will proceed to the create account function.
    if(isset($_POST['verified_email'])){
        global $conn;
        $code = mysqli_real_escape_string($conn, $_POST['code']);
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$email = mysqli_real_escape_string($conn, $_POST['verified_email']);
		$birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
        $uid = uniqid('u');
        $avatar = "assets/images/avatar/default.jpg";
        $encrypted_password = md5($password);
		
        $query = mysqli_query($conn, "SELECT * FROM users_verification WHERE email='$email'");

        if(mysqli_num_rows($query)) {
            $data = mysqli_fetch_array($query);
            $db_code = $data['code'];
            if($code == $db_code){
			    $result_json['statusCode'] = accountCreate($uid, $firstname, $lastname, $email, $encrypted_password, $birthdate, $avatar);
                mysqli_query($conn, "DELETE FROM `users_verification` WHERE email = '$email'");			
            } else {
                $result_json['statusCode'] = 201;
            }
        }

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
            if(!empty($data['given_name'])){
                $email = $data['email'];
                $duplicate = duplicateCheck($email);
                if ($duplicate == 0){
                    $uid = uniqid('u');
                    $firstname = $data['given_name'];
                    $lastname = $data['family_name'];
                    $avatar = $data['picture']; 
                    accountCreate($uid, $firstname, $lastname, $email, "", "", $avatar);
                    mysqli_close($conn);
                    header('Location: ../login.php');
                }
            }
        }
    }

?>