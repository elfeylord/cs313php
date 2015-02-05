<!DOCTYPE HTML>
<html>
	<head>
	</head>
	<body>
		<?php
			try
			{
			   $user = "php";
			   $password = "php-pass"; 
			   $db = new PDO("mysql:host=127.2.193.130;dbname=fishing", $user, $password);
			   //$db = new PDO("mysql:host=localhost;dbname=scripture", $user, $password);
			}
			catch (PDOException $ex) 
			{
			   echo "Error!: " . $ex->getMessage();
			   die(); 
			}
			foreach ($db->query("SELECT name, password, email FROM scriptures;") as $row)
			{
			   echo "<p>" . $row['password'] . " " . $row['name'] . ":" . $row['email'] . " ";
			   echo "</p>";
			   echo "<br />";
			}
		?>
	</body>
</html>