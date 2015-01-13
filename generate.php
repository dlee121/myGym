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
			<?php
				session_start();
				
				$link = mysql_connect('engr-cpanel-mysql.engr.illinois.edu', 'projectmygym_acc', 'pass123');

				if (!$link) 
				{
				
				die('Could not connect: ' . mysql_error());
				
				}

				mysql_select_db('projectmygym_users');
				
				$diff =$_POST["level"];
				
				//temporary personal exercise table 'temp' for user
				$personal = " CREATE TEMPORARY TABLE temp ( `name` varchar(25), `bodypart` varchar(20), `group` tinyint(1), `shoulder` varchar(1), `wrist` varchar(1),
									`lowerback` varchar(1), `knee` varchar(1), `ankle` varchar(1), `guide` varchar(42));"; 
				mysql_query($personal, $link) or die ("Sql error : ".mysql_error());
				$insert = "INSERT INTO temp (`name`, `bodypart`, `group`, `shoulder`, `wrist`, `lowerback`, `knee`, `ankle`, `guide`) 
				SELECT `name`, `bodypart`, `group`, `shoulder`, `wrist`, `lowerback`, `knee`, `ankle`, `guide` FROM Exercises";
				mysql_query($insert, $link) or die ("Sql error : ".mysql_error());
				//injury filter
				if(!empty($_POST["avoid"])) {
					foreach($_POST["avoid"] as $injury) {
						$remove = "DELETE FROM temp WHERE $injury ='n';";
						mysql_query($remove, $link) or die ("Sql error : ".mysql_error());
					}
				}
				
				//temp table 'result' to store generator results
				$outtable = " CREATE TEMPORARY TABLE result ( `name` varchar(25), `bodypart` varchar(20), `guide` varchar(42));"; 
				mysql_query($outtable, $link) or die ("Sql error : ".mysql_error());
				
				//insert accessory lifts (bodyparts that are not chest, back, or leg) to result
				$insert = "INSERT INTO result (`name`, `bodypart`, `guide`) 
				SELECT name, bodypart, guide FROM temp WHERE (`group` <= $diff) AND !((bodypart = 'Chest') OR (bodypart = 'Back') OR (bodypart = 'Legs'));";
				mysql_query($insert, $link) or die ("Sql error : ".mysql_error());
				
				//randomly pick an exercise for each level and append to result
				for ($i = 0; $i <= $diff; $i++) {
					$insert = "INSERT INTO result (name, bodypart, guide) SELECT name, bodypart, guide FROM temp WHERE `group` = $i AND bodypart = 'Chest' ORDER BY RAND() LIMIT 1;";
					mysql_query($insert, $link) or die ("Sql error : ".mysql_error());
				}
				for ($i = 0; $i <= $diff; $i++) {
					$insert = "INSERT INTO result (name, bodypart, guide) SELECT name, bodypart,guide FROM temp WHERE `group` = $i AND bodypart = 'Back' ORDER BY RAND() LIMIT 1;";
					mysql_query($insert, $link) or die ("Sql error : ".mysql_error());
				}
				for ($i = 0; $i <= $diff; $i++) {
					$insert = "INSERT INTO result (name, bodypart, guide) SELECT name, bodypart, guide FROM temp WHERE `group` = $i AND bodypart = 'Legs' ORDER BY RAND() LIMIT 1;";
					mysql_query($insert, $link) or die ("Sql error : ".mysql_error());
				}
				
				//generate table
				$sql = "SELECT * FROM result;";
				$res = mysql_query($sql, $link);
				echo "<table id='generated'>
				<tr>
					<th>Exercise</th>
					<th>Bodypart</th>
					<th>Guide</th>
				</tr>";
				while($row = mysql_fetch_array($res)){
					echo "<tr>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['bodypart'] . "</td>";
					echo "<td><a href='" . $row['guide'] . "' target='_blank' >click to watch</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				mysql_close($link);
			?>
		</div>
	</body>
</html>