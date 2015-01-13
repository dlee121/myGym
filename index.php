<?php
session_start();
?>
<html>
	<head>
	<title> myGym </title>
	<link rel ='stylesheet' href='style.css' />
	<head>
	<body>
		<?php include 'connect.php'; ?>
		<?php include 'functions.php'; ?>
		<?php include 'header.php'; ?>
		
		<div class='container'>
			<?php include 'indexbody.php'; ?>
		</div>
	
	
	</body>
</html>