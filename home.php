<!DOCTYPE html>
<!--this is a comment-->
<html lang = "en">
	<head>
		<title> Cole's Home Page </title>
		<meta charset = "utf-8" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://mckaysmalley.com/js/bootstrap.min.js"></script>
		<link rel = "stylesheet" type = "text/css" href = "css/general.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap-3.3.1/dist/css/bootstrap.min.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap-3.3.1/dist/css/bootstrap.min.css" />
		<script>
			function change()
			{
				if (document.getElementById("picture").value == "3")
				{	
					document.getElementById("picture").src = "media/cole1.jpg";
					document.getElementById("picture").value = "1";
				}
				else if (document.getElementById("picture").value == "1")
				{
					document.getElementById("picture").src = "media/cole2.jpg";
					document.getElementById("picture").value = "2";
				}
				else
				{
					document.getElementById("picture").src = "media/cole3.jpg";
					document.getElementById("picture").value = "3";
				}	
			}
		</script>
	</head>
	<body>
	<?php include 'links.php';?>
		<div id = "wrapper">
			<h1>
				Cole's Home Page - Welcome!
			</h1>
			<hr/>	
			<img value = "1" id = "picture" class = "img-responsive pull-left" src = "media/cole1.jpg" height = "400" width = "500" alt = "Cole McAllister" onclick = "change()" />
			<div class = "right">
				<p>
					Hello, my name is Cole McAllister. I'm a computer science major.
				</p>
				<p>
					Bio: I'm from Redding California. I love the outdoors, which is odd because I love computers as well.
					I also enjoy ballroom dancing. It is something that I have been doing for many years now.
					You could pretty much say that I enjoy doing almost everything, as long as I have time to learn how to
					do it correctly.
				</p>
				<p>
					I have been a member all my life, and I served my mission in Argentina. I loved it, and hope to be able
					to continue to help others in any way that I can. Click the picture to see other pictures.
				</p>
			</div>	
			<hr/>
		</div>
	</body>
</html>