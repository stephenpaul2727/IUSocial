<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<div class="user_details column">
		<a href="<?php echo "profile.php?profile_username=".$userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo "profile.php?profile_username=".$userLoggedIn; ?>" style="text-align:center;font-size: 17px;font-weight: bold;">
			<?php echo $user['first_name'] . " " . $user['last_name'];?>
			</a>
			<br><br/>
			<?php echo "<b>Title:</b><br> " . $user['title']. "<br>"; 
			echo "<br><b>About:</b><br> " . $user['about'];

			?>
		</div>

	</div>

<div class="main_column column">

	<h4><b>Account Settings</b></h4>
	<?php
	echo "<img src='" . $user['profile_pic'] ."' class='small_profile_pic'>";
	?>
	<br>
	<a href="upload.php">Upload new profile picture</a> <br><br><br>

	<b>Modify the values and click 'Update Details'</b><br>

	<?php
	$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email, title, about, project FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	$title = $row['title'];
	$about = $row['about'];
	$project = $row['project'];
	?>

	<form action="settings.php" method="POST">
		First Name: <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input"><br>
		Last Name: <input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_input"><br>
		Email: <input type="text" name="email" value="<?php echo $email; ?>" id="settings_input"><br>
		Title:<input type="text" name="title" value="<?php echo $title; ?>" id="settings_input"><br>
		About:<br>
		<textarea rows="4" cols="35" name="about" placeholder="Enter text here..."><?php echo $about; ?></textarea>
		<br>
		Project:<br>
		<textarea rows="4" cols="35" name="project" placeholder="Enter text here..."><?php echo $project; ?></textarea>
		<?php echo $message; ?>
		<br>
		<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit"><br>
	</form>

	<h4><b>Change Password</b></h4>
	<form action="settings.php" method="POST">
		Old Password: <input type="password" name="old_password" id="settings_input"><br>
		New Password: <input type="password" name="new_password_1" id="settings_input"><br>
		New Password Again: <input type="password" name="new_password_2" id="settings_input"><br>

		<?php echo $password_message; ?>

		<input type="submit" name="update_password" id="save_details" value="Update Password" class="info settings_submit"><br>
	</form>

	<h4><b>Close Account</b></h4>
	<form action="settings.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Close Account" class="danger settings_submit">
	</form>


</div>
