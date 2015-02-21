<?php
	session_start();
?>
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
			<a href="bookTripSignOut.php">Sign Out</a>
			<br/>
			<br/>
			<?php
				$fisherid = $_SESSION['fisherid'];
				$name = $_SESSION['name'];
				$email = $_SESSION['email'];
				
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
				
				echo("<h1> welcome! </h1>");
				
				//your trips
				$query = "select tripid, date, lakeid, guideid from trip where fisherid = :fisherid;";
					
				$statement = $db->prepare($query);
				$statement->bindParam(':fisherid', $fisherid);
				$statement->execute();
				echo(
				"Booked Trips:
				<table>
					<tr>
						<td>Trip ID</td>
						<td>Date</td>
						<td>Lake</td>
						<td>Guide</td>
					</tr>");
				while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				{
					$query = "SELECT name FROM lake where lakeid = '". $row['lakeid'] . "';";
					$data = $db->prepare($query);
					$data->bindParam(':lakeid', $row["lakeid"]);
					$data->execute();
					$row2 = $data->fetch(PDO::FETCH_ASSOC);
					$lakename = $row2['name'];
					
					$query = "SELECT username FROM guide where guideid = '". $row['guideid'] . "';";
					$data = $db->prepare($query);
					$data->bindParam(':guideid', $row["guideid"]);
					$data->execute();
					$row2 = $data->fetch(PDO::FETCH_ASSOC);
					$guideusername = $row2['username'];
					
					echo("<tr><td>" . $row['tripid'] . "</td><td>" . $row['date'] . "</td><td>$lakename</td><td>$guideusername</td></tr>");
					
				}
				echo("
				</table>");
				
				require('tripList.php');
				if(isset($_POST['year']) && isset($_POST['month']))
				{
					$year = $_POST['year'];
					$month = $_POST['month'];
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
						echo ("<form id = 'trips' action = 'bookTripAddTrip.php' method = 'POST'>");
						
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
				}
			?>
			
		</div>
	</body>
</html>