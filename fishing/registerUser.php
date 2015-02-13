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
				$name = $_POST['name'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				
				//Get the access variables	
				require('dbSetup.php');
				
				//open the DB
				try
				{
					
					if( $name == "" || $password == ""|| $email == "")
					{
						echo("<h1> Error, you must fill in all of the fields.</h1>");
					}
					else
					{
						$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
						
						$query = "SELECT fisherid FROM fisher WHERE name LIKE '$name' OR email LIKE '$email';";
						$statement = $db->prepare($query);
						$statement->execute();
						$row = $statement->fetch(PDO::FETCH_ASSOC);
						
						if($row['fisherid'] === null)
						{
							$query = 'INSERT INTO fisher(name, password, email) VALUES(:name, :password, :email);';
							$statement = $db->prepare($query);
							$statement->bindParam(':name', $name);
							$statement->bindParam(':password', $password);
							$statement->bindParam(':email', $email);
							$statement->execute();
							echo("<h1>" . $name . ", you have now registered </h1>");
						}
						else
						{
							echo "That name or email has already been taken.";
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