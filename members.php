<?php
session_start();
?>
<html>
<head>
<title> Members - myGym </title>
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
	<h3>Members : (Sorted by Distance from your Location)</h3>
	<?php
	
		$mem_query = mysql_query("SELECT DISTINCT Email, Users.Location AS Location, distance FROM Users JOIN Distances WHERE Email != '$my_email' AND location2 = '$location' AND Users.Location = Distances.Location ORDER BY distance ASC, Location DESC;");
		while($run_mem = mysql_fetch_array($mem_query)){
			$user_email = $run_mem['Email'];
			$username = getuser($user_email, 'Email');
			$location = getuser($user_email, 'Location');
			echo "<a href='profile.php?user=$user_email'class='box'style='display:block'>$user_email at $location</a>";
		}
	?>
</div>


</body>
</html>