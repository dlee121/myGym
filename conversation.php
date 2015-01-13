<?php
session_start();
?>
<? ob_start(); ?>
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
			<?php $my_id = $_SESSION['email']; ?>
			</br>
			<b>Conversations: </b>
			<?php
			if(isset($_GET['hash']) && !empty($_GET['hash'])){
				$hash = $_GET['hash'];
				$message_query = mysql_query("SELECT from_Email, message FROM message WHERE group_hash='$hash'");
				while($run_message = mysql_fetch_array($message_query)){
					$from_Email = $run_message['from_Email'];
					$message = $run_message['message'];				
					echo "<p><b>$from_Email</b></br>$message</p>";
				}	
				?>
				<br/>
				<form method = 'post'>
				<?php
				if(isset($_POST['message']) && !empty($_POST['message'])){
					$new_message = $_POST['message'];
					mysql_query("INSERT INTO message VALUES('', '$hash', '$my_id', '$new_message')");
					header('location: conversation.php?hash='.$hash);
				}
				?>
				Enter Message : <br/>
				<textarea name='message' rows='6' cols='50'></textarea>
				<br/><br/>
				<input type='submit' value="Send Message" />
				</form>
				
				<?php
			} else {
				echo "<b>Select conversation</b>";
				$get_con = mysql_query("SELECT hash, Email1, Email2 FROM message_group WHERE Email1 = '$my_id' OR Email2 = '$my_id'");
				while($run_con = mysql_fetch_array($get_con)) {
					$hash = $run_con['hash'];
					$Email1 = $run_con['Email1'];
					$Email2 = $run_con['Email2'];
					
					if($Email1 == $my_id){
						$select_id = $Email2;
					}
				 	else {
				 		$select_id = $Email1;
				 	}
	
				 	echo "<p><a href='conversation.php?hash=$hash'>$select_id</a></p>";
				}
			}
			?>
		</div>
	
	
	</body>
</html>
<? ob_flush(); ?>