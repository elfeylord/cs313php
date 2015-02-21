<?php
	session_start();
	$information = $_POST['information'];
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

	$query = "UPDATE guide SET information='$information' WHERE guideid='$guideid';";
	$statement = $db->prepare($query);
	//$statement->bindParam(':information', $information);
	//$statement->bindParam(':guideid', $guideid);
	$statement->execute();
	

	header("Location: GuideAccessSignedIn.php");
	die();
	
	
?>		