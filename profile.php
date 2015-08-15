<html>
	<head>
		<title>Collin Dorsett - CS 290 Final Project</title>
		<link rel="stylesheet" type="test/css" href="http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css">
	</head>
	<body>

		<h2 align="center"><?php session_start(); echo $_SESSION['username']; ?> 's Profile</h2>

		<table id="profile" border='1' align="center">
			<tr>
				<th>Username</th>
				<th>Password</th>
				<th>Join Date</th>
				<th>Category Count</th>
				<th>Topic Count</th>
				<th>Post Count</th>
			</tr>
			<?php
				session_start();
				$dbhost = 'oniddb.cws.oregonstate.edu';
				$dbname = 'dorsettc-db';
				$dbuser = 'dorsettc-db';
				$dbpass = 'vYA4TdijrmClBX2o';
			
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	
				$sql = "SELECT Username,Password,JoinDate,CategoryCount,TopicCount,PostCount FROM UserPass WHERE Username=?";
				if(!$stmt = $conn->prepare($sql))
					echo "Prepare Error: " . $stmt->error . "<br>";
				if(!$stmt->bind_param('s', $_SESSION['username']))
					echo "Binding Error: " . $stmt->error . "<br>";
				if(!$stmt->execute())
					echo "Execute Erro: " . $stmt->error . "<br>";
				if(!$stmt->bind_result($res_username, $res_password, $res_date, $res_catC, $res_topC, $res_posC))
					echo "Binding Error: " . $stmt->error . "<br>";
			
				while($stmt->fetch()){
					echo "<tr>";
					echo "<td>" . $res_username . "</td>";
					echo "<td>" . $res_password . "</td>";
					echo "<td>" . $res_date . "</td>";
					echo "<td>" . $res_catC . "</td>";
					echo "<td>" . $res_topC . "</td>";
					echo "<td>" . $res_posC . "</td>";
					echo "</tr>";
				}
			?>
		</table>		

		<br>
		<div align="center">
			<form action="changeUsername.php" style="display: inline">
				<input type="submit" name="submit" value="Change Username">
			</form>
			
			<form action="changePassword.php" style="display: inline">
				<input type="submit" name="submit" value="Change Password">
			</form>
	
			<form action="deleteProfile.php" style="display: inline">
				<input type="submit" name="submit" value="Delete Account">
			</form>
		</div>

		<br><br>
		<form action="main.php" align="center">
			<input type="submit" name="submit" value="Return to Main">
		</form>

	</body>
</html>
