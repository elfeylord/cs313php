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
				$year = $_POST['year'];
				$month = $_POST['month'];
				$day = $_POST['day'];
				
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
				$query = "INSERT INTO trip (date, guideid) VALUES('$year$month$day', $cookie);";
				$statement = $db->prepare($query);
				$statement->execute();
				echo "<h1> Your trip has been created</h1>";
			?>		
		</div>
	</body>
</html>