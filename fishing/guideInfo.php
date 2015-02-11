<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt - Guide Info
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<h1>
				Welcome to the Guide Info
			</h1>
			<?php
			$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
			$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
			$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
			$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
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

			echo ("<select type = 'list' id = 'guide' name = 'guide' form = 'guideForm'>");
			foreach ($db->query("SELECT username FROM guide;") as $row)
			{
			   echo ("<option value ='" . $row['username'] . "'/>");
			   echo ($row['username']);
			}
			echo ("
			</select>			
			<form id = 'guideForm' action = 'guideDisplay.php' method = 'POST'>
			
			<input type = 'submit' value = 'Look up' />
			</form>
			");
		?>
		</div>
	</body>
</html>