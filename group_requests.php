<?php
include("includes/header.php"); //Header 
?>

<div class="main_column column" id="main_column">

	<h4>Group Requests</h4>

	<?php  

	$query = mysqli_query($con, "SELECT * FROM groups_request WHERE group_owner='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "You have no member requests for any of your groups at this time!";
	else {

		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['user_from'];
			$group_name = $row['group_to'];
			$user_from_obj = new User($con, $user_from);


			echo $user_from_obj->getFirstAndLastName() . " requested to join " . $group_name ."!";

			$user_from_friend_array = $user_from_obj->getFriendArray();

			if(isset($_POST['accept_request' . $user_from ])) {
				$add_friend_query = mysqli_query($con, "UPDATE groups SET users_array=CONCAT(users_array, '$user_from,'), num_users = num_users+1  WHERE group_name='$group_name'");

				$delete_query = mysqli_query($con, "DELETE FROM groups_request WHERE group_to='$group_name' AND user_from='$user_from'");
				// echo "You are now friends!";
				echo $user_from_obj->getFirstAndLastName() . " has been added to " . $group_name ."!";
				header("Location: group_requests.php");
			}

			if(isset($_POST['ignore_request' . $user_from ])) {
				$delete_query = mysqli_query($con, "DELETE FROM groups_request WHERE group_to='$group_name' AND user_from='$user_from'");
				echo "Request ignored!";
				header("Location: group_requests.php");
			}

			?>
			<form action="group_requests.php" method="POST">
				<input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept">
				<input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
			</form>
			<?php


		}

	}

	?>


</div>