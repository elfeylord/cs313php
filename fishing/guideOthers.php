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
				Welcome guides!
			</h1>
			
			<form action = "guideSignIn.php" method = "POST"> 
				<input type = "text" name = "username" /> - UserName
				<br/>
				<input type = "password" name = "password" /> - Password
				<br/>
				<input type = "submit" value = "Enter"/>
			</form>
			<p>New Guide</p>
			<form id = 'newForm' >
				<input type = "text" /> - UserName
				<br/>
				<input type = "text" /> - Password
				<br/>
				<textarea form = 'newForm'> </textarea> - Information
				<br />
				<input type = "submit" value = "Enter"/>
			</form>
		</div>
	</body>
</html>