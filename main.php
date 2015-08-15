<?php
	session_start();
	if($_SESSION['login'] != 1){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "Please login before you visit the main page";		
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

		<h2 align="center">Main</h2>

		<?php
			session_start();
			echo "<br>Welcome, " . $_SESSION['username'] . "<br>";
		?>
		
		<form action="profile.php" style="display: inline">
			<input type="submit" name="submit" value="Profile">
		</form>
		
		<form action="logout.php" style="display: inline">
			<input type="submit" name="submit" value="Logout">
		</form>

		<br><br><br>
		<form action="createCategory.php" align="center">
			<input type="submit" name="submit" value="Create Category">
		</form>
		
		
		<table id="categories" border='1' align="center">
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
				if(!$stmt = $conn->prepare($sql))
					echo "Prepare Error: " . $stmt->error . "<br>";
				if(!$stmt->execute())
					echo "Execute Erro: " . $stmt->error . "<br>";
				if(!$stmt->bind_result($res_cat, $res_title, $res_message, $res_posts, $res_date))
					echo "Binding Error: " . $stmt->error . "<br>";
		
				while($stmt->fetch()){
					echo "<tr>";
					echo "<td>" . $res_cat . "</td>";
					echo "<td>" . "<a href=\"topic.php?cat_id=".$res_cat."&category=".$res_title."\">".$res_title."</a></td>";
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
