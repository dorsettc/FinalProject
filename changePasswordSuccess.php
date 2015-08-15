<?php
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	if(isset($_POST['username']) && !empty($_POST['username'])){
		$username = $_POST['username'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Username cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	if(isset($_POST['passwordOld']) && !empty($_POST['passwordOld'])){
		$passwordOld = $_POST['passwordOld'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Old Password cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	if(isset($_POST['passwordNew']) && !empty($_POST['passwordNew'])){
		$passwordNew = $_POST['passwordNew'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "New Password cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}

	$sql = "SELECT Password FROM UserPass WHERE Username=?";
	if(!$stmt = $conn->prepare($sql)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Prepare Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->bind_param('s', $username)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->execute()){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Execute Error: " . $stmt->error . "<br>";
	} 
	if(!$stmt->bind_result($res_password)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	while($stmt->fetch()){
		if($passwordOld == $res_password)
			$temp = 1;
	}
	$stmt->close();

	if($temp == 1){
		$sql = "UPDATE UserPass SET Password=? WHERE Username=?";
		if(!$stmt = $conn->prepare($sql)){
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			echo "Prepare Error: " . $stmt->error . "<br>";
		}
		if(!$stmt->bind_param('ss', $passwordNew, $username)){
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			echo "Binding Error: " . $stmt->error . "<br>";
		}
		if(!$stmt->execute()){
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			echo "Execute Error: " . $stmt->error . "<br>";
		}	 
		else {
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/profile.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			echo "New Password accepted<br>";
		}
	}
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changePassword.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Old Password does not match<br>";
	}

	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
