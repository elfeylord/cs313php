<?php
	session_start();
	$lakeid = $_POST['lake'];
	$guideid = $_SESSION["guideid"];
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

	$query = "INSERT INTO lakeguide(guideid, lakeid) VALUES($guideid, $lakeid);";
	$statement = $db->prepare($query);
	//$statement->bindParam(':lakeid', $lakeid);
	//$statement->bindParam(':guideid', $guideid);
	$statement->execute();
	
	header("Location: GuideAccessSignedIn.php");
	die();
?>	