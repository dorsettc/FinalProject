<?php
	session_start();
	if($_SESSION['login'] != 1){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "Please login before visiting this page";		
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

		<h2 align="center">Topic: <?php echo $_GET['topic']; ?></h2>

		<?php
			session_start();
			echo "<br>Welcome, " . $_SESSION['username'] . "<br>";
			$_SESSION['top_id'] = $_GET['top_id'];
		?>
		
		<form action="profile.php" style="display: inline">
			<input type="submit" name="submit" value="Profile">
		</form>
		
		<form action="logout.php" style="display: inline">
			<input type="submit" name="submit" value="Logout">
		</form>

		<form action="main.php" style="display: inline">
			<input type="submit" name="submit" value="Return to Main">
		</form>
		
		<div style="display: inline">
			<a href="topic.php?cat_id=<?php echo $_GET['cat_id']."&top_id=".$_GET['top_id']."&category=".$_GET['category']; ?> ">Return to Category: <?php echo $_GET['category']; ?></a>
		</div>
		
		<br><br><br>
		<div align="center">
			<a href="createPost.php?cat_id=<?php echo $_GET['cat_id']."&top_id=".$_GET['top_id']."&category=".$_GET['category']."&topic=".$_GET['topic']; ?> ">Create Post</a>
		</div>

		<br>
		<table id="posts" border='1' align="center">
			<tr>
				<th>ID</th>
				<th>Creation Date</th>
				<th>Username</th>
				<th width="75%"></th>
			</tr>
			<?php
				$dbhost = 'oniddb.cws.oregonstate.edu';
				$dbname = 'dorsettc-db';
				$dbuser = 'dorsettc-db';
				$dbpass = 'vYA4TdijrmClBX2o';
		
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
				$cat_id = $_GET['cat_id'];
				$top_id = $_GET['top_id'];
				$sql = "SELECT * FROM Posts WHERE TOP_ID=\"" . $top_id . "\"";
				if(!$stmt = $conn->prepare($sql))
					echo "Prepare Error: " . $stmt->error . "<br>";
				if(!$stmt->execute())
					echo "Execute Erro: " . $stmt->error . "<br>";
				if(!$stmt->bind_result($res_pos, $res_top, $res_cat, $res_username, $res_create, $res_message))
					echo "Binding Error: " . $stmt->error . "<br>";
	
				while($stmt->fetch()){
					echo "<tr>";
					echo "<td rowspan='2'>" . $res_pos . "</td>";
					echo "<td rowspan='2'>" . $res_create . "</td>";
					echo "<td rowspan='2'>" . $res_username . "</td>";
					echo "<td rowspan='2' id=\"message\">" . $res_message . "</td>";
					echo "</tr>";
					echo "<tr></tr>";
				}
				$stmt->close();
				$conn->close();
			?>
		</table>

	</body>
</html>
