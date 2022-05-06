<?php

    include ('db.php');

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    function verifyEmail($recipient, $code){
        global $mail;
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'forum.bsit@gmail.com';                     //SMTP username
            $mail->Password   = 'forum.bsit123';                               //SMTP password
            $mail->SMTPSecure = "tls";            
            $mail->SMTPAutoTLS = false;
            $mail->Port       = 587;                                   

            //Recipients
            $mail->setFrom('forum.bsit@gmail.com', 'Forum Website');
            $mail->addAddress($recipient);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forum: Verification Code';
            $mail->Body    = 'Verification Code:'. $code;
            $mail->AltBody = 'Verification Code:'. $code;

            $mail->send();
            return 200;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

	function accountCreate($uid, $firstname, $lastname, $email, $encrypted_password, $birthdate){
		global $conn;
		$sql = "INSERT INTO `users`(`id`,`uid`, `firstname`, `lastname`, `email`, `password`, `birthdate`) VALUES (NULL,'$uid','$firstname','$lastname','$email','$encrypted_password', '$birthdate')";
		if (mysqli_query($conn, $sql)) {
			return 200;
		} else {
			return 201;
		}
	}

	if(isset($_POST['email'])){
		$email = $_POST['email'];
        $code = random_int(100000, 999999);
		
		$duplicate = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
		if (mysqli_num_rows($duplicate) > 0){
            $result_json['statusCode'] = 201;
		}
		else{
			$query = mysqli_query($conn, "SELECT email FROM users_verification WHERE email='$email'");
            if(mysqli_num_rows($query) > 0) {
                $update = mysqli_query($conn, "UPDATE users_verification SET code='$code' WHERE email='$email'");
            } else {
                $update = mysqli_query($conn, "INSERT INTO `users_verification`(`id`, `email`, `code`) VALUES (NULL,'$email', $code)");
            }	
            $result_json['statusCode'] = 200;
            if($update) {
                verifyEmail($email, $code);
            }
		}
        echo json_encode($result_json);
		mysqli_close($conn);
	}

    if(isset($_POST['verified_email'])){
        $code = $_POST['code'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['verified_email'];
		$birthdate = $_POST['birthdate'];
		$password = $_POST['password'];
        $uid = uniqid('u');
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		
        $query = mysqli_query($conn, "SELECT * FROM users_verification WHERE email='$email'");

        if(mysqli_num_rows($query)) {
            $data = mysqli_fetch_array($query);
            $db_code = $data['code'];
            if($code == $db_code){
			    $result_json['statusCode'] = accountCreate($uid, $firstname, $lastname, $email, $encrypted_password, $birthdate);
                $query = mysqli_query($conn, "DELETE FROM `users_verification` WHERE email = '$email'");			
            } else {
                $result_json['statusCode'] = 201;
            }
        }

        echo json_encode($result_json);
		mysqli_close($conn);
	}

?>