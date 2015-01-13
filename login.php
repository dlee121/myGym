<?php
session_start();
?>
<? ob_start(); ?>
<html>
<head>
<title>Login - myGym </title>
<link rel ='stylesheet' href='style.css' />
<head>
<body>
<?php include 'connect.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'header.php'; ?>

<div class='container'>
	<h3>Login to your account</h3>
	<form method='post'>
	<?php 	
	
	

		if(isset($_POST['submit'])) {
			$email =$_POST['email'];
	
			$password =$_POST['password'];
			
		
			
			
			
			
			if(empty($email) or empty($password)){
				
				$message = "Please resubmit!";
			}
			else{
				$sql="SELECT Email, Pass, Height, Weight, Gender FROM Users WHERE Email = '$email' AND Pass = '$password';";


				$res=mysql_query($sql);
				
				if(mysql_num_rows($res) == 1){
							
					$get = mysql_fetch_array($res);
					$_SESSION['email'] = $get['Email'];
					$_SESSION['password'] = $get['Pass'];
					$_SESSION['height'] = $get['Height'];
					$_SESSION['weight'] = $get['Weight'];
					$_SESSION['gender'] = $get['Gender'];
					
					header('location:index.php');
				}
				
				else
				{
					$message = "Wrong";
				}
				
			
			}
			
		
			echo "<div class='box'>$message</div>";
		}
		
	?>
	
	
	
	
	email : <br/>
	<input type='text' name ='email' />
	<br/><br/>
	
	password : <br/>
	<input type='password' name ='password' />
	<br/><br/>

	
	
	<input type='submit' name ='submit' value='login' />
	</form>

</div>


</body>
</html>
<? ob_flush(); ?>