<?php
	session_start();
	session_destroy();
?>
<html>
	<head>
		<title>Collin Dorsett - CS 290 Final Project</title>
		<link rel="stylesheet" type="test/css" href="http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css">
	</head>
	<body>

		<h2 align="center">The Forum</h2>
	
		<?php
			$dbhost = 'oniddb.cws.oregonstate.edu';
			$dbname = 'dorsettc-db';
			$dbuser = 'dorsettc-db';
			$dbpass = 'vYA4TdijrmClBX2o';
		
			$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	
			$sql = "CREATE TABLE UserPass (
					ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					Username VARCHAR(255) NOT NULL UNIQUE,
					Password VARCHAR(255) NOT NULL,
					JoinDate VARCHAR(255) NOT NULL,
					CategoryCount INT(255) NOT NULL,
					TopicCount INT(255) NOT NULL,
					PostCount INT(255) NOT NULL
			)";	
			$stmt = $conn->prepare($sql);
			$stmt->execute();	
			$stmt->close();

			$sql = "CREATE TABLE Categories (
					CAT_ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					Title VARCHAR(255) NOT NULL,
					Description VARCHAR(255) NOT NULL,
					Topics VARCHAR(255) NOT NULL,
					CreationDate VARCHAR(255) NOT NULL
			)";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$stmt->close();

			$sql = "CREATE TABLE Topics (
					TOP_ID INT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					CAT_ID INT(255) NOT NULL,
					Title VARCHAR(255) NOT NULL,
					Username VARCHAR(255) NOT NULL,
					CreationDate VARCHAR(255) NOT NULL,
					ReplyDate VARCHAR(255) NOT NULL,
					Posts INT(255) NOT NULL
			)";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$stmt->close();


			$sql = "CREATE TABLE Posts (
					POS_ID INT(255)	UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					TOP_ID INT(255) NOT NULL,
					CAT_ID INT(255) NOT NULL,
					Username VARCHAR(255) NOT NULL,
					CreationDate VARCHAR(255) NOT NULL,
					Message VARCHAR(255) NOT NULL
			)";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$stmt->close();

			$conn->close();
		?>
		
		<br>
		<div align="center">
			<b>Welcome! Please login to start posting!</b>
			<form action="loginSuccess.php" method="POST">
				Username: <input type="text" name="username"><br>
				Password: <input type="password" name="password"><br>
				<input type="submit" name="submit" value="Login">
			</form>
	
			<br>
			<b>Are you a new user?</b>
			<br>
			<i>Click <a href="newUser.php">here</a> to get started!</i>
		</div>
	
		<br><br><br><br>
		Admin Login for Testing Purposes<br>
		Username: admin<br>
		Password: 1234

	</body>
</html>
