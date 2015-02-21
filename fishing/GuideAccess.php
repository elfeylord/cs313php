<?php 
/****************************
* Cole McAllister
* Sign in page for guides
*
******************************/


session_start();

if(isset($_SESSION['g_username']))
{
	header("Location: GuideAccessSignedIn.php");
	die(); // we always include a die after redirects.
}

require("password.php");

$badLogin = false;

//check if the we have post variables, if so check if they are correct
if (isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//the information for the DB
	require('dbSetup.php');
	
	//create the PDO
	try
	{
		
		$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
		//throws an exception when there are problems
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$query = "SELECT password, guideid, information FROM guide where username = :username;";
		
		$statement = $db->prepare($query);
		$statement->bindParam(':username', $username);
		$results = $statement->execute();
		
		if ($results)
		{
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$hashedPassword = $row['password'];
			if (password_verify($password, $hashedPassword))
			{
				$_SESSION['g_username'] = $username;
				$_SESSION['guideid'] = $row['guideid'];
				$_SESSION['information'] = $row['information'];
				header("Location: GuideAccessSignedIn.php");
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
			Reese's Fish Hunt - Guide Others
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<h1>
				<?php
				if ($badLogin)
				{
					echo "Incorrect username or password!";
				}
				else
				{
					echo "Welcome guides!";
				}
				?>
			</h1>
			<form id = "oldForm" action = "guideAccess.php" method = "POST"> 
				<div>Sign in:</div>
				<input type = "text" name = "username" /> - UserName
				<br/>
				<input type = "password" name = "password" /> - Password
				<br/>
				<input type = "submit" value = "Enter"/>
			</form>
			<br/>
			<form id = "newForm" action = "GuideAccessRegisterGuide.php" method = "POST">
				<div>New Guide:</div>
				<input type = "text" name = 'username' /> - UserName
				<br/>
				<input type = "password" name = 'password'/> - Password
				<br/>
				<textarea form = 'newForm' name = 'information'></textarea> - Information
				<br />
				<input type = "submit" value = "Enter"/>
			</form>
		</div>
	</body>
</html>