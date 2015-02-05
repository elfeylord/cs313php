<!DOCTYPE HTML>
<html>
	<head>
	</head>
	<body>
		<?php
			 $dbHost = "";
  $dbPort = "";
  $dbUser = "";
  $dbPassword = "";

     $dbName = "fishing";

     $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

     if ($openShiftVar === null || $openShiftVar == "")
     {
          // Not in the openshift environment
          //echo "Using local credentials: "; 
          //require("setLocalDatabaseCredentials.php");
     }
     else 
     { 
          // In the openshift environment
          //echo "Using openshift credentials: ";

          $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
          $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT'); 
          $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
          $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
     } 
     //echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";

     $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
			/*try
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
			}*/
			foreach ($db->query("SELECT name, password, email FROM scriptures;") as $row)
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