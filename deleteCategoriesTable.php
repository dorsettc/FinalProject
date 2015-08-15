<?php
	header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
	echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";

	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	
	$sql = "DROP TABLE Categories";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else
		echo "Table 'Categories' deleted successfully <br>";	
	$stmt->close();


	$sql = "DROP TABLE Topics";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else
		echo "Table 'Topics' deleted successfully <br>";	
	$stmt->close();


	$sql = "DROP TABLE Posts";
	if(!$stmt = $conn->prepare($sql))
		echo "Prepare Error: " . $stmt->error . "<br>";
	if(!$stmt->execute())
		echo "Execute Error: " . $stmt->error . "<br>";
	else
		echo "Table 'Posts' deleted successfully <br>";	
	$stmt->close();


	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
