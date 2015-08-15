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
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Username cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}
	if(isset($_POST['password']) && !empty($_POST['password'])){
		$password = $_POST['password'];
	} 
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Password cannot be empty<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}

	if($username == 'admin' && $password == '1234'){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/admin.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		session_start();
		$_SESSION['login'] = 2;
		echo "Welcome, Admin<br>";
		echo "<br>Redirecting in 3 seconds...";
		exit();
	}


	$sql = "SELECT Password FROM UserPass WHERE Username=?";
	if(!$stmt = $conn->prepare($sql)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Prepare Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->bind_param('s', $username)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}
	if(!$stmt->execute()){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Execute Error: " . $stmt->error . "<br>";
	} 
	if(!$stmt->bind_result($res_password)){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Binding Error: " . $stmt->error . "<br>";
	}

	while($stmt->fetch()){
		if($password == $res_password)
			$temp = 1;
	}
	if($temp == 1){
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/main.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		session_start();
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['login'] = 1;
		echo "Username and Password accepted<br>";
	}
	else {
		header('Refresh: 3; URL=http://web.engr.oregonstate.edu/~dorsettc/FinalProject/login.php');
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"http://web.engr.oregonstate.edu/~dorsettc/FinalProject/style.css\">";
		echo "Username and Password do not match<br>";
	}

			
	$stmt->close();
	$conn->close();
	echo "<br>Redirecting in 3 seconds...";
?>
