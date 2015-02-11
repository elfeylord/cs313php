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
				try
				{
				   $user = "php";
				   $password = "php-pass"; 
				   $db = new PDO("mysql:host=localhost;dbname=fishing", $user, $password);
				}
				catch (PDOException $ex) 
				{
				   echo "Error!: " . $ex->getMessage();
				   die(); 
				}
				$data = $db->query("SELECT guideid, information FROM guide where username LIKE '" . $u . "' AND password like '" . $p . "';");
				$row = $data->fetch(PDO::FETCH_ASSOC);
				if ($row['guideid'] === null)
				{
					echo("<p>Invalid UserName or Password!</p>");
				}
				else
				{
					$information = $row['information'];
					$guideid = $row['guideid'];
					
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
						<form>
							<textarea form = 'newForm'>" . $information . "</textarea> - Information
							<br />
							<input type = 'button' value = 'Enter'/>
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
					<form action = ''>
						Month<input type = 'text' name = 'month' />
						<br/>
						Day<input type = 'text' name = 'day' />
						<br/>
						Year<input type = 'text' name = 'year' />
						</br>
						<input type = 'button' value = 'Enter'/>
					</form>
					");
				}
			?>
			
			
			
			
		
		</div>
	</body>
</html>