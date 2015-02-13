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
				$lakeid = $_POST['lake'];				
				$guideid = $_COOKIE["guideid"];
				
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
				$query = "INSERT INTO lakeguide(guideid, lakeid) VALUES($guideid, $lakeid);";
				$statement = $db->prepare($query);
				$statement->execute();
				echo "<h1> Your new lake has been added</h1>";
			?>		
		</div>
	</body>
</html>