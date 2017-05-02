<?php  
require '../../config/config.php';
include("../classes/User.php");
include("../classes/Post.php");
include("../classes/Notification.php");
include("../classes/Groups.php");


if(isset($_POST['group_name']) && isset($_POST['group_about']) && isset($_POST['group_closed']) && isset($_POST['group_genre'])) {
	$group = new Groups($con, $_POST['group_owner'], 'none');
	$group->createGroup($_POST['group_name'], $_POST['group_about'], $_POST['group_closed'], $_POST['group_genre']);
}

// $group = new Groups($con, $_POST['group_owner']);
// $group->submitPost($_POST['group_about'], $_POST['group_name']);
// $post = new Post($con, $_POST['group_owner']);
// $post->createGroup($_POST['group_name'], $_POST['group_about'], $_POST['group_closed'], $_POST['group_genre']);
// $post->submitPost($_POST['group_name'], $_POST['group_owner']);
	
?>