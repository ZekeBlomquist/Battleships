<!DOCTYPE html>
<html>
<head>
	<title>Statistik</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

  <script>





		var request = new XMLHttpRequest();
		request.open('GET', 'StatistikAjax.php?val='+"stats", true);
		request.onload = function() {


			var data = request.responseText;

			var parseData = JSON.parse(data);

			//Objekt med all importerad information
			var statistics = {
				name: parseData[0],
				xp: parseData[1],
				winsEasy: parseInt(parseData[2]),
				winsMedium: parseInt(parseData[3]),
				winsHard: parseInt(parseData[4]),
				lossesEasy: parseInt(parseData[5]),
				lossesMedium: parseInt(parseData[6]),
				lossesHard: parseInt(parseData[7]),
				shots: parseInt(parseData[8]),
				hits: parseInt(parseData[9]),
				time: parseInt(parseData[10])
			};

			var level = 1;
			while ((statistics.xp/((level*100) * Math.pow(1.2 , level-1))) >= 1) {
				level++;
			}

			var elem = document.getElementById("xpBar");
		  var width = 100*(statistics.xp/((level*100) * Math.pow(1.2 , level-1)));

		  elem.style.width = width + '%';
		  elem.innerHTML = statistics.xp+"xp";

			$("#level").html(level);

			console.log(statistics.xp/((level*100) * Math.pow(1.2 , level-1)))

			console.log(level)

			//Gör sidan mer personlig genom att visa spelarens namn
			$("#header").html(statistics.name + "'s statistik");

			//Tar fram det totala antalet vinster
			var wTot = (statistics.winsEasy+statistics.winsMedium+statistics.winsHard);

			//Visar antalet vinster
			$("#wTot").html("Total wins: " + wTot);


			//Tar fram procenten för varje typ av vinst
			var percentEasy = statistics.winsEasy/wTot;

			var percentMedium = statistics.winsMedium/wTot;

			var percentHard = statistics.winsHard/wTot;


			//Sätter in antalet vinster i respektive progressbar
			$("#wEasyBar").html(statistics.winsEasy);

			$("#wMediumBar").html(statistics.winsMedium);

			$("#wHardBar").html(statistics.winsHard);

			//Ändrar progressbarens storlek baserat på procentuella andelen vinster av den här typen
			var elem = document.getElementById("wEasyBar");
		  var width = 100*percentEasy;

		  elem.style.width = width + '%';
		  elem.innerHTML = statistics.winsEasy;

			//Ändrar progressbarens storlek baserat på procentuella andelen vinster av den här typen
			var elem = document.getElementById("wMediumBar");
		 	var width = 100*percentMedium;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.winsMedium;

			//Ändrar progressbarens storlek baserat på procentuella andelen vinster av den här typen
			var elem = document.getElementById("wHardBar");
		 	var width = 100*percentHard;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.winsHard;


			//Tar fram det totala antalet förluster
			var lTot = (statistics.lossesEasy+statistics.lossesMedium+statistics.lossesHard);

			//Visar antalet förluster
			$("#lTot").html("Total losses: " + lTot);

			//Tar fram procenten för varje typ av förlust
			var percentEasy = statistics.lossesEasy/lTot;

			var percentMedium = statistics.lossesMedium/lTot;

			var percentHard = statistics.lossesHard/lTot;


			//Sätter in antalet förluster i respektive progressbar
			$("#lEasyBar").html(statistics.lossesEasy);

			$("#lMediumBar").html(statistics.lossesMedium);

			$("#lHardBar").html(statistics.lossesHard);

			//Ändrar progressbarens storlek baserat på procentuella andelen förluster av den här typen
			var elem = document.getElementById("lEasyBar");
		  var width = 100*percentEasy;

		  elem.style.width = width + '%';
		  elem.innerHTML = statistics.lossesEasy;

			//Ändrar progressbarens storlek baserat på procentuella andelen förluster av den här typen
			var elem = document.getElementById("lMediumBar");
		 	var width = 100*percentMedium;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.lossesMedium;

			//Ändrar progressbarens storlek baserat på procentuella andelen förluster av den här typen
			var elem = document.getElementById("lHardBar");
		 	var width = 100*percentHard;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.lossesHard;

			var hitRatio = statistics.hits/statistics.shots;
			hitRatio = hitRatio.toFixed(3);

			var timeRatio = statistics.shots/statistics.time;
			timeRatio = timeRatio.toFixed(3);

			$("#shots").html("Total shots: " + statistics.shots);

			$("#hits").html("Total hits: " + statistics.hits);

			$("#hitRatio").html("Hit-ratio: " + hitRatio);

			$("#timeRatio").html("Shots/second: " + timeRatio);

		};
		request.send();



  </script>

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
