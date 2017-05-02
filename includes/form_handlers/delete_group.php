<?php 
require '../../config/config.php';
	
	if(isset($_GET['group_name']))
		$group_name = $_GET['group_name'];

	if(isset($_POST['result'])) {
		if($_POST['result'] == 'true')
			$query = mysqli_query($con, "UPDATE groups SET deleted = 'yes' WHERE group_name='$group_name'");
	}

?>