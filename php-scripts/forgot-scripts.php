<?php

//Verify email via PHPMailer
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
        $mail->Subject = 'Forum: Reset Email Verification Code';
        $mail->Body    = 'Verification Code:'. $code;
        $mail->AltBody = 'Verification Code:'. $code;

        $mail->send();
        return 200;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>