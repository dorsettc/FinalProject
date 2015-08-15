<?php
	session_start();
	if($_SESSION['login'] != 2){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "Forbidden Access";		
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

		<h2 align="center">Admin</h2>

		<br><br>
		<b>List of Commands</b><br>
		<form action="deleteUserPassTable.php" style="display: inline">
			<input type="submit" name="submit" value="Delete All User Accounts">
		</form>
		
		<br>
		<form action="deleteCategoriesTable.php" style="display: inline">
			<input type="submit" name="submit" value="Delete All Categories, Topics, and Posts">
		</form>

		<br>
		<form action="logout.php" style="display: inline">
			<input type="submit" name="submit" value="Logout">
		</form>
		
		
		<br><br><br>
		<b>List of Users</b>
		<table id="users" border='1'>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Password</th>
				<th>Join Date</th>
				<th>Category Count</th>
				<th>Topic Count</th>
				<th>Post Count</th>
			</tr>
			<?php
				$dbhost = 'oniddb.cws.oregonstate.edu';
				$dbname = 'dorsettc-db';
				$dbuser = 'dorsettc-db';
				$dbpass = 'vYA4TdijrmClBX2o';
		
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
				$sql = "SELECT * FROM UserPass";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$stmt->bind_result($res_id, $res_username, $res_password, $res_date, $res_catC, $res_topC, $res_posC);
		
				while($stmt->fetch()){
					echo "<tr>";
					echo "<td>" . $res_id . "</td>";
					echo "<td>" . $res_username . "</td>";
					echo "<td>" . $res_password . "</td>";
					echo "<td>" . $res_date . "</td>";
					echo "<td>" . $res_catC . "</td>";
					echo "<td>" . $res_topC . "</td>";
					echo "<td>" . $res_posC . "</td>";
					echo "</tr>";
				}
				$stmt->close();
				$conn->close();
			?>
		</table>

		<br><br><br>
		<b>List of Categories</b>
		<table id="categories" border='1'>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Description</th>
				<th>Creation Date</th>
				<th>Topics</th>
			</tr>
			<?php
				$dbhost = 'oniddb.cws.oregonstate.edu';
				$dbname = 'dorsettc-db';
				$dbuser = 'dorsettc-db';
				$dbpass = 'vYA4TdijrmClBX2o';
		
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


				$sql = "SELECT * FROM Categories";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$stmt->bind_result($res_id, $res_title, $res_message, $res_posts, $res_date);
		
				while($stmt->fetch()){
					echo "<tr>";
					echo "<td>" . $res_id . "</td>";
					echo "<td>" . $res_title . "</td>";
					echo "<td>" . $res_message . "</td>";
					echo "<td>" . $res_date . "</td>";
					echo "<td>" . $res_posts . "</td>";
					echo "</tr>";
				}
				$stmt->close();
				$conn->close();
			?>
		</table>

	</body>
</html>
