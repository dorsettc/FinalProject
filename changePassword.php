<html>
	<head>
		<title>Collin Dorsett - CS 290 Final Project</title>
		<link rel="stylesheet" type="test/css" href="http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css">
	</head>
	<body>

	<h2 align="center">Change Password</h2>

	<div align="center">
		<form action="changePasswordSuccess.php" method="POST">
			Username: <input type="text" name="username"><br>
			Old Password: <input type="text" name="passwordOld"><br>
			New Password: <input type="text" name="passwordNew"><br>
			<input type="submit" name="submit" value="Submit">
		</form>

		<br>
		<form action="profile.php">
			<input type="submit" name="submit" value="Return to Profile">
		</form>
	</div>
	
	</body>
</html>
