<?php
session_start();
?>
<html>
	<head>
	<title> Messages </title>
	<link rel ='stylesheet' href='style.css' />
	<head>
	<body>
		<?php include 'connect.php'; ?>
		<?php include 'functions.php'; ?>
		<?php include 'header.php'; ?>
		<div class="container">
			<h2>Private Message System</h2>
			
			<?php include 'message_title_bar.php'; ?>
		</div>
	
	</body>
</html>