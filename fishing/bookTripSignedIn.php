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
			<?php
				$p = $_POST['password'];
				$e = $_POST['email'];
				
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
				
				$query = "SELECT fisherid FROM fisher where email LIKE '" . $e . "' AND password like '" . $p . "';";
				$statement = $db->prepare($query);
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				if ($row['fisherid'] === null)
				{
					echo("<p>Invalid UserName or Password!</p>");
				}
				else
				{
					$fisherid = $row["fisherid"];
					setcookie("fisherid", $fisherid, time() + 30 * 60);
					echo("<h1> welcome! </h1>");
					require('tripList.php');					
				}
			?>
			
		</div>
	</body>
</html>