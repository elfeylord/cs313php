<?php
	session_start();
	$year = $_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];
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

	$query = "INSERT INTO trip (date, guideid) VALUES('$year$month$day', $guideid);";
	$statement = $db->prepare($query);

	//$statement->bindParam(':day', $day);
	//$statement->bindParam(':month', $month);
	//$statement->bindParam(':year', $year);
	//$statement->bindParam(':guideid', $guideid);
	$statement->execute();
	

	header("Location: GuideAccessSignedIn.php");
	die();
	
	
?>		

				
			
			