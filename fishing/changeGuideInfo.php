<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<?php
				$information = $_POST['information'];
				$cookie = $_COOKIE["guideid"];
				require('dbSetup.php');
				
				try
				{
				   $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
				}
				catch (PDOException $ex) 
				{
				   echo "Error!: " . $ex->getMessage();
				   die(); 
				}
				$query = "UPDATE guide SET information='$information' WHERE guideid=$cookie;";
				$statement = $db->prepare($query);
				$statement->execute();
				echo "<h1> Your information has been changed </h1>";
			?>		
		</div>
	</body>
</html>