<?php
	session_start();
	session_destroy();
	header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
	echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
	echo "Logout Successful";
	echo "<br><br>Redirecting in 3 seconds...";
?>
