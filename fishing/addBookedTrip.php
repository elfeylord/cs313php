<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt - Guide Others Registration
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<?php
				//Get the POST variables
				
				if (isset($_POST['trip']))
				{
					$tripid = $_POST['trip'];
					$lakeid = $_POST['lakeid'];
					$fisherid = $_COOKIE["fisherid"];
					//Get the access variables	
					require('dbSetup.php');
					
					//open the DB
					try
					{						
						$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
						
						
						$query = "UPDATE trip SET lakeid='$lakeid', fisherid='$fisherid' WHERE tripid=$tripid;";
						$statement = $db->prepare($query);
						$statement->execute();
						$row = $statement->fetch(PDO::FETCH_ASSOC);
						echo "<h1> Trip Set </h1>";
					}
					catch (PDOException $ex) 
					{
					   echo "Error!: " . $ex->getMessage();
					   die(); 
					}
					
				}
				else
				{
					echo"<h1>You did not select a trip</h1>";
				}
				
			?>
		</div>
	</body>
</html>