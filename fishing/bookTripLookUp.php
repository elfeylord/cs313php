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
				
				$year = $_POST['year'];
				$month = $_POST['month'];
					
					
				require('dbSetup.php');
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
				
				//$fisherid = $row["fisherid"];
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
							"<option value = '" . (intval(date("Y")) + 1) . "' />" . (intval(date("Y")) + 1) .
							"<option value = '" . (intval(date("Y")) + 2) . "'/>" . (intval(date("Y")) + 2) .
							"<option value = '" . (intval(date("Y")) + 3) . "'/>" . (intval(date("Y")) + 3) .
							"<option value = '" . (intval(date("Y")) + 4) . "'/>" . (intval(date("Y")) + 4) .
							"<option value = '" . (intval(date("Y")) + 5) . "'/>" . (intval(date("Y")) + 5) .
						"</select>
					<form id = 'lookup' action = 'bookTripLookUp.php' method = 'POST'>
						<input type = 'submit' value = 'Enter'/>
						
					</form>");					
					
					$data = $db->query("select * from trip where date_format(date, '%Y-%m-%d') between '" . 
										$year . "-" . $month . "-01' AND '" . $year . "-" . $month . "-31';");
					$row = $data->fetch(PDO::FETCH_ASSOC);
					if ($row["guideID"] === null )
					{
						echo("There are no trips on this month. Please try a new date");
					}
					else
					{
						echo ("Select a trip<br/>");
						echo ("<form id = 'trips'>");
						
						foreach ($data = $db->query("select * from trip where date_format(date, '%Y-%m-%d') between '" . 
											$year . "-" . $month . "-01' AND '" . $year . "-" . $month . "-31';") as $row)
						{
							if ( $row["fisherID"] === null)
							{
								$data2 = $db->query("select username from guide where guideid like '%" . $row["guideID"] . "%';");
								$row2 = $data2->fetch(PDO::FETCH_ASSOC);
								echo ("<input type = 'checkbox' name = 'trip'/ form = 'trips'>" . $row["date"] . " by " . $row2["username"] . "<br/>");	
							}
							else
							{
											
								
							}
						}
						echo ("<input type = 'button' value = 'Sign up'/>");
						echo("</form>");
					}		
					
			?>
			
		</div>
	</body>
</html>