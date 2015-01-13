<?php

include 'connect.php';

include 'functions.php';

$action = $_GET['action'];

$user = $_GET['user'];

$my_email = $_SESSION['email'];

if($action == 'send'){
	
	mysql_query("INSERT INTO frnd_request VALUES('', '$my_email', '$user')");

}
if($action == 'cancel'){
	
	mysql_query("DELETE FROM frnd_request WHERE user_from='$my_email' AND user_to='$user'");

}

if($action == 'accept'){
	mysql_query("DELETE FROM frnd_request WHERE user_from='$user' AND user_to='$my_email'");
	mysql_query("INSERT INTO friend_list VALUES('', '$user', '$my_email')");

}

if($action == 'unfriend'){
	
	mysql_query("DELETE FROM friend_list WHERE (user_one='$my_email' AND user_two='$user') OR (user_one='$user' AND user_two='$my_email')");

}

header ('location: profile.php?user='.$user);

?>