<?php
session_start();
?>
<html>
<head>
<title>Update - myGym </title>
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
<form action="" method="post" target="_self">
				<tr>
					<h4><td><?php echo 'New Height'; ?></td></h4>
					<td><input name="newheight" type="text" /></td>
				</tr>
				<tr>
					<h4><td><?php echo 'New Weight'; ?></td></h4>
					<td><input name="newweight" type="text" /></td>
				</tr>
				<tr>
                                        <h4><td><?php echo 'New Location'; ?></td></h4>
                                        <td><input name="newlocation" type="radio" value="ISR">ISR<br>
                                        <input name="newlocation" type="radio" value="FAR/PAR">FAR/PAR<br>
                                        <input name="newlocation" type="radio" value="Ikenberry">Ikenberry<br>
                                        <input name="newlocation" type="radio" value="LAR/Allen/BE">LAR/Allen/BE</td>
				</tr>
				<tr>
				<td class="label">

					<h3><input name="Update" type="submit" value="Update Account" /></h3><br/>
				</td>
				</tr>
</form>	
<?php
if(isset($_POST['Update'])){//if the submit button is clicked
	
	$newheight = $_POST['newheight'];
	$newweight = $_POST['newweight'];
	$newlocation = $_POST['newlocation'];
	
	if(!empty($newheight) && !empty($newweight) && !empty($newlocation)){
	   $query="UPDATE Users SET Height = $newheight, Weight = $newweight, Location = '$newlocation' WHERE Email = '$my_email'";
	   mysql_query($query) or die("Cannot update");//update or error
	} else if (!empty($newheight) && !empty($newweight)) {
	   $query="UPDATE Users SET Height = $newheight, Weight = $newweight WHERE Email = '$my_email'";
	   mysql_query($query) or die("Cannot update");//update or error
	} else if (!empty($newheight) && !empty($newlocation)) {
	   $query="UPDATE Users SET Height = $newheight, Location = '$newlocation' WHERE Email = '$my_email'";
	   mysql_query($query) or die("Cannot update");//update or error
	} else if (!empty($newweight) && !empty($newlocation)) {
	   $query="UPDATE Users SET Weight = $newweight, Location = '$newlocation' WHERE Email = '$my_email'";
	   mysql_query($query) or die("Cannot update");//update or error
	} else if (!empty($newheight)) {
	   $query="UPDATE Users SET Height = $newheight WHERE Email = '$my_email'";
	   mysql_query($query) or die("Cannot update");//update or error
	} else if (!empty($newweight)) {
	   $query="UPDATE Users SET Weight = $newweight WHERE Email = '$my_email'";
	   mysql_query($query) or die("Cannot update");//update or error
	} else if (!empty($newlocation)) {
	   $query="UPDATE Users SET Location = '$newlocation' WHERE Email = '$my_email'";
	   mysql_query($query) or die("Cannot update");//update or error
	}
	}
?>




</div>

</body>
</html>