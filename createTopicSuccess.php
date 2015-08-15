<?php
	session_start();
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	$cat = $_SESSION['cat_id'];
	if(isset($_POST['title']) && !empty($_POST['title'])){
		$title = $_POST['title'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createTopic.php?cat_id='.$cat.'&category='.$_SESSION['category']);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Title cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	$username = $_SESSION['username'];
	$posts = 0;
	$time1 = date('m-d-y');
	$time2 = date('m-d-y');

	$sql = "INSERT INTO Topics (CAT_ID, Title, Username, CreationDate, ReplyDate, Posts)
			VALUES (?, ?, ?, ?, ?, ?)";
	if(!$stmt = $conn->prepare($sql)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createTopic.php?cat_id='.$cat.'&category='.$_SESSION['category']);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Prepare Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->bind_param('issssi', $cat, $title, $username, $time1, $time2, $posts)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createTopic.php?cat_id='.$cat.'&category='.$_SESSION['category']);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->execute()){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createTopic.php?cat_id='.$cat.'&category='.$_SESSION['category']);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Execute Error: " . $stmt->error . "<br>";
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/topic.php?cat_id='.$cat.'&category='.$_SESSION['category']);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		$sql2 = "UPDATE UserPass SET TopicCount=TopicCount+1 WHERE Username=?";
		if(!$stmt2 = $conn->prepare($sql2))
			echo "Prepare Error: " . $stmt2->error . "<br>";
		if(!$stmt2->bind_param('s', $username))
			echo "Binding Error: " . $stmt2->error . "<br>";
		if(!$stmt2->execute())
			echo "Execute Error: " . $stmt2->error . "<br>"; 
		echo "Topic created successfully<br>";

		$sql3 = "UPDATE Categories SET Topics=Topics+1 WHERE CAT_ID=?";
		$stmt3 = $conn->prepare($sql3);
		$stmt3->bind_param('s', $cat);
		$stmt3->execute();
	}

	$stmt->close();
	$stmt2->close();
	$stmt3->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
