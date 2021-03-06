<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt - Guide Display
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<?php
				//Get the access variables
				require('dbSetup.php');
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
				
				echo ("<h1>");
				echo ($_POST['guide']);
				echo ("</h1>");
				echo ("<h2> Guide information: </h2>");
				echo ("<p>");
				//Get the guide information
				$data = $db->query("SELECT information, guideid FROM guide where username LIKE '" . $_POST['guide'] . "';");
				$row = $data->fetch(PDO::FETCH_ASSOC);
				echo ($row["information"] . "</p>");
				echo ("<h2> Lakes: </h2>");
				//display what lakes he guides on
				foreach ( $db->query("select lake.name from lakeguide join lake on lakeguide.lakeID = lake.lakeID where lakeguide.guideid like '%" . $row["guideid"] . "%';") as $row2)
				{
					echo("<p>" . $row2['name'] . "</p>");
				}
			?>
		</div>
	</body>
</html>