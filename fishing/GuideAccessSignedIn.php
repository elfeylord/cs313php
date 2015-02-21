<?php
	session_start();
?>
<!DOCTYPE html>

<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<a href="GuideAccessSignOut.php">Sign Out</a>
			<br/>
			<br/>
			<?php
				
				
				$guideid = $_SESSION['guideid'];
				$username = $_SESSION['g_username'];
				
				require('dbSetup.php');
				//grab what is in guideSighIn.php and put it here to show to the guide.	
				
				$id_booked = array();
				$id_planned = array();
				$date_booked = array();
				$date_planned = array();
				$lakename_booked = array();
				$fishername_booked = array();
				$fisheremail_booked = array();
				
				require('dbSetup.php');
				try
				{
					
					$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
					//throws an exception when there are problems
					$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
					
					$query = "select information from guide where guideid = :guideid";
					
					$statement = $db->prepare($query);
					$statement->bindParam(':guideid', $guideid);
					$statement->execute();
					
					$row = $statement->fetch(PDO::FETCH_ASSOC);
					$information = $row['information'];
					
					$query = "select tripid, date, lakeid, fisherid from trip where guideid = :guideid;";
					
					$statement = $db->prepare($query);
					$statement->bindParam(':guideid', $guideid);
					$statement->execute();
					
					while($row = $statement->fetch(PDO::FETCH_ASSOC))
					{
						if ($row["fisherid"] === null)
						{
							array_push($id_planned, $row["tripid"]);
							array_push($date_planned, $row["date"]);
						}
						else
						{
							array_push($id_booked, $row["tripid"]);
							array_push($date_booked, $row["date"]);
							
							$query = "SELECT name FROM lake where lakeid = ':lakeid';";
							$data = $db->prepare($query);
							$data->bindParam(':lakeid', $row["lakeid"]);
							$data->execute();
							$row2 = $data->fetch(PDO::FETCH_ASSOC);
							
							array_push($lakename_booked, $row2["name"]);
							
							$query = "SELECT name, email FROM fisher where fisherid = ':fisherid';";
							$data = $db->prepare($query);
							$data->bindParam(':fisherid', $row["fisherid"]);
							$data->execute();
							$row2 = $data->fetch(PDO::FETCH_ASSOC);
							
							$data = $db->query();
							$row2 = $data->fetch(PDO::FETCH_ASSOC);
							array_push($fishername_booked, $row2["name"]);
							array_push($fisheremail_booked, $row2["email"]);
						}
					}
					echo(
					" Non-Booked Trips:
					<br/>
					<table>
						<tr>
							<td>Trip ID</td>
							<td>Date</td>
						</tr>");
						
					for ($i = 0; $i < sizeof($id_planned); $i+=1)
					{
						$id = $id_planned[$i];
						$date = $date_planned[$i];
						echo(
						"<tr>
							<td>" . $id . "</td>
							<td>" . $date . "</td>
						</tr>");
					}
					echo("
					</table>");
					
					
					echo ("
					<br/><br/>
					Booked Trips:
					<br/>
					<table>
						<tr>
							<td>Trip ID</td>
							<td>Date</td>
							<td>Lake</td>
							<td>Fisher Name</td>
							<td>Fisher Email</td>
						</tr>");
					for ($i = 0; $i < sizeof($id_booked); $i+=1)
					{
						$id = $id_booked[$i];
						$date = $date_booked[$i];
						$lake = $lakename_booked[$i];
						$name = $fishername_booked[$i];
						$email = $fisheremail_booked[$i];
						echo("<tr><td>" . $id . "</td><td>" . $date . "</td><td>" . $lake . "</td><td>" . $name . "</td><td>" . $email . "</tr>");
					}
					echo ("
					</table>");
					
					echo ("
						<br/><br/>
						Change information:
						<form id = 'changeInfo' action = 'GuideAccessChangeInfo.php' method = 'POST'>
							<textarea form = 'changeInfo' name = 'information'>" . $information . "</textarea> - Information
							<br />
							<input type = 'submit' value = 'Enter'/>
						</form>");
						
					echo("
						<br/>
						<br/>
						Lakes you guide:
						");
					
					$query = "select lake.name from lakeguide join lake on lakeguide.lakeID = lake.lakeID where lakeguide.guideid = :guideid;";
					
					$statement = $db->prepare($query);
					$statement->bindParam(':guideid', $guideid);
					$statement->execute();
					
					$guideLakes = array();
					
					while($row = $statement->fetch(PDO::FETCH_ASSOC))
					{
						echo("<p>" . $row['name'] . "</p>");
						array_push($guideLakes, $row["name"]);
					}
					
					
					if (sizeof($guideLakes) < 6)
					{
						echo("
						<br/>
						<br/>");
						echo("
						Add Lake:
						<form action = 'GuideAccessAddLake.php' method = 'POST'>");
						
						
						$query = "select name, lakeid from lake ";
						$counter = 0;
						foreach ( $guideLakes as $lakeName)
						{
							if ($counter == 0)
							{
								$query .= "WHERE name != '" . $lakeName . "' ";
							}
							else
							{
								$query .= " AND name != '" . $lakeName . "' ";
							}
							$counter += 1;
							
						}
						$query .= ";";
						
						$statement = $db->prepare($query);
						$statement->execute();
						
						while($row = $statement->fetch(PDO::FETCH_ASSOC))
						{
							echo("
								<input type = 'radio' name = 'lake' value = '" . $row["lakeid"] . "'/>"
								. $row["name"] .
								"<br/>");
						}
						echo ("<input type = 'submit' value = 'Enter'/>
						</form>");
					}
					
					echo ("
					<br/>
					<br/>
					Create New Trip
					<form id = 'createTrip' action = 'GuideAccessCreateTrip.php' method = 'POST'>
							<select type = 'list' id = 'month' name = 'month' form = 'createTrip'>
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
						</select>");
						echo ("<select type = 'list' name = 'day' id = 'day' form = 'createTrip'>");
						echo("<option value = '" . "01" . "'selected = 'selected'/>" . 1);
						for ($i = 2; $i < 10; $i++)
						{
							echo("<option  value = '" . "0" . $i . "'/>" . $i);
							
						}
						for ($i = 10; $i < 32; $i++)
						{
							echo("<option value = '" . $i . "'/>" . $i);
							
						}
							
					echo("</select>");
					echo("<select type = 'list' name = 'year' id = 'year' form = 'createTrip'>
							<option value = '" . (intval(date("Y"))) . "'selected = 'selected'/>" . (intval(date("Y"))) .
							"<option value = '" . (intval(date("Y")) + 1) . "'/>" . (intval(date("Y")) + 1) .
							"<option value = '" . (intval(date("Y")) + 2) . "'/>" . (intval(date("Y")) + 2) .
							"<option value = '" . (intval(date("Y")) + 3) . "'/>" . (intval(date("Y")) + 3) .
							"<option value = '" . (intval(date("Y")) + 4) . "'/>" . (intval(date("Y")) + 4) .
							"<option value = '" . (intval(date("Y")) + 5) . "'/>" . (intval(date("Y")) + 5) .
						"</select>");
					echo ("<input type = 'submit'/>");
					echo ("</form>");
					
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