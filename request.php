<?php
session_start();
?>
<html>
<head>
<title>Request - myGym </title>
<link rel ='stylesheet' href='style.css' />
<head>
<body>
<?php include 'connect.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'header.php'; ?>

<div class='container'>
<h3>Request : </h3>

<?php

	$my_email = $_SESSION['email'];
	$req_query = mysql_query("SELECT user_from FROM frnd_request where user_to='$my_email'");
		while($run_req = mysql_fetch_array($req_query)){
			$from = $run_req['user_from'];
			$from_username = getuser($from, 'Email');
			echo "<a href='profile.php?user=$from'class='box'style='display:block'>$from_username</a>";
		}
	?>


</div>


</body>
</html>