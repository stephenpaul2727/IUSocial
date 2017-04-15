<?php  

// $reset_status = "disabled";
$_SESSION['reset_status'] = "disabled";

if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable 
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];

		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
		if(mysqli_num_rows($user_closed_query) == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}

		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}


}


// Forgot Password Checks
if(isset($_POST['forgot_password_email'])) {

	$email = filter_var($_POST['fp_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['fp_email'] = $email; //Store email into session variable 
	// $password = md5($_POST['log_password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 0) {
		array_push($error_array, "No such email found. Please try a valid one<br>");
	}
	else if($check_login_query == 1) {

		$reset_ver_code = mt_rand(100000,999999);
		$_SESSION['reset_ver_code'] = $reset_ver_code;

		$to = $email;
		$subject = "IUSocial - Password Reset Code."; 
		
		$message = "
		<html> 
		Hello <strong>$fname</strong>,<br>
		You have just requested for a password reset of your <i>IUSocial!</i> account.<br>
		Please enter the below provided verification code to reset your password:<br>
		$reset_ver_code

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


// Forgot Password Checks reset_verify_code
if(isset($_POST['reset_verify_code'])) {

		// $fp_email = $_SESSION['fp_email'];

		$reset_ver_code = $_SESSION['reset_ver_code'];
		$reset_ver_code_user = strip_tags($_POST['fp_code']); //Remove html tags
		// $_SESSION['ver_code_user'] = $ver_code_user; //Stores email into session variable
		if ($reset_ver_code == $reset_ver_code_user){
			array_push($error_array, "Code matched");	
			$_SESSION['reset_status'] = "";
		}
		else{
			array_push($error_array, "<span style='color: #ff0000;'>Verification code did not match, please try again.</span><br>");
		}
}


// Forgot Password Checks reset_verify_code
if(isset($_POST['reset_password_button'])) {

		$fp_email = $_SESSION['fp_email'];
		$reset_password = strip_tags($_POST['reset_password']);
		$reset_password2 =strip_tags($_POST['reset_password2']);


		if($reset_password == $reset_password2) {
			$reset_password = md5($reset_password); //Encrypt password before sending to database
			$query = mysqli_query($con, "UPDATE users SET password='$reset_password' WHERE email='$fp_email'");
			array_push($error_array, "<span style='color: #14C800;'>Your password has been reset! Go ahead and login!</span><br>");
		}
		else {
			array_push($error_array,  "Your new passwords do not match<br>");
			if(preg_match('/[^A-Za-z0-9]/', $reset_password)) {
				array_push($error_array, "Your new password can only contain letters or numbers<br>");
			}
		}

		if(strlen($reset_password) > 30 || strlen($reset_password) < 5){
			array_push($error_array, "Your new password must be between 5 and 30 characters<br>");
		}

}

?>