<?php

session_start();

function loggedin(){
	if(isset($_SESSION['email']) && !empty($_SESSION['email']) && isset($_SESSION['password']) && !empty($_SESSION['password']) && isset($_SESSION['height']) && !empty($_SESSION['height']) && isset($_SESSION['weight']) && !empty($_SESSION['weight']) && isset($_SESSION['gender']) && !empty($_SESSION['gender'])){
		return true;
	}
	else{
		return false;
	}
	
}

function getuser($Email, $field){
	$query = mysql_query("SELECT $field FROM Users WHERE Email='$Email'");
	$run = mysql_fetch_array($query);
	return $run[$field];
}

?>