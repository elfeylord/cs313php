<?php 
/****************************
* Cole McAllister
* Sign in page for fishers
*
******************************/


session_start();


if(isset($_SESSION['email']))
{
	header("Location: bookTripSignedIn.php");
	die(); // we always include a die after redirects.
}

require("password.php");

$badLogin = false;

//check if the we have post variables, if so check if they are correct
if (isset($_POST['email']) && isset($_POST['password']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//the information for the DB
	require('dbSetup.php');
	
	
	//create the PDO
	try
	{
		
		$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
		//throws an exception when there are problems
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$query = "SELECT fisherid, name, password FROM fisher where email = '$email';";
		
		$statement = $db->prepare($query);
		//$statement->bindParam(':email', $email);
		$results = $statement->execute();
		
		if ($results)
		{
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$hashedPassword = $row['password'];
			if (password_verify($password, $hashedPassword))
			{
				$_SESSION['email'] = $email;
				$_SESSION['fisherid'] = $row['fisherid'];
				$_SESSION['name'] = $row['name'];
				header("Location: bookTripSignedIn.php");
				die(); // we always include a die after redirects.
			}
			else
			{
				$badLogin = true;
			}
		}
		else
		{
			$badLogin = true;
		}
	}
	catch (PDOException $ex) 
	{
	   echo "Error!: " . $ex->getMessage();
	   die(); 
	}	
}
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt - Book Trip
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<h1>
				Please Sign In
			</h1>
			<form action = "bookTrip.php" method = "POST"> 
				<input type = "text" name = "email" /> - Email
				<br/>
				<input type = "password" name = "password" /> - Password
				<br/>
				<input type = "submit" value = "Enter"/>
			</form>
			
			<br/>
			<br/>
			NewUser
			<br/>
			<form action = "bookTripRegisterUser.php" method = "POST"> 
				<input type = "text" name = "name" /> - Name
				<br/>
				<input type = "text" name = "email" /> - Email
				<br/>
				<input type = "password" name = "password" /> - Password
				<br/>
				<input type = "submit" value = "Enter"/>
			</form>
			
		</div>
	</body>
</html>