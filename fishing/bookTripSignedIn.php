<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt - Book Trip
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<?php
				$p = $_POST['password'];
				$e = $_POST['email'];
				
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
				$data = $db->query("SELECT fisherid FROM fisher where email LIKE '" . $e . "' AND password like '" . $p . "';");
				$row = $data->fetch(PDO::FETCH_ASSOC);
				if ($row['fisherid'] === null)
				{
					echo("<p>Invalid UserName or Password!</p>");
				}
				else
				{
					$fisherid = $row["fisherid"];
					echo("<h1> welcome! </h1>");
					echo("<p>Select the month you desire to fish on:</p>");
					echo("<select type = 'list' id = 'month' name = 'month' form = 'lookup'>
							<option value = '01' selected = 'selected'/> Jan
							<option value = '02'/> Feb
							<option value = '03'/> March
							<option value = '04'/> April
							<option value = '05'/> May
							<option value = '06'/> June
							<option value = '07'/> July
							<option value = '08'/> Aug
							<option value = '09'/> Sept
							<option value = '10'/> Oct
							<option value = '11'/> Nov
							<option value = '12'/> Dec
						</select>
						<select type = 'list' name = 'year' id = 'year' form = 'lookup'>
							<option value = '" . (intval(date("Y"))) . "'selected = 'selected'/>" . (intval(date("Y"))) .
							"<option value = '" . (intval(date("Y")) + 1) . "'/>" . (intval(date("Y")) + 1) .
							"<option value = '" . (intval(date("Y")) + 2) . "'/>" . (intval(date("Y")) + 2) .
							"<option value = '" . (intval(date("Y")) + 3) . "'/>" . (intval(date("Y")) + 3) .
							"<option value = '" . (intval(date("Y")) + 4) . "'/>" . (intval(date("Y")) + 4) .
							"<option value = '" . (intval(date("Y")) + 5) . "'/>" . (intval(date("Y")) + 5) .
						"</select>
					<form id = 'lookup' action = 'bookTripLookUp.php' method = 'POST'>
						<input type = 'submit' value = 'Enter'/>
						
					</form>");					
				}
			?>
			
		</div>
	</body>
</html>