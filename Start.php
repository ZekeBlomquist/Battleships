<!DOCTYPE html>
<html>
<head>
	<title>Startsida</title>
</head>

	<script src="StartScript.js"></script>

<body>
	<?php
		require "./Felhantering.php";
 	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>

	<!--
			RTL version
	-->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.rtl.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.rtl.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.rtl.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.rtl.min.css"/>


	<link rel="stylesheet" type="text/css" href="StartStil.css">



	<?php

	if (isset($_SESSION["name"])) {
		echo '
			<script type="text/javascript">',
     	'refer("6");',
     	'</script>';
	} else {
		echo '
			<script type="text/javascript">',
     	'refer("1");',
     	'</script>';
	}

	$servername = "localhost";
	$username = "root";
	$password = "";

	$passwordError = 1;
	$mailError = 1;
	$skapad = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	?>
<div id="pane">
	<div id="content">

	</div>
</div>
</body>
</html>
