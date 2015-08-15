<?php
	session_start();
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	if(isset($_POST['title']) && !empty($_POST['title'])){
		$title = $_POST['title'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createCategory.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Title cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	if(isset($_POST['message']) && !empty($_POST['message'])){
		$message = $_POST['message'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createCategory.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Message cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	$username = $_SESSION['username'];
	$topics = 0;
	$time = date('m-d-y');
	
	$sql = "INSERT INTO Categories (Title, Description, Topics, CreationDate)
			VALUES (?, ?, ?, ?)";
	if(!$stmt = $conn->prepare($sql)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createCategory.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Prepare Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->bind_param('ssis', $title, $message, $topics, $time)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createCategory.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->execute()){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/createCategory.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Execute Error: " . $stmt->error . "<br>";
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/main.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		$sql2 = "UPDATE UserPass SET CategoryCount=CategoryCount+1 WHERE Username=?";
		if(!$stmt2 = $conn->prepare($sql2))
			echo "Prepare Error: " . $stmt2->error . "<br>";
		if(!$stmt2->bind_param('s', $username))
			echo "Binding Error: " . $stmt2->error . "<br>";
		if(!$stmt2->execute())
			echo "Execute Error: " . $stmt2->error . "<br>"; 
		echo "Category created successfully<br>";
	}

	$stmt->close();
	$stmt2->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
