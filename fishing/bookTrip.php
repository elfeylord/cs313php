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
			<h1>
				Please Sign In
			</h1>
			<form action = "bookTripSignedIn.php" method = "POST"> 
				<input type = "text" name = "email" /> - Email
				<br/>
				<input type = "password" name = "password" /> - Password
				<br/>
				<input type = "submit" value = "Enter"/>
			</form>
			
			<br/>
			<br/>
			NewUser
			<br/>
			<form action = "registerUser.php" method = "POST"> 
				<input type = "text" name = "name" /> - Name
				<br/>
				<input type = "text" name = "email" /> - Email
				<br/>
				<input type = "password" name = "password" /> - Password
				<br/>
				<input type = "submit" value = "Enter"/>
			</form>
			
		</div>
	</body>
</html>