<?php
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'dorsettc-db';
	$dbuser = 'dorsettc-db';
	$dbpass = 'vYA4TdijrmClBX2o';
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


	if(isset($_POST['password']) && !empty($_POST['password'])){
		$password = $_POST['password'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Password cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	if(isset($_POST['usernameOld']) && !empty($_POST['usernameOld'])){
		$usernameOld = $_POST['usernameOld'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Old Username cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	if(isset($_POST['usernameNew']) && !empty($_POST['usernameNew'])){
		$usernameNew = $_POST['usernameNew'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "New Username cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}

	$sql = "SELECT Password FROM UserPass WHERE Username=?";
	if(!$stmt = $conn->prepare($sql)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Prepare Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->bind_param('s', $usernameOld)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->execute()){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Execute Error: " . $stmt->error . "<br>";
	} 
	if(!$stmt->bind_result($res_password)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	while($stmt->fetch()){
		if($password == $res_password)
			$temp = 1;
	}
	$stmt->close();

	if($temp == 1){
		$sql = "UPDATE UserPass SET Username=? WHERE Username=?";
		if(!$stmt = $conn->prepare($sql)){
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			echo "Prepare Error: " . $stmt->error . "<br>";
		}
		if(!$stmt->bind_param('ss', $usernameNew, $usernameOld)){
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			echo "Binding Error: " . $stmt->error . "<br>";
		}
		if(!$stmt->execute()){
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			echo "Username is already in use, please choose a different one<br>";
		}	 
		else {
			header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/profile.php');
			echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
			session_start();
			$_SESSION['username'] = $_POST['usernameNew'];
			echo "New Username accepted<br>";
		}
	}
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/changeUsername.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Password does not match<br>";
	}

	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
