<?php
	session_start();
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	$cat = $_SESSION['cat_id'];
	$top = $_SESSION['top_id'];
	$cat2 = $_SESSION['category'];
	$top2 = $_SESSION['topic'];
	if(isset($_POST['message']) && !empty($_POST['message'])){
		$message = $_POST['message'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createPost.php?cat_id='.$cat.'&top_id='.$top.'&category='.$cat2.'&topic='.$top2);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Message cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	$username = $_SESSION['username'];
	$time = date('m-d-y');
	
	$sql = "INSERT INTO Posts (TOP_ID, CAT_ID, Username, CreationDate, Message)
			VALUES (?, ?, ?, ?, ?)";
	if(!$stmt = $conn->prepare($sql)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createPost.php?cat_id='.$cat.'&top_id='.$top.'&category='.$cat2.'    &topic='.$top2);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Prepare Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->bind_param('iisss', $top, $cat, $username, $time, $message)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createPost.php?cat_id='.$cat.'&top_id='.$top.'&category='.$cat2.'    &topic='.$top2);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->execute()){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createPost.php?cat_id='.$cat.'&top_id='.$top.'&category='.$cat2.'    &topic='.$top2);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Execute Error: " . $stmt->error . "<br>";
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/post.php?cat_id='.$cat.'&top_id='.$top.'&category='.$cat2.'    &topic='.$top2);
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		$sql2 = "UPDATE UserPass SET PostCount=PostCount+1 WHERE Username=?";
		if(!$stmt2 = $conn->prepare($sql2))
			echo "Prepare Error: " . $stmt2->error . "<br>";
		if(!$stmt2->bind_param('s', $username))
			echo "Binding Error: " . $stmt2->error . "<br>";
		if(!$stmt2->execute())
			echo "Execute Error: " . $stmt2->error . "<br>"; 
		echo "Post created successfully<br>";
	
		$sql3 = "UPDATE Topics SET Posts=Posts+1 WHERE TOP_ID=?";
		$stmt3 = $conn->prepare($sql3);
		$stmt3->bind_param('s', $top);
		$stmt3->execute();

		$sql4 = "UPDATE Topics SET ReplyDate=? WHERE TOP_ID=?";
		$stmt4 = $conn->prepare($sql3);
		$stmt4->bind_param('ss', $time, $top);
		$stmt4->execute();
	}

	$stmt->close();
	$stmt2->close();
	$stmt3->close();
	$stmt4->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
