<div id='title_bar'>
	<ul>
		<li><a href='index.php'>Home</a></li>
		<?php
		if(loggedin()){
		?>
		<li><a href='profile.php'>Profile</a></li>
		<li><a href='update.php'>Update Profile</a></li>
		<li><a href='delete.php'>Delete Profile</a></li>
		<li><a href='request.php'>Requests</a></li>
		<li><a href='friends.php'>Friends</a></li>
		<li><a href='message.php'>Messages</a></li>
		<li><a href='members.php'>Members</a></li>
		<li><a href='logout.php'>Log Out</a></li>
		<?php
		}
		else{
		?>
		<li><a href='login.php'>Log in</a></li>
		<li><a href='register.php'>Register</a></li>
		<?php
		}
		?>	
		<div class='clear'></div>
	</ul>

</div>