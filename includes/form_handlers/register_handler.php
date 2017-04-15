<?php
//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$title = "";
$type ="";
$date = ""; //Sign up date 
$ver_code = "";
$ver_code_user = "";
$error_array = array(); //Holds error messages

if(isset($_POST['reg_send_code_button']) || isset($_POST['register_button']) ){
	//Registration form values
	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	//$em = ucfirst(strtolower($em)); //Uppercase first letter
	$em = strtolower($em); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores email into session variable

	//email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	//$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	$em2 = strtolower($em2); //Uppercase first letter
	$_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$_SESSION['reg_pw'] = $password;
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags
	$_SESSION['reg_pw2'] = $password2;

	//Title
	$title = strip_tags($_POST['reg_title']); //Remove html tags
	// $title = str_replace(' ', '', $title); //remove spaces
	// $title = ucwords(strtolower($title)); //Uppercase first letter
	$title = strtoupper($title); //Uppercase first letter
	$_SESSION['reg_title'] = $title; //Stores last name into session variable

	//Profile Type
	$type = strip_tags($_POST['reg_type']); //Remove html tags
	$_SESSION['reg_type'] = $type; //Stores last name into session variable
	// $date = date("Y-m-d"); //Current date

	// echo "Session Var Code: ". $_SESSION['ver_code'];
}


if(isset($_POST['reg_send_code_button'])){
	// //Registration form values

	// //First name
	// $fname = strip_tags($_POST['reg_fname']); //Remove html tags
	// $fname = str_replace(' ', '', $fname); //remove spaces
	// $fname = ucfirst(strtolower($fname)); //Uppercase first letter
	// $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	// //Last name
	// $lname = strip_tags($_POST['reg_lname']); //Remove html tags
	// $lname = str_replace(' ', '', $lname); //remove spaces
	// $lname = ucfirst(strtolower($lname)); //Uppercase first letter
	// $_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	// //email
	// $em = strip_tags($_POST['reg_email']); //Remove html tags
	// $em = str_replace(' ', '', $em); //remove spaces
	// //$em = ucfirst(strtolower($em)); //Uppercase first letter
	// $em = strtolower($em); //Uppercase first letter
	// $_SESSION['reg_email'] = $em; //Stores email into session variable

	// //email 2
	// $em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	// $em2 = str_replace(' ', '', $em2); //remove spaces
	// //$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	// $em2 = strtolower($em2); //Uppercase first letter
	// $_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

	// //Password
	// $password = strip_tags($_POST['reg_password']); //Remove html tags
	// $_SESSION['reg_pw'] = $password;
	// $password2 = strip_tags($_POST['reg_password2']); //Remove html tags
	// $_SESSION['reg_pw2'] = $password2;

	// //Title
	// $title = strip_tags($_POST['reg_title']); //Remove html tags
	// // $title = str_replace(' ', '', $title); //remove spaces
	// // $title = ucwords(strtolower($title)); //Uppercase first letter
	// $title = strtoupper($title); //Uppercase first letter
	// $_SESSION['reg_title'] = $title; //Stores last name into session variable

	// //Profile Type
	// $type = strip_tags($_POST['reg_type']); //Remove html tags
	// $_SESSION['reg_type'] = $type; //Stores last name into session variable
	// $date = date("Y-m-d"); //Current date

	if($em == $em2) {
		//Check if email is in valid format 
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
			}

		}
		else {
			array_push($error_array, "Invalid email format<br>");
		}

	}
	else{
		array_push($error_array, "Emails do not match<br>");
	}


	if(strlen($fname) > 50 || strlen($fname) < 2){
		array_push($error_array, "Your first name must be between 2 and 50 characters<br>");
	}

	if(strlen($lname) > 50 || strlen($lname) < 2){
		array_push($error_array, "Your last name must be between 2 and 50 characters<br>");
	}

	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain letters or numbers<br>");
		}
	}

	if(strlen($password) > 30 || strlen($password) < 5){
		array_push($error_array, "Your password must be between 5 and 30 characters<br>");
	}

	if(strlen($title) > 20 || strlen($title) < 2){
		array_push($error_array, "Your title must be between 2 and 20 characters<br>");
	}

	// if($type!= 'Professor' || $type!='Student'){
	// 	array_push($error_array, "Please select atleast one of Professor or Student<br>");
	// }

	// echo "Error Array 1: " . $error_array;
	if(empty($error_array)) {
		// $password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$_SESSION['username'] = $username;
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}


		$ver_code = mt_rand(100000,999999);
		$_SESSION['ver_code'] = $ver_code;
		// echo "Session Var Code - Inside If: ". $_SESSION['ver_code'];
		// $ver_code = $_SESSION['ver_code'];
		//Sending mail
		$to = $em;
		$subject = "Welcome to IUSocial. Please verify your email address."; 
		
		$message = "
		<html> 
		Hello <strong>$fname</strong>,<br>
		You have just created an account on <b><i>IUSocial!</i></b>.<br>
		Please enter the below provided verification code to complete your Registration:<br>
		$ver_code

		<br><br><i>Note:</i> <br>
		The code is only valid till until you stay on the same registration page/the session expires.<br>
		Your account will not be created until you enter the verification code.<br><br>

		<strong>Thank you for creating an account!</strong><br><>

		Regards,<br>
		IUSocial Team.<br>
		</html>";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <admin@iusocial.com>' . "\r\n";

		mail($to,$subject,$message,$headers);

		array_push($error_array, "<span style='color: #14C800;'>A verification code has been sent to the provided email. Please enter it below.</span><br>");
	}
}

if(isset($_POST['register_button'])){

	// //Registration form values

	// //First name
	// $fname = strip_tags($_POST['reg_fname']); //Remove html tags
	// $fname = str_replace(' ', '', $fname); //remove spaces
	// $fname = ucfirst(strtolower($fname)); //Uppercase first letter
	// $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	// //Last name
	// $lname = strip_tags($_POST['reg_lname']); //Remove html tags
	// $lname = str_replace(' ', '', $lname); //remove spaces
	// $lname = ucfirst(strtolower($lname)); //Uppercase first letter
	// $_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	// //email
	// $em = strip_tags($_POST['reg_email']); //Remove html tags
	// $em = str_replace(' ', '', $em); //remove spaces
	// //$em = ucfirst(strtolower($em)); //Uppercase first letter
	// $em = strtolower($em); //Uppercase first letter
	// $_SESSION['reg_email'] = $em; //Stores email into session variable

	// //email 2
	// $em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	// $em2 = str_replace(' ', '', $em2); //remove spaces
	// //$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	// $em2 = strtolower($em2); //Uppercase first letter
	// $_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

	// //Password
	// $password = strip_tags($_POST['reg_password']); //Remove html tags
	// $password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	// //Title
	// $title = strip_tags($_POST['reg_title']); //Remove html tags
	// // $title = str_replace(' ', '', $title); //remove spaces
	// // $title = ucwords(strtolower($title)); //Uppercase first letter
	// $title = strtoupper($title); //Uppercase first letter
	// $_SESSION['reg_title'] = $title; //Stores last name into session variable

	// //Profile Type
	// $type = strip_tags($_POST['reg_type']); //Remove html tags
	// $_SESSION['reg_type'] = $type; //Stores last name into session variable
	// $date = date("Y-m-d"); //Current date

	// if($em == $em2) {
	// 	//Check if email is in valid format 
	// 	if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

	// 		$em = filter_var($em, FILTER_VALIDATE_EMAIL);

	// 		//Check if email already exists 
	// 		$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

	// 		//Count the number of rows returned
	// 		$num_rows = mysqli_num_rows($e_check);

	// 		if($num_rows > 0) {
	// 			array_push($error_array, "Email already in use<br>");
	// 		}

	// 	}
	// 	else {
	// 		array_push($error_array, "Invalid email format<br>");
	// 	}


	// }
	// else{
	// 	array_push($error_array, "Emails do not match<br>");
	// }


	// if(strlen($fname) > 50 || strlen($fname) < 2){
	// 	array_push($error_array, "Your first name must be between 2 and 50 characters<br>");
	// }

	// if(strlen($lname) > 50 || strlen($lname) < 2){
	// 	array_push($error_array, "Your last name must be between 2 and 50 characters<br>");
	// }

	// if($password != $password2) {
	// 	array_push($error_array,  "Your passwords do not match<br>");
	// }
	// else {
	// 	if(preg_match('/[^A-Za-z0-9]/', $password)) {
	// 		array_push($error_array, "Your password can only contain english characters or numbers<br>");
	// 	}
	// }

	// if(strlen($password) > 30 || strlen($password) < 5){
	// 	array_push($error_array, "Your password must be between 5 and 30 characters<br>");
	// }

	// if(strlen($title) > 20 || strlen($title) < 2){
	// 	array_push($error_array, "Your title must be between 2 and 20 characters<br>");
	// }

	// // if($type!= 'Professor' || $type!='Student'){
	// // 	array_push($error_array, "Please select atleast one of Professor or Student<br>");
	// // }


	// if(empty($error_array)) {
	// 	$password = md5($password); //Encrypt password before sending to database

	// 	//Generate username by concatenating first name and last name
	// 	$username = strtolower($fname . "_" . $lname);
	// 	$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


	// 	$i = 0; 
	// 	//if username exists add number to username
	// 	while(mysqli_num_rows($check_username_query) != 0) {
	// 		$i++; //Add 1 to i
	// 		$username = $username . "_" . $i;
	// 		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
	// 	}

	// 	//Profile picture assignment
	// 	$rand = rand(1, 2); //Random number between 1 and 2

	// 	if($rand == 1)
	// 		$profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
	// 	else if ($rand == 2)
	// 		$profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";

		//User-provided Verification Code 
		// echo "verification_code: " . $ver_code;
		//Declaring variables to prevent errors
		// echo "$fname" . $fname; //First name
		// echo "$lname" . $lname; //First name
		// echo "$em" . $em; //First name
		// echo "$em2" . $em2; //First name
		// echo "$password" . $password; //First name
		// echo "$password2" . $password2; //First name
		// echo "$title" . $title; //First name
		// echo "$type" . $type; //First name
		// echo "$date" . $date; //First name
		// echo "$username" . $username; //First name
		// echo "$date" . $date; //First name
		// echo "$date" . $date; //First name
		// echo "$date" . $date; //First name
		$ver_code = $_SESSION['ver_code'];
		$ver_code_user = strip_tags($_POST['register_codebox']); //Remove html tags
		// $_SESSION['ver_code_user'] = $ver_code_user; //Stores email into session variable
		if ($ver_code == $ver_code_user){
			// echo "Unhashed password" . $password;
			$password = md5($password); //Encrypt password before sending to database
			// echo "Hashed password" . $password;
			$username = $_SESSION['username'];
			$date = date("Y-m-d"); //Current date

			//Profile picture assignment
			$rand = rand(1, 2); //Random number between 1 and 2

			if($rand == 1)
				$profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
			else if ($rand == 2)
				$profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";

			$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',', '$title', '$type')");

			array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");
			//Clear session variables 
			$_SESSION['reg_fname'] = "";
			$_SESSION['reg_lname'] = "";
			$_SESSION['reg_email'] = "";
			$_SESSION['reg_email2'] = "";
			$_SESSION['reg_type'] = "";
			$_SESSION['reg_title'] = "";
			$_SESSION['reg_pw'] = "";
			$_SESSION['reg_pw2'] = "";
			$_SESSION['ver_code'] = "";
			$_SESSION['username']= "";
			//$_SESSION['ver_code_user'] ="";	
		}
		else{
			array_push($error_array, "<span style='color: #ff0000;'>Verification code did not match, please try again.</span><br>");		
		}
		

		
	// }

}
?>