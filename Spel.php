<!DOCTYPE html>
<html>
<head>
	<?php

		require "./Felhantering.php";
	?>

	<title>Battleships</title>

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


		<link rel="stylesheet" type="text/css" href="SpelStil.css">

		<link rel="stylesheet" href="/css/master.css">

		<script src="SpelScript.js"> </script>

</head>

<body id="body">

	<div id="spelplan">
		<div id="egen" class="spel"></div>
		<div id="meny">
			<div id="startKnapp" class="unselectable knappDisabled" onclick="startSpel()" >Start game</div>
			<div class="knapp unselectable" onclick="window.location.href = 'start.php?'">To menu</div>
			<div id="difficultyKnapp" class="knapp unselectable" onclick="showDif()">Difficulty</div>
		</div>
		<div id="fiende" class="spel"></div>

		<div id="egnaSkepp" class="skeppPlan">
			<div id="skepp1" class="skepp" onclick="place(1)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>

			<div id="skepp2" class="skepp" onclick="place(2)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>

			<div id="skepp3" class="skepp" onclick="place(3)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>

			<div id="skepp4" class="skepp" onclick="place(4)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>

			<div id="skepp5" class="skepp" onclick="place(5)">
				<div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
		</div>
		<div id="vs">

		</div>
		<div id="fiendeSkepp" class="skeppPlan">
			<div id="skepp6" class="skepp">
				<div class="templSkepp1 enemy1 enemyShip"></div><div class="templSkepp1 enemy1 enemyShip"></div><div class="templSkepp1 enemy1 enemyShip"></div><div class="templSkepp1 enemy1 enemyShip"></div><div class="templSkepp2 enemy1 enemyShip"></div>
			</div>
			<div id="skepp7" class="skepp">
				<div class="templSkepp1 enemy2 enemyShip"></div><div class="templSkepp1 enemy2 enemyShip"></div><div class="templSkepp1 enemy2 enemyShip"></div><div class="templSkepp2 enemy2 enemyShip"></div>
			</div>
			<div id="skepp8" class="skepp">
				<div class="templSkepp1 enemy3 enemyShip"></div><div class="templSkepp1 enemy3 enemyShip"></div><div class="templSkepp2 enemy3 enemyShip"></div>
			</div>
			<div id="skepp9" class="skepp">
				<div class="templSkepp1 enemy4 enemyShip"></div><div class="templSkepp1 enemy4 enemyShip"></div><div class="templSkepp2 enemy4 enemyShip"></div>
			</div>
			<div id="skepp10" class="skepp">
				<div class="templSkepp1 enemy5 enemyShip"></div><div class="templSkepp2 enemy5 enemyShip"></div>
			</div>
		</div>
	</div>

	<?php
		//Kollar om spelaren är inloggad eller inte
		if (!isset($_SESSION["name"])) {
			?>
				<script>
					//Gömmer spelplanens innehåll
					$("#spelplan").hide();
					//Skapar popup som tar en tillbaka till startsidan
					alertify.alert('Error', 'You must be logged in to be able to play', function(){ window.open("Start.php", "_self"); }).set('closable', false).setting({'label':'Back to start'});
				</script>
			<?php
		}
	?>

	<!-- Osynlig div för largling av menyns utseende -->
	<div id="storage"></div>
</body>
</html>
