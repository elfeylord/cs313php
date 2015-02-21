<?php
	session_start();
	
	$tripid = $_POST['trip'];
	$lakeid = $_POST['lakeid'];
	$fisherid = $_SESSION["fisherid"];
	
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

	$query = "UPDATE trip SET lakeid='$lakeid', fisherid='$fisherid' WHERE tripid=$tripid;";
	$statement = $db->prepare($query);
	//$statement->bindParam(':lakeid', $lakeid);
	//$statement->bindParam(':fisherid', $fisherid);
	//$statement->bindParam(':tripid', $tripid);
	$statement->execute();
	
	header("Location: bookTripSignedIn.php");
	die();
?>	