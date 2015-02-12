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
			<p>GUIDES</p>
			<?php
				//Get the POST variables
				echo("<p>all is well 1</p>");
				$username = $_POST['username'];
				$password = $_POST['password'];
				$information = $_POST['information'];
				echo("<p>all is well 2</p>");
				//Get the access variables
				$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
				$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
				$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
				$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
				//open the DB
				echo("<p>all is well 3</p>");
				try
				{
					//$user = "php";
					//$password = "php-pass"; 
					$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
					echo("<p>all is well 4</p>");
					$query = 'INSERT INTO guide(information, username, password) VALUES(:information, :username, :password)';
					echo("<p>all is well 4.2</p>");
					$statement = $db->prepare($query);
					$statement->bindParam(':information', $information);
					$statement->binfParam(':username', $username);
					$statement->bindParam(':password', $password);
					$statement->execute();
					echo("<p>all is well 5</p>");
					echo("<h1>" . $username . "You have now registered </h1>");
				
				}
				catch (PDOException $ex) 
				{
				   echo "Error!: " . $ex->getMessage();
				   die(); 
				}
				
			?>
		</div>
	</body>
</html>