<?php
	$myfile = fopen("data.txt", "r") or die("unable to open file!");
	
	for ($i = 0; $i < 16; $i++)
	{
		$data[$i] = fgets($myfile);
	}
	fclose($myfile);
	
	if (isset($_COOKIE["chocolateChip"]))
	{
		if (!isset($_POST["best"]))
		{
			if ($_COOKIE["chocolateChip"] == "-1")
			{
				setcookie("chocolateChip", "-1", time() + 30 * 60);
			}
		}	
		else if ($_COOKIE["chocolateChip"] == "-1")
		{
			if( $_POST["best"] == "luke")
			{
				$data[0] += 1;
			}
			else if ($_POST["best"] == "leah")
			{
				$data[1] += 1;
			}
			else
			{
				$data[2] += 1;
			}
			
			if( $_POST["color"] == "blue")
			{
				$data[3] += 1;
			}
			else if ($_POST["color"] == "green")
			{
				$data[4] += 1;
			}
			else if ($_POST["color"] == "pink")
			{
				$data[5] += 1;
			}
			else if ($_POST["color"] == "purple")
			{
				$data[6] += 1;
			}
			else
			{
				$data[7] += 1;
			}
			
			if( $_POST["movie"] == "1")
			{
				$data[8] += 1;
			}
			else if ($_POST["movie"] == "2")
			{
				$data[9] += 1;
			}
			else if ($_POST["movie"] == "3")
			{
				$data[10] += 1;
			}
			else if ($_POST["movie"] == "4")
			{
				$data[11] += 1;
			}
			else if ($_POST["movie"] == "5")
			{
				$data[12] += 1;
			}
			else
			{
				$data[13] += 1;
			}
			
			if ($_POST["removed"] == "jarjar")
			{
				$data[14] += 1;
			}
			else
			{
				$data[15] += 1;
			}
			
			$myfile = fopen("data.txt", "w");
			for ($i = 0; $i < 16; $i++)
			{
				fwrite($myfile, (int)$data[$i] . "\n"); 	
			}
			fclose($myfile);
			setcookie("chocolateChip", "1", time() + 30 * 60);
		}
	}
	
?>

<!DOCTYPE>
<html>
	<head>
		<title>Results</title>
	</head>
	<body>
		<h1> Results </h1>
		
		<h2> Who is the best character?</h2>
		<table>
			<tr>
				<td>Luke</td>
				<td><?php echo($data[0]);?></td>
			</tr>
			<tr>
				<td>Leah</td>
				<td><?php echo($data[1]);?></td>
			</tr>
			<tr>
				<td>Han</td>
				<td><?php echo($data[2]);?></td>
			</tr>
		</table>
		<h2> What is the best light-saber color?</h2>
		<table>
			<tr>
				<td>Blue</td>
				<td><?php echo($data[3]);?></td>
			</tr>
			<tr>
				<td>Green</td>
				<td><?php echo($data[4]);?></td>
			</tr>
			<tr>
				<td>Pink</td>
				<td><?php echo($data[5]);?></td>
			</tr>
			<tr>
				<td>Purple</td>
				<td><?php echo($data[6]);?></td>
			</tr>
			<tr>
				<td>Red</td>
				<td><?php echo($data[7]);?></td>
			</tr>
		</table>
		<h2> Which movie was the best?</h2>
		<table>
			<tr>
				<td>Movie 1</td>
				<td><?php echo($data[8]);?></td>
			</tr>
			<tr>
				<td>Movie 2</td>
				<td><?php echo($data[9]);?></td>
			</tr>
			<tr>
				<td>Movie 3</td>
				<td><?php echo($data[10]);?></td>
			</tr>
			<tr>
				<td>Movie 4</td>
				<td><?php echo($data[11]);?></td>
			</tr>
			<tr>
				<td>Movie 5</td>
				<td><?php echo($data[12]);?></td>
			</tr>
			<tr>
				<td>Movie 6</td>
				<td><?php echo($data[13]);?></td>
			</tr>
		</table>
			<h2> What character should be removed?</h2>
		<table>
			<tr>
				<td>Jar Jar</td>
				<td><?php echo($data[14]);?></td>
			</tr>
			<tr>
				<td>C3P0</td>
				<td><?php echo($data[15]);?></td>
			</tr>
		</table>
	</body>

</html>