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
				require('tripList.php');					
					
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
						echo ("<form id = 'trips' action = 'addBookedTrip.php' method = 'POST'>");
						
						foreach ($data = $db->query("select * from trip where date_format(date, '%Y-%m-%d') between '" . 
											$year . "-" . $month . "-01' AND '" . $year . "-" . $month . "-31';") as $row)
						{
							if ( $row["fisherID"] === null)
							{
								$data2 = $db->query("select username from guide where guideid like '%" . $row["guideID"] . "%';");
								$row2 = $data2->fetch(PDO::FETCH_ASSOC);
								$tripid = $row['tripID'];
								echo ("<input type = 'radio' name = 'trip' form = 'trips' value = '$tripid'/>" . $row["date"] . " by " . $row2["username"] . "<br/>");	
							}
							else
							{
											
								
							}
						}
						echo "<select type = 'list' name = 'lakeid' id = 'lakeid' form = 'trips'>";
						foreach ( $db->query('select name, lakeid from lake;') as $row)
						{
							$lakeid = $row['lakeid'];
							echo("<option value = '$lakeid'/>" . $row['name']);
						}
						echo "</select>";
						echo ("<input type = 'submit' value = 'Sign up'/>");
						
						echo("</form>");
					}		
					
			?>
			
		</div>
	</body>
</html>