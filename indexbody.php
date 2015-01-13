<?php
if(loggedin()){
?>

	<h3>Workout Generator</h3>
	
	<form action="generate.php" method="post" target="_self">
		<div id="levelbox">
			<h4>Select Your Level:</h4>
			<input type="radio" name="level" value="1" checked />Beginner<br>
			<input type="radio" name="level" value="2" />Intermediate<br>
			<input type="radio" name="level" value="3" />Advanced<br>					
		</div>
		<div id="injurybox">
			<h4>Injuries (Check all that apply):</h4>
			<input type="checkbox" name="avoid[]" value="shoulder" />shoulder<br>
			<input type="checkbox" name="avoid[]" value="wrist" />wrist<br> 
			<input type="checkbox" name="avoid[]" value="lowerback" />lower Back<br> 
			<input type="checkbox" name="avoid[]" value="knee" />knee<br> 
			<input type="checkbox" name="avoid[]" value="ankle" />ankle<br> 
		</div>
		<input name="generate" type="submit" value="Submit" />
	</form>			
	</br>

<?php
}
else{
?>

	<div class="center"><a class="buttons" href="register.php">Register</a></div>

<?php
}
?>

<div class='clear'></div>