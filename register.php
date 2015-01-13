<?php
session_start();
?>
<html>
<head>
<title>Register - myGym </title>
<link rel ='stylesheet' href='style.css' />
</head>
<body>
<?php include 'connect.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'header.php'; ?>

<div class='container'>
	<h3>Register a new account</h3>
	<form method='post'>
	<?php 	
		if(isset($_POST['submit'])) {
			$email =$_POST['email'];
			$password =$_POST['password'];
			$weight=$_POST['weight'];
			$height =(12 * $_POST['feet'])+ $_POST['inch'];
			$gender=$_POST['gender'];
			$location = $_POST['location'];
			
			if(empty($email) or empty($password) or empty($weight) or empty($height) or empty($gender) or empty($location)){
				
				$message = "Please resubmit!";
			}
			else{			
				$sql="INSERT INTO Users VALUES('$email','$password','$weight', '$height','$gender', '$location')";
				$res=mysql_query($sql);
				if($res == FALSE)
					$message = "An account already exists for \"".$email."\"";
				else {
					$message = "OK !";
				}
			}
			
		
			echo "<div class='box'>$message</div>";
		}
		
	?>
	
	
	
	
	email : <br/>
	<input type='email' name ='email' />
	<br/><br/>
	
	password : <br/>
	<input type='password' name ='password' />
	<br/><br/>
	
	weight : <br/>
	<input type='number' name ='weight' min='0'/>
	<br/><br/>
	
	height: <br/>
	<input type='number' name ='feet' style='width:4em;' min='0'/><a>feet</a><input type='number' name='inch' style='width:5em;' min='0'/><a>inches</a>
	<br/><br/>
	
	gender:
	<input type="radio" name="gender"
	<?php if (isset($gender) && $gender=="female") echo "checked";?>
	value="female">female
	<input type="radio" name="gender"
	<?php if (isset($gender) && $gender=="male") echo "checked";?>
	value="male">male
	<br/><br/>
	Location:<br/><input type="radio" name="location" value="ISR">ISR<br/>
	<input type="radio" name="location" value="FAR/PAR">FAR/PAR<br/>
	<input type="radio" name="location" value="LAR/Allen/BE">LAR/Allen/BE<br/>
	<input type="radio" name="location" value="Ikenberry">Ikenberry<br/>
	<br/>
	<input type='submit' name ='submit' value='Register' />
	</form>

</div>


</body>
</html>