<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="StatistikStil.css">

	<?php
		require "./Felhantering.php";
  ?>

  <script>

		var request = new XMLHttpRequest();
		request.open('GET', 'StatistikAjax.php?', true);
		request.onload = function() {

			var data = request.responseText;

			var parseData = JSON.parse(data);


			//Objekt med all importerad information
			var statistics = {
				name: parseData[0],
				winsEasy: parseInt(parseData[1]),
				winsMedium: parseInt(parseData[2]),
				winsHard: parseInt(parseData[3]),
				lossesEasy: parseInt(parseData[4]),
				lossesMedium: parseInt(parseData[5]),
				lossesHard: parseInt(parseData[6]),
				shots: parseInt(parseData[7]),
				hits: parseInt(parseData[8]),
				time: parseInt(parseData[9])
			};

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

		};
		request.send();


  </script>

	<div id="pane">
		<div id="content">
			<div id="statisticsFront">
				<h1 id="header"> Statistik </h1>

				<div id="winsHeader">
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

				<div id="lossHeader">
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

				<!-- Tillbaka-knapp -->
				<input id="back" type="button" name="create" value="Tillbaka" onclick="document.location.href='Start.php'">

			</div>
		</div>
	</div>

</body>
</html>
