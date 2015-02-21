<?php 
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];
	$information = $_POST['information'];
	//Get the access variables	
	require('dbSetup.php');
	
	//require the password for php 5.5
	require("password.php");
	
	//open the DB
	try
	{
		if( $username == "" || $password == ""|| $information == "")
		{
			header("Location: GuideAccess.php");
			die(); // we always include a die after redirects.
		}
		else
		{
			$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
			$query = "SELECT guideid FROM guide WHERE username LIKE '$username';";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			if($row['guideid'] === null)
			{
				$username = htmlspecialchars($username);
				
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				
				$query = 'INSERT INTO guide(information, username, password) VALUES(:information, :username, :password);';
				$statement = $db->prepare($query);
				$statement->bindParam(':information', $information);
				$statement->bindParam(':username', $username);
				$statement->bindParam(':password', $hashedPassword);
				$statement->execute();
				
				$query = 'select guideid from guide where username = :username;';
				$statement = $db->prepare($query);
				$statement->bindParam(':username', $username);
				$statement->execute();
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				
				$_SESSION['g_username'] = $username;
				$_SESSION['guideid'] = $row['guideid'];
				$_SESSION['information'] = $information;
				
				header("Location: GuideAccessSignedIn.php");
				die(); // we always include a die after redirects.
			}
			else
			{
				header("Location: GuideAccess.php");
				die(); // we always include a die after redirects.
			}
		}
	}
	catch (PDOException $ex) 
	{
	   echo "Error!: " . $ex->getMessage();
	   die(); 
	}
	
?>
