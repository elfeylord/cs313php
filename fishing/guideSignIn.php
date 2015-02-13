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
			<?php
				$p = $_POST['password'];
				$u = $_POST['username'];
				echo "Password: $p, and Username: $u";
				require('dbSetup.php');
				
				try
				{
				   $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=fishing", $dbUser, $dbPassword);
				}
				catch (PDOException $ex) 
				{
				   echo "Error!: " . $ex->getMessage();
				   die(); 
				}
				
				$query = "SELECT guideid, information FROM guide where username LIKE '$u' AND password like '$p';";
				$statement = $db->prepare($query);
				$statement->execute();
				$row = $statement->fetch(PDO::FETCH_ASSOC);
				echo "guideInfo:" . $row['information'];
				if ($row['guideid'] === null)
				{
					echo("<p>Invalid UserName or Password!</p>");
				}
				else
				{
					$information = $row['information'];
					$guideid = $row['guideid'];
					setcookie("guideid", $guideid, time() + 30 * 60);
					
					$id_booked = array();
					$id_planned = array();
					$date_booked = array();
					$date_planned = array();
					$lakename_booked = array();
					$fishername_booked = array();
					$fisheremail_booked = array();
					
					
					foreach($db->query("select tripid, date, lakeid, fisherid from trip where guideid like '%" . $guideid . "%';") as $row)
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
							$data = $db->query("SELECT name FROM lake where lakeid LIKE '" . $row["lakeid"] . "';");
							$row2 = $data->fetch(PDO::FETCH_ASSOC);
							array_push($lakename_booked, $row2["name"]);
							$data = $db->query("SELECT name, email FROM fisher where fisherid LIKE '" . $row["fisherid"] . "';");
							$row2 = $data->fetch(PDO::FETCH_ASSOC);
							array_push($fishername_booked, $row2["name"]);
							array_push($fisheremail_booked, $row2["email"]);
						}
					}
					
					
					echo (" Non-Booked Trips:
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
						echo("<tr><td>" . $id . "</td><td>" . $date . "</td></tr>");
					}
					echo("</table>");
					
					
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
					echo ("</table>");
					
					echo ("
						<br/><br/>
						Change information:
						<form id = 'changeInfo' action = 'changeGuideInfo.php' method = 'POST'>
							<textarea form = 'changeInfo' name = 'information'>" . $information . "</textarea> - Information
							<br />
							<input type = 'submit' value = 'Enter'/>
						</form>");
						
					echo("
						<br/>
						<br/>
						Lakes:
						");
					foreach ( $db->query("select lake.name from lakeguide join lake on lakeguide.lakeID = lake.lakeID where lakeguide.guideid like '%" . $guideid . "%';") as $row)
					{
						echo("<p>" . $row['name'] . "</p>");
					}
					echo("
					<br/>
					<br/>
					Add Lake:
					<form action = ''>");
						foreach ( $db->query('select name from lake;') as $row)
						{
							echo("
								<input type = 'radio' name = 'lake' value = '" . $row["name"] . "'/>"
								. $row["name"] .
								"<br/>");
						}
					echo ("<input type = 'button' value = 'Enter'/>
					</form>");
					
					echo ("
					<br/>
					<br/>
					Create New Trip
					<form id = 'createTrip' action = 'createTrip.php' method = 'POST'>
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
			?>
			
			
			
			
		
		</div>
	</body>
</html>