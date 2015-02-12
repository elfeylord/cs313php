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
				$username = $_POST['username'];
				$password = $_POST['password'];
				$information = $_POST['information'];
				
				//Get the access variables
				$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
				$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
				$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
				$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
				//open the DB
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
				
				$query = 'INSERT INTO guide(information, username, password) VALUES(:information, :username, :password)';
				$statement = $db->prepare($query);
				statement->bindParam(':information', $information);
				statement->binfParam(':username', $username);
				statement->bindParam(':password', $password);
				$statement->execute();
				echo("<h1>" . $username . "You have now registered </h1>");
			?>
		</div>
	</body>
</html>