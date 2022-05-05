<?php

    include ('db.php');

	if(isset($_POST['email'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$birthdate = $_POST['birthdate'];
		$password = $_POST['password'];
		$birthdate = $_POST['birthdate'];
        $uid = md5(rand());
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		
		$duplicate = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
		if (mysqli_num_rows($duplicate) > 0){
            $result_json['statusCode'] = 201;
		}
		else{
			$sql = "INSERT INTO `users`(`id`,`uid`, `firstname`, `lastname`, `email`, `password`, `birthdate`) VALUES (NULL,'$uid','$firstname','$lastname','$email','$encrypted_password', '$birthdate')";
			if (mysqli_query($conn, $sql)) {
                $result_json['statusCode'] = 200;
			} 
			else {
                $result_json['statusCode'] = 201;
			}
		}
        echo json_encode($result_json);
		mysqli_close($conn);
	}

?>