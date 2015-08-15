<html>
	<head>
		<title>Collin Dorsett - CS 290 Final Project</title>
		<link rel="stylesheet" type="test/css" href="http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css">
	</head>
	<body>

	<h2 align="center">Change Username</h2>

	<div align="center">
		<form action="changeUsernameSuccess.php" method="POST">
			Password: <input type="text" name="password"><br>
			Old Username: <input type="text" name="usernameOld"><br>
			New Username: <input type="text" name="usernameNew"><br>
			<input type="submit" name="submit" value="Submit">
		</form>
		
		<br>
		<form action="profile.php">
			<input type="submit" name="submit" value="Return to Profile">
		</form>
	</div>

	</body>
</html>
