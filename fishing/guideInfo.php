<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt - Guide Info
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<h1>
				Welcome to the Guide Info
			</h1>
			<?php
			//Get the variables
			require('dbSetup.php');
			//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
			//check if it is good to access the DB
			try
			{
			   $user = "php";
			   $password = "php-pass"; 
			   $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
			}
			catch (PDOException $ex) 
			{
			   echo "Error!: " . $ex->getMessage();
			   die(); 
			}

			//display all of the guide names
			echo ("<select type = 'list' id = 'guide' name = 'guide' form = 'guideForm'>");
			foreach ($db->query("SELECT username FROM guide;") as $row)
			{
			   echo ("<option value ='" . $row['username'] . "'/>");
			   echo ($row['username']);
			}
			//form to access the guide names
			echo ("
			</select>			
			<form id = 'guideForm' action = 'guideDisplay.php' method = 'POST'>
			
			<input type = 'submit' value = 'Look up' />
			</form>
			");
		?>
		</div>
	</body>
</html>