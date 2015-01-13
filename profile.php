<?php
session_start();
?>
<html>
<head>
<title>Profile - myGym </title>
<link rel ='stylesheet' href='style.css' />
<head>
<body>
<?php include 'connect.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'header.php'; ?>

<div class='container'>
<?php 
if(isset($_GET['user']) && !empty($_GET['user'])){
	$user = $_GET['user'];
	}
	else{
		$user = $_SESSION['email'];
	}
	$my_email = $_SESSION['email'];
	$username = getuser($user, 'email');
	$weight = getuser($user, 'weight');
	$inches = getuser($user, 'height');
	$height = floor($inches/12)."ft ".($inches%12)."in";
	$gender = getuser($user, 'gender');
	$location = getuser($user, 'location');
?>
<h3><?php echo "Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$username ?></h3>
<h3><?php echo "Height: &nbsp;&nbsp;&nbsp;&nbsp;".$height?></h3>
<h3><?php echo "Weight: &nbsp;&nbsp;&nbsp;".$weight?></h3>
<h3><?php echo "Gender: &nbsp;&nbsp;&nbsp;".$gender ?></h3>
<h3><?php echo "Location: &nbsp;".$location ?></h3>
<?php
if($username != $my_email){
	$check_frnd_query = mysql_query("SELECT id FROM friend_list WHERE (user_one='$my_email' AND user_two='$user')OR(user_one='$user' AND user_two='$my_email') "); 
	if(mysql_num_rows($check_frnd_query) == 1){
		echo "<a href='#' class='box'>Already Friends - Unfriend</a> | <a href='actions.php?action=unfriend&user=$user' class='box'>Unfriend $username</a>";
	}
	else{
		$from_query = mysql_query("SELECT id FROM frnd_request WHERE user_from = '$user' AND user_to='$my_email'");
		$to_query = mysql_query("SELECT id FROM frnd_request WHERE user_from = '$my_email' AND user_to='$user'");
		
	if(mysql_num_rows($from_query) == 1){
		echo "<a href='' class='box'>Ignore</a> | <a href='actions.php?action=accept&user=$user' class='box'>Accept</a>";	
	
	}
	else if(mysql_num_rows($to_query) == 1){
		echo "<a href='actions.php?action=cancel&user=$user' class='box'>Cancel Request</a>";
	
	}
	else{
		echo "<a href='actions.php?action=send&user=$user' class='box'>Send Friend Request</a>";
	}
	
	
		
		
	}
}
?>




</div>

</body>
</html>