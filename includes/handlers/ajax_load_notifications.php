<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Notification.php");
include("../classes/Groups.php");

$limit = 7; //Number of messages to load

$notification = new Notification($con, $_REQUEST['userLoggedIn']);
echo $notification->getNotifications($_REQUEST, $limit);

?>