<?php
	session_start();
	if($_SESSION['login'] != 1){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "Please login before you create a thread";		
		echo "<br><br>Redirecting in 3 seconds...";
		exit();
	}
?>
<html>
	<head>
		<title>Collin Dorsett - CS 290 Final Project</title>
		<link rel="stylesheet" type="test/css" href="http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css">
	</head>
	<body>

	<h2 align="center">Create Category</h2>

	<div align="center">
		<form action="createCategorySuccess.php" method="POST">
			<!-- Image: <input type="file" name="image"><br> -->
			Title: <input type="text" name="title"><br>
			Description: <input type="text" name="message"><br>
			<input type="submit" name="submit" value="Submit">
		</form>
	
		<br>
		<form action="main.php">
			<input type="submit" name="submit" value="Return to Main">
		</form>
	</div>

	</body>
</html>
