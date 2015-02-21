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
			//Get the variables
			require('dbSetup.php');
			//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
			//check if it is good to access the DB
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

			//display all of the guide names
			echo ("<select type = 'list' id = 'guide' name = 'guide' form = 'guideForm'>");
			foreach ($db->query("SELECT username FROM guide;") as $row)
			{
			   echo ("<option value ='" . $row['username'] . "'/>");
			   echo ($row['username']);
			}
			//form to access the guide names
			echo ("
			</select>			
			<form id = 'guideForm' action = 'TheGuides.php' method = 'POST'>
			
			<input type = 'submit' value = 'Look up' />
			</form>
			");
			if(isset($_POST['guide']))
			{
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
			}
		?>
		</div>
	</body>
</html>