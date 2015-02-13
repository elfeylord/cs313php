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
				$username = $_POST['username'];
				$password = $_POST['password'];
				$information = $_POST['information'];
				
				//Get the access variables	
				require('dbSetup.php');
				
				//open the DB
				try
				{
					
					if( $username == "" || $password == ""|| $information == "")
					{
						echo("<h1> Error, you must fill in all of the fields.</h1>");
					}
					else
					{
						$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
						$query = "SELECT guideid FROM guide WHERE username LIKE '$username';";
						$statement = $db->prepare($query);
						$statement->execute();
						$row = $statement->fetch(PDO::FETCH_ASSOC);
						
						if($row['guideid'] === null)
						{
							$query = 'INSERT INTO guide(information, username, password) VALUES(:information, :username, :password)';
							$statement = $db->prepare($query);
							$statement->bindParam(':information', $information);
							$statement->bindParam(':username', $username);
							$statement->bindParam(':password', $password);
							$statement->execute();
							echo("<h1>" . $username . ", you have now registered </h1>");
						}
						else
						{
							echo "$username is already a guide";
						}
					}
				
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