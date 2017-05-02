<?php
class Groups {
	private $user_obj;
	private $group;
	private $con;
	private $users_array;
	// private $group_owner;

	public function __construct($con, $user, $groupname){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
		$this->users_array = $this->user_obj->getUserArray();
		if ($groupname != 'none'){
			$group_details_query = mysqli_query($con, "SELECT * FROM groups WHERE group_name='$groupname'");
			$this->group = mysqli_fetch_array($group_details_query);
			// $this->group_owner = $this->group['group_owner'];
		}
	}

	public function createGroup($groupName, $groupAbout, $groupClosed, $groupGenre) {
		$groupName = strip_tags($groupName); //removes html tags 
		$groupName = mysqli_real_escape_string($this->con, $groupName);
		$groupAbout = strip_tags($groupAbout); //removes html tags 
		$groupAbout = mysqli_real_escape_string($this->con, $groupAbout);
		$check_empty = preg_replace('/\s+/', '', $groupName); //Deletes all spaces 
      	
		if($check_empty != "") {


			//Current date and time
			$date_added = date("Y-m-d H:i:s");
			//Get username
			$added_by = $this->user_obj->getUsername();
			//Default Group Pic
			$groupPic = "assets/images/group_pics/Group-icon.png";

			$usersArray = ",".$added_by.",";
			$deleted = "no";

			//insert post 
			$query = mysqli_query($this->con, "INSERT INTO groups VALUES('', '$groupName', '$added_by', '$date_added', '$groupPic', 0, 1, '$usersArray', '$groupClosed', '$groupAbout', '$groupGenre', '$deleted')");
			$returned_id = mysqli_insert_id($this->con);

			
			// //Insert notification
			// if($user_to != 'none') {
			// 	$notification = new Notification($this->con, $added_by);
			// 	$notification->insertNotification($returned_id, $user_to, "like");
			// }

			//Update post count for user 
			// $num_posts = $this->user_obj->getNumPosts();
			// $num_posts++;
			// $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");

		}
	}
	
	public function loadUserGroups($data, $limit) {

		$page = $data['page']; 
		$userLoggedIn = $this->user_obj->getUsername();

		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;


		$str = ""; //String to return 
		// $data_query = mysqli_query($this->con, "SELECT * FROM groups WHERE deleted='no' AND users_array LIKE '%$userLoggedIn%' ORDER BY gid DESC");
		if ($this->users_array['type'] == 'Student')
			$data_query = mysqli_query($this->con, "SELECT * FROM groups WHERE deleted='no' ORDER BY gid DESC");
		else
			$data_query = mysqli_query($this->con, "SELECT * FROM groups WHERE deleted='no' AND group_name <> 'IU_Global_Forum' ORDER BY gid DESC");
		if(mysqli_num_rows($data_query) > 0) {

			$num_iterations = 0; //Number of results checked (not necessarily posted)
			$count = 1;

			while($row1 = mysqli_fetch_array($data_query)) {
				if($num_iterations++ < $start)
						continue; 

					//Once 20 groups have been loaded, break
					if($count > $limit) {
						break;
					}
					else {
						$count++;
					}
				
				$id1 = $row1['gid'];
				$groupName1 = $row1['group_name'];
				$groupPic1 = $row1['group_pic'];
				// $groupOwner1 = $row1['group_owner'];
				$groupName1 = urldecode($groupName1);
				$groupName1 = strip_tags($groupName1);//removes html tags 
				$groupName1 = mysqli_real_escape_string($this->con, $groupName1);
				$groupName1Display = str_replace('_', ' ', $groupName1);//replace underscores

				$groupPic1 = urldecode($groupPic1);
				$groupPic1 = strip_tags($groupPic1); //removes html tags 
				$groupPic1 = mysqli_real_escape_string($this->con, $groupPic1);

				if ($row2 = mysqli_fetch_array($data_query)){
					$id2 = $row2['gid'];
					$groupName2 = $row2['group_name'];
					$groupPic2 = $row2['group_pic'];
					// $groupOwner2 = $row2['group_owner'];
					$groupName2 = urldecode($groupName2);
					$groupName2 = strip_tags($groupName2); //removes html tags 
					$groupName2 = mysqli_real_escape_string($this->con, $groupName2);
					$groupName2Display = str_replace('_', ' ', $groupName2);//replace underscores
				
					$groupPic2 = urldecode($groupPic2);
					$groupPic2 = strip_tags($groupPic2); //removes html tags 
					$groupPic2 = mysqli_real_escape_string($this->con, $groupPic2);

					$str .= "<div class='status_post'>
						<span class='group_profile_pic left_group'>
							<a href='group.php?group_name=$groupName1'><img src='$groupPic1' width='50'>$groupName1Display</a>
						</span>
						<span class='group_profile_pic right_group'>
							<a href='group.php?group_name=$groupName2'><img src='$groupPic2' width='50'>$groupName2Display</a>
						</span>
					</div>
					<hr>";
				}
				else{
					$str .= "<div class='status_post'>
						<span class='group_profile_pic left_group'>
							<a href='group.php?group_name=$groupName1'><img src='$groupPic1' width='50'>$groupName1Display</a>
						</span>
					</div>
					<hr>";
				}
					// if($userLoggedIn == $added_by)
					// 	$delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
					// else 
					// 	$delete_button = "";
				?>
				<?php

			} //End while loop

			if($count > $limit) 
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMoreGroups' value='false'>";
			else 
				$str .= "<input type='hidden' class='noMoreGroups' value='true'><p style='text-align: centre;'> No more groups to show! </p>";
		}

		echo $str;


	}

	public function isMember() {
		$username_to_check = $this->users_array['username'];
		$usernameComma = "," . $username_to_check . ",";
		if((strstr($this->group['users_array'], $usernameComma) || $username_to_check == $this->group['group_owner'])) {
			return true;
		}
		else {
			return false;
		}
	}

	public function sendRequest() {
		$user_from = $this->users_array['username'];
		$group_to = $this->group['group_name'];
		$group_owner = $this->group['group_owner'];
		$isGroupClosed = $this->group['closed_group'];
		if ($isGroupClosed=='no'){
			$add_friend_query = mysqli_query($this->con, "UPDATE groups SET users_array=CONCAT(users_array, '$user_from,'), num_users = num_users+1  WHERE group_name='$group_to'");
		}
		else{
			$query = mysqli_query($this->con, "INSERT INTO groups_request VALUES('', '$user_from', '$group_to', '$group_owner')");
		}
	}

	public function didSendRequest() {
		$user_from = $this->users_array['username'];
		$group_to = $this->group['group_name'];
		$check_request_query = mysqli_query($this->con, "SELECT * FROM groups_request WHERE group_to='$group_to' AND user_from='$user_from'");
		if(mysqli_num_rows($check_request_query) > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	public function isDeleted() {
		$username = $this->users_array['username'];
		$group_name = $this->group['group_name'];
		$query = mysqli_query($this->con, "SELECT deleted FROM groups WHERE group_name='$group_name'");
		$row = mysqli_fetch_array($query);

		if($row['deleted'] == 'yes')
			return true;
		else 
			return false;
	}

	public function hasNoPermission() {
		$username = $this->users_array['username'];
		$type = $this->users_array['type'];
		$group_name = $this->group['group_name'];
		// $query = mysqli_query($this->con, "SELECT deleted FROM groups WHERE group_name='$group_name'");
		// $row = mysqli_fetch_array($query);

		if (($group_name == "IU_Global_Forum") && ($type == 'Professor'))
			return true;
		else 
			return false;
	}

	public function getMutualFriends() {
		$mutualFriends = 0;
		$user_array = $this->users_array['friend_array'];
		$user_array_explode = explode(",", $user_array);

		$group_array = $this->group['users_array'];
		$group_array_explode = explode(",", $group_array);

		foreach($user_array_explode as $i) {

			foreach($group_array_explode as $j) {

				if($i == $j && $i != "") {
					$mutualFriends++;
				}
			}
		}
		return $mutualFriends;

	}

	public function getGroupName() {
		$group_name = $this->group['group_name'];
		$group_name = str_replace('_', ' ', $group_name);
		return $group_name;
	}

	public function removeMember() {
		$user_to_remove = $this->users_array['username'];
		$group_name = $this->group['group_name'];
		$users_array = $this->group['users_array'];

		$new_users_array = str_replace($user_to_remove . ",", "", $users_array);
		$remove_friend = mysqli_query($this->con, "UPDATE groups SET users_array='$new_users_array', num_users = num_users-1 WHERE group_name='$group_name'");
	}

	public function getNumberOfGroupRequests() {
		$username = $this->users_array['username'];
		$query = mysqli_query($this->con, "SELECT * FROM groups_request WHERE group_owner='$username'");
		return mysqli_num_rows($query);
	}

	public function deleteGroup() {
		// $user_to_remove = $this->users_array['username'];
		$group_name = $this->group['group_name'];
		$delete_group = mysqli_query($this->con, "UPDATE groups SET deleted = 'yes' WHERE group_name='$group_name'");
	}

	public function getMembersList() {
		$group_name = $this->group['group_name'];
		$userLoggedIn = $this->users_array['username'];
		$return_string = "";
		$convos = array();

		// $query = mysqli_query($this->con, "SELECT friend_array FROM users WHERE username='$userProfile' ORDER BY id DESC");

		// $row = mysqli_fetch_array($query)
		// $pieces = explode(" ", $row['friend_array']);
		$convos = explode(",", $this->group['users_array']);

		foreach($convos as $username) {
			if ($username !='' && $username != $userLoggedIn){
				$user_found_obj = new User($this->con, $username);

				$return_string .= "<div class='row friendsDisplay'>
					<a href='profile.php?profile_username=" . $username. "' style='color: #1485BD'>
						<div class='col-md-3 friendListProfilePic'>
							<img src='" . $user_found_obj->getProfilePic() ."'>
						</div>

						<div class='col-md-6 friendNameDisplay'>
							" . $user_found_obj->getFirstAndLastName() . "
						</div>
					</a>
					</div>";



				// $return_string .= "<a href='profile.php?profile_username='" . $username. "><div class='user_found_messages'>
				// 					<img src='" . $user_found_obj->getProfilePic() . "' style='border-radius: 5px; margin-right: 5px;'>
				// 					" . $user_found_obj->getFirstAndLastName() . "
				// 					</div>
				// 					</a><hr><br>";
			}
		}

		return $return_string;

	}

}

?>