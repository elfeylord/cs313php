<?php
	session_start();
	//Get the POST variables
	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	//Get the access variables	
	require('dbSetup.php');
	
	//require the password for php 5.5
	require("password.php");
	try
	{
		if( $email == "" || $password == ""|| $name == "")
		{
			header("Location: bookTrip.php");
			die(); // we always include a die after redirects.
		}
		else
		{
			
			
			
			
			$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
						
			$query = "SELECT fisherid FROM fisher WHERE name LIKE '$name' OR email LIKE '$email';";
			$statement = $db->prepare($query);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			if($row['fisherid'] === null)
			{
				$name = htmlspecialchars($name);
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				$email = htmlspecialchars($email);
				
				$query = 'INSERT INTO fisher(name, password, email) VALUES(:name, :password, :email);';
				$statement = $db->prepare($query);
				$statement->bindParam(':name', $name);
				$statement->bindParam(':password', $hashedPassword);
				$statement->bindParam(':email', $email);
				$statement->execute();
				
				$query = 'select fisherid from fisher where email = :email;';
				$statement = $db->prepare($query);
				$statement->bindParam(':email', $email);
				$statement->execute();
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				
				$_SESSION['email'] = $email;
				$_SESSION['name'] = $name;
				$_SESSION['fisherid'] = $row['fisherid'];
				
				header("Location: bookTripSignedIn.php");
				die(); // we always include a die after redirects.
			}
			else
			{
				header("Location: bookTrip.php");
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