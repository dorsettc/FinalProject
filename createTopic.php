<?php
	session_start();
	if($_SESSION['login'] != 1){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "Please login before you visit this page";		
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

	<h2 align="center">Create Topic</h2>
	
	<?php 
		session_start();
		$_SESSION['category'] = $_GET['category'];
	?>

	<div align="center">
		<form action="createTopicSuccess.php" method="POST">
			Title: <input type="text" name="title"><br>
			<input type="submit" name="submit" value="Submit">
		</form>
	
		<br>
		<a href="topic.php?cat_id=<?php echo $_GET['cat_id']."&category=".$_GET['category']; ?>">Return to Category: <?php echo $_GET['category']; ?></a>
	</div>


	</body>
</html>
