<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Welcome to IUSocial!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php  

	if(isset($_POST['register_button']) || isset($_POST['reg_send_code_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#third").hide();
			$("#second").show();
		});

		</script>

		';
	}

	if(isset($_POST['forgot_password_email'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#fifth").hide();
			$("#third").show();
		});

		</script>

		';
	}

	if(isset($_POST['reset_verify_code']) || isset($_POST['reset_password_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			// $("#third").hide();
			$("#fifth").show();
		});

		</script>

		';
	}


	?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
				<h1>IUSocial!</h1>
				Login or sign up below!
			</div>
			<br>
			<div id="first">

				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Password">
					<br>
					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>
					<input type="submit" name="login_button" value="Login">
					<!-- <input type="submit" id="forgot_password" name="forgot_password" value="Forgot Password"> -->
					<br>
					<a href="#" id="signup" class="signup">Need and account? Register here!</a><br>
					<a href="#" id="forgot_password" class="forgot_password">Forgot Password? Reset your password!</a>

				</form>

			</div>

			<div id="third">

				<form action="register.php" method="POST">
					<input type="email" name="fp_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['fp_email'])) {
						echo $_SESSION['fp_email'];
					} 
					?>" required>
					<br>
					<input type="submit" id="third_button" name="forgot_password_email" value="Send Code">
					<br>

					<?php if(in_array("No such email found. Please try a valid one<br>", $error_array)) echo "No such email found. Please try a valid one<br>";
					else if(in_array("<span style='color: #14C800;'>A verification code has been sent to the provided email. Please enter it below.</span><br>", $error_array)) echo "<span style='color: #14C800;'>A verification code has been sent to the provided email. Please enter it below.</span><br>"; ?>

					<input type="text" name="fp_code" placeholder="Enter Verification Code">
					<br>
					<!-- <input type="submit" id="fourth_button" name="reset_verify_code" value="Verify Code"> -->
					<input type="submit" id="fourth_button" value="Verify Code" name="<?php if(in_array("Code matched", $error_array)) echo "reset_verify_code"; ?>">
					<br>
					<?php if(in_array("<span style='color: #ff0000;'>Verification code did not match, please try again.</span><br>", $error_array)) echo "<span style='color: #ff0000;'>Verification code did not match, please try again.</span><br>"; ?>

				</form>

			</div>


			<div id="fifth">

				<form action="register.php" method="POST">
					<input type="password" name="reset_password" placeholder="New Password" required>
					<br>
					<input type="password" name="reset_password2" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
					else if(in_array("Your password can only contain letters or numbers<br>", $error_array)) echo "Your password can only contain letters or numbers<br>";
					else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>";
					else if(in_array("Your password has been reset<br>", $error_array)) echo "Your password has been reset<br>"; ?>

					<input type="submit" id="fifth_button" name="reset_password_button" value="Reset Password">
					<br>
					<?php if(in_array("<span style='color: #14C800;'>Your password has been reset! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>Your password has been reset! Go ahead and login!</span><br>"; ?>

					<a href="#" id="reset_password_login" class="signin"> Login here!</a>

				</form>

			</div>


			<div id="second">

				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your first name must be between 2 and 50 characters<br>", $error_array)) echo "Your first name must be between 2 and 50 characters<br>"; ?>
					
					


					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your last name must be between 2 and 50 characters<br>", $error_array)) echo "Your last name must be between 2 and 50 characters<br>"; ?>

					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>

					<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
					else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
					else if(in_array("Emails do not match<br>", $error_array)) echo "Emails do not match<br>"; ?>


					<input type="password" name="reg_password" placeholder="Password" value="<?php 
					if(isset($_SESSION['reg_pw'])) {
						echo $_SESSION['reg_pw'];
					} 
					?>" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" value="<?php 
					if(isset($_SESSION['reg_pw2'])) {
						echo $_SESSION['reg_pw2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
					else if(in_array("Your password can only contain letters or numbers<br>", $error_array)) echo "Your password can only contain letters or numbers<br>";
					else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>

					<input type="text" name="reg_title" placeholder="Title (eg. MS in CS, Assistant Professor, IU Alumi etc.)" value="<?php 
					if(isset($_SESSION['reg_title'])) {
						echo $_SESSION['reg_title'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your title must be between 2 and 20 characters<br>", $error_array)) echo "Your title must be between 2 and 20 characters<br>"; ?>


					<input type="radio" name="reg_type" value="Professor" <?php 
					if($_SESSION['reg_type'] == 'Professor') {
						echo checked;
					} 
					?>> Professor

					<input type="radio" name="reg_type" value="Student" <?php 
					if($_SESSION['reg_type'] == 'Student') {
						echo checked;
					} 
					?>> Student

					<!-- <input type="radio" name="reg_type" value="Professor" > Professor -->
  					<!-- <input type="radio" name="reg_type" value="Student"> Student -->
					<br>
					<?php if(in_array("Please select atleast one of Professor or Student<br>", $error_array)) echo "Please select atleast one of Professor or Student<br>"; ?>
					
					<input type="submit" name="reg_send_code_button" value="Send Code">
					<br>
					<?php if(in_array("<span style='color: #14C800;'>A verification code has been sent to the provided email. Please enter it below.</span><br>", $error_array)) echo "<span style='color: #14C800;'>A verification code has been sent to the provided email. Please enter it below.</span><br>"; ?>

					<input type="text" name="register_codebox" placeholder="Please enter verification code here">
					<br>
					<?php if(in_array("<span style='color: #ff0000;'>Verification code did not match, please try again.</span><br>", $error_array)) echo "<span style='color: #ff0000;'>Verification code did not match, please try again.</span><br>"; ?>					
					
					<input type="submit" name="register_button" value="Register">
					<br>

					<?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
					<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
				</form>
			</div>

		</div>

	</div>


</body>
</html>