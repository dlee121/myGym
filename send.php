<?php
session_start();
?>
<html>
	<head>
	<title> Conversation - Messages </title>
	<link rel ='stylesheet' href='style.css' />
	<head>
	<body>
		<?php include 'connect.php'; ?>
		<?php include 'functions.php'; ?>
		<?php include 'header.php'; ?>
		
		<div class="container">
			<h2>Private Message System</h2>
			
			<?php include 'message_title_bar.php'; ?>
			<?php
			if(isset($_GET['user']) && !empty($_GET['user']))
			{
			?>
			<form method = 'post'>
			<?php
			$my_id = $_SESSION['email'];
			$user = $_GET['user'];
			$random_number = rand();
			$message = $_POST['message'];
			
			if(isset($_POST['message']) && !empty($_POST['message']))
			{
				$check_con = mysql_query("SELECT hash FROM message_group WHERE (Email1='$my_id' AND Email2 = '$user') OR (Email1='$user' AND Email2 = '$my_id')");

			if(mysql_num_rows($check_con) == 1) {
				echo '<p>Conversation already started';
			}
			else {
			mysql_query("INSERT INTO message_group VALUES('$my_id','$user', '$random_number')");
			mysql_query("INSERT INTO message VALUES('','$random_number', '$my_id', '$message')");
			echo '<p>Conversation Started</p>';
			}
			}
			
			
			?>
			Enter Message : <br/>
			<textarea name = 'message' rows='7' cols='60'></textarea>
			<br/><br/>
			<input type='submit' value='Send Message' />
			</form>
			
			<?php	
			}
			else
			{
				echo "<b>Select User:</b>";
				$user_list = mysql_query("SELECT Email FROM Users");
				while($run_user = mysql_fetch_array($user_list)) {
					$user = $run_user['Email'];
					$username = $run_user['Email'];
					
					echo "<p><a href='send.php?user=$user'>$username</a></p>";
				}
			}
			?>
		</div>
	
	</body>
</html>