<!DOCTYPE HTML>
<html>
	<head>
	</head>
	<body>
		<?php
			 $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br />\n";
			try
			{
			   $user = "php";
			   $password = "php-pass"; 
			   $db = new PDO("mysql:host=localhost;dbname=fishing", $user, $password);
			   //$db = new PDO("mysql:host=localhost;dbname=scripture", $user, $password);
			}
			catch (PDOException $ex) 
			{
			   echo "Error!: " . $ex->getMessage();
			   die(); 
			}
			echo ("we are in the  stuff");
			foreach ($db->query("SELECT name, password, email FROM fisher;") as $row)
			{
			   echo "<p>" . $row['password'] . " " . $row['name'] . ":" . $row['email'] . " ";
			   echo "</p>";
			   echo "<br />";
			}
		?>
		<p>
			TESTING TO SEE OUTPUT
		</p>
	</body>
</html>