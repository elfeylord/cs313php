<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>
			Reese's Fish Hunt - Guide Others
		</title>
		<?php include 'links.php';?>
	</head>
	<body>
		<?php include 'header.php';?>
		<div id = "wrapper">
			<h1>
				Welcome guides! Log in please.
			</h1>
			<form id = "oldForm" action = "guideSignIn.php" method = "POST"> 
				<input type = "text" name = "username" /> - UserName
				<br/>
				<input type = "password" name = "password" /> - Password
				<br/>
				<input type = "submit" value = "Enter"/>
			</form>
			<p>New Guide</p>
			<form id = "newForm" action = "registerGuide.php" method = "POST">
				<input type = "text" name = 'username' /> - UserName
				<br/>
				<input type = "text" name = 'password'/> - Password
				<br/>
				<textarea form = 'newForm' name = 'information'></textarea> - Information
				<br />
				<input type = "submit" value = "Enter"/>
			</form>
		</div>
	</body>
</html>