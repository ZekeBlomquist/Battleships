<!DOCTYPE html>
<html>
<head>
	<title>Statistik</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="StatistikScript.js"></script>
</head>
<body>

	<!-- Importerar Alertify javascript plugin -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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

	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.rtl.min.css"/>
	<!-- Default theme 2 -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.rtl.min.css"/>
	<!-- Semantic UI theme 2 -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.rtl.min.css"/>
	<!-- Bootstrap theme 2 -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.rtl.min.css"/>


  <link rel="stylesheet" type="text/css" href="StatistikStil.css">

	<?php
		require "./Felhantering.php";
  ?>

	<div id="pane">
		<div id="content">
			<div id="statisticsFront">
				<h1 id="header"> Statistik </h1>

				<p id="level"> ayup </p>
				<div id="barXP">
					<div id="xpBar"></div>
				</div>

				<div id="winsDiv">
					<h2 id="wTot"> Wins </h2>
					<div class="bar barE">
  					<div id="wEasyBar" class="easyBar"></div>
					</div>
					<div class="bar barM">
  					<div id="wMediumBar" class="mediumBar"></div>
					</div>
					<div class="bar barH">
  					<div id="wHardBar" class="hardBar"></div>
					</div>
				</div>

				<div id="lossDiv">
					<h2 id="lTot"> Losses </h2>
					<div class="bar barE">
  					<div id="lEasyBar" class="easyBar"></div>
					</div>
					<div class="bar barM">
  					<div id="lMediumBar" class="mediumBar"></div>
					</div>
					<div class="bar barH">
  					<div id="lHardBar" class="hardBar"></div>
					</div>
				</div>

				<div id="shotStats">
					<div class="stat">
						<h2 id="shots"> </h2>
					</div>
					<div class="stat" >
						<h2 id="hitRatio"> </h2>
					</div>
					<div class="stat" id="hit">
						<h2 id="hits"> </h2>
					</div>
					<div class="stat" id="timeR">
						<h2 id="timeRatio"> </h2>
					</div>
				</div>

				<!-- Tillbaka-knapp -->
				<input id="back" type="button" name="create" value="Tillbaka" onclick="document.location.href='Start.php'">

			</div>
		</div>
	</div>

	<?php
		//Kollar om spelaren är inloggad eller inte
		if (!isset($_SESSION["name"])) {
			?>
				<script>
					//Gömmer spelplanens innehåll
					$("#statisticsFront").hide();
					//Skapar popup som tar en tillbaka till startsidan
					alertify.alert('Error', 'You must be logged in to be able to view profile', function(){ window.open("Start.php", "_self"); }).set('closable', false).setting({'label':'Back to start'});
				</script>
			<?php
		}
	?>

</body>
</html>
