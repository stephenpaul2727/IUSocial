<?php 
include("includes/header.php");

// $message_obj = new Message($con, $userLoggedIn);

// if(isset($_GET['u']))
// 	$user_to = $_GET['u'];
// else {
// 	$user_to = $message_obj->getMostRecentUser();
// 	if($user_to == false)
// 		$user_to = 'new';
// }

// if($user_to != "new")
// 	$user_to_obj = new User($con, $user_to);

// if(isset($_POST['post_message'])) {

// 	if(isset($_POST['message_body'])) {
// 		$body = mysqli_real_escape_string($con, $_POST['message_body']);
// 		$date = date("Y-m-d H:i:s");
// 		$message_obj->sendMessage($user_to, $body, $date);
// 	}

// }

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

	<div class="main_group_column column" id="main_column">
		<div style = "text-align: center" >
		<input type='submit' name='post_message' class='black-background danger' id='create_group' data-toggle="modal" data-target="#create_group_div" value='Create New Group'>
		</div>
	</div>

	<div class="modal fade" id="create_group_div" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title" id="postModalLabel"><b>Create New Group!</b></h3>
	      </div>

	      <div class="modal-body">

	      	<form class="create_group_form" action="" method="POST">
	      		<div class="form-group" style="margin-top: -88px">
	      		<table class = "tg" border="0">
	      			<tr><td class="tg-9hbo"><h4>Name: </h4></td> 
	      			<td class="tg-yw4l"><input class="tg_creategroup" type="text" name="group_name" placeholder="Group Name" required></td></tr>
					<br><br>
					<tr><td class="tg-9hbo"><h4>About: </h4></td>
	      			<td class="tg-yw4l"><textarea class="tg_creategroup" name="group_about" placeholder="Group About" style="min-height: 100px;" required></textarea></td></tr>
					<br><br>
					<tr><td class="tg-9hbo"><h4>Closed: </h4></td>
					<td class="tg-yw4l">
					<select name="group_closed" class="tg_creategroup" required>
						<option value = "yes">Yes</option>
						<option value = "no">No</option>
					</select>
					</td></tr>
					<br><br>
					<tr><td class="tg-9hbo"><h4>Genre: </h4></td>
					<td><select name="group_genre" class="tg_creategroup" required>
						<option value = "Course">Course</option>
						<option value = "Research">Research</option>
						<option value = "Cultural">Cultural</option>
						<option value = "Sports">Sports</option>
						<option value = "Clubs">Clubs</option>
						<option value = "Events">Events</option>
					</select></td></tr>
					<br>
				</table>
					<!-- <textarea class="form-control" name="post_body"></textarea> -->
	      			<input type="hidden" name="group_owner" value="<?php echo $userLoggedIn; ?>">
	      			<!-- <input type="hidden" name="user_to" value="<?php echo $username; ?>"> -->
	      		</div>
	      	</form>
	      </div>


	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="black-background danger" name="post_button" id="submit_create_group">Create Group</button>
	      </div>
		</div>
	  </div>
	</div>
	<br>
	
	<div class="main_column column" id="main_column">
		<div style = "text-align: center" >
		<p><h3>All Groups</h3></p>
		<hr>
		<div class="groups_area">
			<!-- <div class='status_post'>
				<span class='group_profile_pic left_group' onClick='group.php?groupname=""'>
					<a href="group.php?groupname=""><img src='assets/images/group_pics/Group-icon.png' width='50'>Sample Group Name 1</a>
				</span>
				<span class='group_profile_pic right_group' onClick='group.php?groupname=""'>
					<a href="group.php?groupname=""><img src='assets/images/group_pics/Group-icon.png' width='50'>Sample Group Name 2
					</a>
				</span>
			</div> -->
		</div>
		<img id="loading" src="assets/images/icons/loading.gif">
	</div>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_groups.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.groups_area').html(data);
			}
		});

		$(window).scroll(function() {
			var height = $('.groups_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.groups_area').find('.nextPage').val();
			var noMoreGroups = $('.groups_area').find('.noMoreGroups').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMoreGroups == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_groups.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.groups_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.groups_area').find('.noMoreGroups').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.groups_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>
	

</body>
</html>
