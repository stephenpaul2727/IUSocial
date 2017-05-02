<?php  
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post.php");
include("../classes/Groups.php");

$limit = 10; //Number of posts to be loaded per call

$groups = new Groups($con, $_REQUEST['userLoggedIn'], 'none');
$groups->loadUserGroups($_REQUEST, $limit);
?>