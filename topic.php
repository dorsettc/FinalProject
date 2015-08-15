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

		<h2 align="center">Category: <?php echo $_GET['category']; ?></h2>

		<?php
			session_start();
			echo "<br>Welcome, " . $_SESSION['username'] . "<br>";
			$_SESSION['cat_id'] = $_GET['cat_id'];
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
		
		<br><br><br>
		<div align="center">
			<a href="createTopic.php?cat_id=<?php echo $_GET['cat_id']."&category=".$_GET['category']; ?>">Create Topic</a>
		</div>

		<br>
		<table id="topics" border='1' align="center">
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Creator</th>
				<th>Creation Date</th>
				<th>Last Reply</th>
				<th>Posts</th>
			</tr>
			<?php
				$dbhost = 'oniddb.cws.oregonstate.edu';
				$dbname = 'dorsettc-db';
				$dbuser = 'dorsettc-db';
				$dbpass = 'vYA4TdijrmClBX2o';
		
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
				$cat_id = $_GET['cat_id'];
				$sql = "SELECT * FROM Topics WHERE CAT_ID=\"" . $cat_id . "\"";
				if(!$stmt = $conn->prepare($sql))
					echo "Prepare Error: " . $stmt->error . "<br>";
				if(!$stmt->execute())
					echo "Execute Erro: " . $stmt->error . "<br>";
				if(!$stmt->bind_result($res_top, $res_cat, $res_title, $res_username, $res_create, $res_reply, $res_posts))
					echo "Binding Error: " . $stmt->error . "<br>";
				
				while($stmt->fetch()){
					echo "<tr>";
					echo "<td>" . $res_top . "</td>";
					echo "<td>" . "<a href=\"post.php?cat_id=".$res_cat."&top_id=".$res_top."&category=".$_GET['category']."&topic=".$res_title."\">".$res_title."</a></td>";
					echo "<td>" . $res_username . "</td>";
					echo "<td>" . $res_create . "</td>";
					echo "<td>" . $res_reply . "</td>";
					echo "<td>" . $res_posts . "</td>";
					echo "</tr>";
				}
				$stmt->close();
				$conn->close();
			?>
		</table>

	</body>
</html>
