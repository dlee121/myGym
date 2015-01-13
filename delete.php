<?php
session_start();
?>
<html>
<head>
<title>Delete Profile - myGym </title>
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
	
?>
<form action="" method="post" target="_self">
				<tr>
					<h4><td><?php echo 'Email'; ?></td></h4>
					<td><input name="user_email" type="text" /></td>
				</tr>
				<tr>
					<h4><td><?php echo 'Password'; ?></td></h4>
					<td><input name="user_pass" type="text" /></td>
				</tr>
								<tr>
				<td class="label">

					<h3><input name="Delete" type="submit" value="Delete Account" /></h3><br/>
				</td>
				</tr>
</form>	
<?php
if(isset($_POST['Delete'])){
	
	$user_email = $_POST['user_email'];
	$user_pass = $_POST['user_pass'];

           
       $q = mysql_query("SELECT * FROM Users WHERE Email = '$user_email' AND Pass = '$user_pass'");
       $user_n = mysql_num_rows($q);
                
       if($user_n == 1){
             mysql_query("DELETE FROM Users WHERE Email='$user_email'"); 
                 
             session_destroy();
                    
             echo 'Account deleted. <a href="index.php">Back to Home page.</a>';
       }
       else {
             echo 'Wrong Email-Password combination. Please try again. <a href="index.php">Go to Home page.</a>';
       }
} 
    
?>




</div>

</body>
</html>