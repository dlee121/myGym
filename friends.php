<?php
session_start();
?>
<html>
<head>
<title>Friends - myGym </title>
<link rel ='stylesheet' href='style.css' />
<head>
<body>
<?php include 'connect.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'header.php'; ?>

<div class='container'>
<h3>Friends : </h3>

<?php

	$my_email = $_SESSION['email'];
	$friend_query = mysql_query("SELECT user_one, user_two FROM friend_list WHERE (user_one='$my_email' OR user_two = '$my_email') ");
		while($run_friend = mysql_fetch_array($friend_query)){
			$user_one = $run_friend['user_one'];
			$user_two = $run_friend['user_two'];
			if($user_one == $my_email){
				$user = $user_two;
			}
			else{
				$user = $user_one;
			}
	
			$username = getuser($user, 'Email');
						
			
			echo "<a href='profile.php?user=$user'class='box'style='display:block'>$username</a>";
		}
	?>


</div>


</body>
</html>