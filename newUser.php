<html>
	<head>
		<title>Collin Dorsett - CS 290 Final Project</title>
		<link rel="stylesheet" type="test/css" href="http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css">
	</head>
	<body>

		<h2 align="center">New User</h2>
		
		<div align="center">
			<form action="newUserSuccess.php" method="POST">
				Username: <input type="text" name="username" id="username"><span id="status"></span><br>
				Password: <input type="text" name="password"><br>
				<input type="submit" name="submit" value="Submit">
			</form>
	
			<br>
			<form action="login.php">
				<input type="submit" name="submit" value="Return to Login">
			</form>
		</div>

	</body>
</html>
