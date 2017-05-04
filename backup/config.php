<?php
ob_start(); //Turns on output buffering 
session_start();

$timezone = date_default_timezone_set("America/Indiana/Indianapolis");

$con = mysqli_connect("db.soic.indiana.edu", "i308s17_rrsampat", "my+sql=i308s17_rrsampat", "i308s17_rrsampat"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
 

?>
