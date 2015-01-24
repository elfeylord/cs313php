<?php
	//-1 not voted
	//1 voted
	$number = 0;
	if (isset($_COOKIE["chocolateChip"]))
	{
		if ($_COOKIE["chocolateChip"] == "-1")
		{
			setcookie("chocolateChip", "-1", time() + 30 * 60);
		}
		else
		{
			setcookie("chocolateChip", "1", time() + 30 * 60);
			include("form.php");
			exit();
			
		}
	}
	else
	{
		setcookie("chocolateChip", "-1", time() + 30 * 60);
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title> HELLO! </title>
		<?php include '../cssAndJava.php';?>
		<script>
		
			
		</script>
	</head>
	<body>
		<?php include '../links.php';?>
		<div id = "wrapperSkinny" >
			<h1>Star Wars!</h1>
			<form action = "form.php" method = "POST">
				Who is the best character? <br/>
				<input type = "radio" name = "best" value = "luke" checked = "checked"/> Luke <br/>
				<input type = "radio" name = "best" value = "leah"/> Leah <br/>
				<input type = "radio" name = "best" value = "han"/> Han <br/>
				<br/>
				What is the best light-saber color? <br/>
				<input type = "radio" name = "color" value = "blue" checked = "checked"/> Blue <br/>
				<input type = "radio" name = "color" value = "green"/> Green <br/>
				<input type = "radio" name = "color" value = "pink"/> Pink <br/>
				<input type = "radio" name = "color" value = "purple"/> Purple <br/>
				<input type = "radio" name = "color" value = "red"/> Red <br/>
				<br/>
				Which movie was the best?<br/>
				<input type = "radio" name = "movie" value = "1" checked = "checked"/> Movie 1 <br/>
				<input type = "radio" name = "movie" value = "2"/> Movie 2 <br/>
				<input type = "radio" name = "movie" value = "3"/> Movie 3 <br/>
				<input type = "radio" name = "movie" value = "4"/> Movie 4 <br/>
				<input type = "radio" name = "movie" value = "5"/> Movie 5 <br/>
				<input type = "radio" name = "movie" value = "6"/> Movie 6 <br/>
				<br/>
				What character should be removed?<br/>
				<input type = "radio" name = "removed" value = "jarjar" checked = "checked"/> Jar Jar <br/>
				<input type = "radio" name = "removed" value = "c3po"/> C3P0 <br/>
				<input type = "submit" value = "submit"/>
				<input href = "form.php" type = "button" value = "Go to Results" onclick = "location.href='form.php'">
			</form>
			
		</div>
	</body>
</html>