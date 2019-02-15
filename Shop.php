<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="ShopStil.css">

	<?php
		require "./Felhantering.php";
  ?>

  <script>

		//Tar fram spelarens valda land
		var request = new XMLHttpRequest();
		request.open('GET', 'ShopAjax.php?val='+"selected", true);
		request.onload = function() {

			var data = request.responseText;
			console.log("Selected: "+data);

			//Sätter knappens text till "Vald"
			$("#"+data).prop('value', 'Vald');
			//Ger knappen klassen "selected" för identifiering
			$("#"+data).addClass("selected");
			//Gör knappen oklickbar
			$(".selected").prop('disabled', true);

		};
		request.send();

    function pick(ISO) {

			//om man klickar på ett redan ägt land så väljer man det
			if ($("#"+ISO).prop('value', 'Välj')) {
				//Sätter det valda landet som spelaren valda land
	      var request = new XMLHttpRequest();
	      request.open('GET', 'ShopAjax.php?ISO='+ISO+'&click=selected', true);
	      request.onload = function() {

	        var data = request.responseText;
	        console.log("Valt: "+data);

					//Gör det förra valda landets knapp klickbar
					$(".selected").prop('disabled', false);
					//Sätter förra valets knapp-text till "Välj"
					$(".selected").prop('value', 'Välj');
					//Tar bort identifieringsklassen "selected" från förra valets knapp
					$(".selected").removeClass("selected");

					//Sätter knappens text till "Vald"
					$("#"+ISO).prop('value', 'Vald');
					//Ger knappen klassen "selected" för identifiering
					$("#"+ISO).addClass("selected");
					//Gör knappen oklickbar
					$(".selected").prop('disabled', true);


	      };
	      request.send();
			} else {

				//Om man inte äger landet så köper man landet
	      var request = new XMLHttpRequest();
	      request.open('GET', 'ShopAjax.php?ISO='+ISO+'&click=buy', true);
	      request.onload = function() {

	        var data = request.responseText;
	        console.log("Köpt: "+data);
					unlocked();
	      };
	      request.send();
			}

		}
		function moneyCheck() {
			//Kollar spelarens pengar
			var request = new XMLHttpRequest();
			request.open('GET', 'ShopAjax.php?val='+"money", true);
			request.onload = function() {

				var data = request.responseText;
				console.log("pengar: "+data);

				//Undersöker om spelaren har råd att köpa nya länder, om inte gör den köp knappen oklickbar
				if (data < 150) {
					$(".buy").prop('disabled', true);
				}

			};
			request.send();
		}



		function unlocked() {
			var unlocked = new Array();
			var unlockedISO = new Array();

			//Kollar spelarens upplåsta länder
			var request = new XMLHttpRequest();
			request.open('GET', 'ShopAjax.php?val='+"unlocked", true);
			request.onload = function() {

				var unlocked = request.responseText;
				var text = "";

				for (var i = 0; i < unlocked.length; i++) {
					text += unlocked[i];

					if ((i+1)%3 == 0 && i != 0) {
						unlockedISO.push(text);
						text = "";
					}
				}

				for (var i = 0; i < unlockedISO.length; i++) {
					//Tar bort identifieringsklassen "buy" från köpta länders knappar
					$("#"+unlockedISO[i]).removeClass("buy");
					//Sätter kanppens text till "Välj"
					$("#"+unlockedISO[i]).prop('value', 'Välj');
					$("#"+unlockedISO[i]+"buy").html("");

					//Sätter det ursprungligt valda landets knapp till valt läge
					$(".selected").prop('value', 'Vald');
				}
			};
			request.send();
			moneyCheck();
		}

		unlocked();

  </script>

	<div id="DEFdiv" class="country">
		<h2> Default </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppDEF"></div><div class="templSkepp1 skeppDEF"></div><div class="templSkepp1 skeppDEF"></div><div class="templSkepp1 skeppDEF"></div><div class="templSkepp2 skeppDEF"></div>
		</div>
  	<input class="knappar buy" id="DEF" type="button" name="buy" value="Köp" onclick="pick('DEF')"> <p id="DEFbuy"> 150$</p>
	</div>

	<div id="DEUdiv" class="country">
		<h2> Tyskland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppDEU"></div><div class="templSkepp1 skeppDEU"></div><div class="templSkepp1 skeppDEU"></div><div class="templSkepp1 skeppDEU"></div><div class="templSkepp2 skeppDEU"></div>
		</div>
	  <input class="knappar buy" id="DEU" type="button" name="buy" value="Köp" onclick="pick('DEU')"> <p id="DEUbuy"> 150$</p>
	</div>

	<div id="DNKdiv" class="country">
		<h2> Danmark </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppDNK"></div><div class="templSkepp1 skeppDNK"></div><div class="templSkepp1 skeppDNK"></div><div class="templSkepp1 skeppDNK"></div><div class="templSkepp2 skeppDNK"></div>
		</div>
	  <input class="knappar buy" id="DNK" type="button" name="buy" value="Köp" onclick="pick('DNK')"> <p id="DNKbuy"> 150$</p>
	</div>

	<div id="ESTdiv" class="country">
		<h2> Estland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppEST"></div><div class="templSkepp1 skeppEST"></div><div class="templSkepp1 skeppEST"></div><div class="templSkepp1 skeppEST"></div><div class="templSkepp2 skeppEST"></div>
		</div>
	  <input class="knappar buy" id="EST" type="button" name="buy" value="Köp" onclick="pick('EST')"> <p id="ESTbuy"> 150$</p>
	</div>

	<div id="FINdiv" class="country">
		<h2> Finland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppFIN"></div><div class="templSkepp1 skeppFIN"></div><div class="templSkepp1 skeppFIN"></div><div class="templSkepp1 skeppFIN"></div><div class="templSkepp2 skeppFIN"></div>
		</div>
	  <input class="knappar buy" id="FIN" type="button" name="buy" value="Köp" onclick="pick('FIN')"> <p id="FINbuy"> 150$</p>
	</div>

	<div id="LTUdiv" class="country">
		<h2> Litauen </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppLTU"></div><div class="templSkepp1 skeppLTU"></div><div class="templSkepp1 skeppLTU"></div><div class="templSkepp1 skeppLTU"></div><div class="templSkepp2 skeppLTU"></div>
		</div>
	  <input class="knappar buy" id="LTU" type="button" name="buy" value="Köp" onclick="pick('LTU')"> <p id="LTUbuy"> 150$</p>
	</div>

	<div id="LVAdiv" class="country">
		<h2> Lettland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppLVA"></div><div class="templSkepp1 skeppLVA"></div><div class="templSkepp1 skeppLVA"></div><div class="templSkepp1 skeppLVA"></div><div class="templSkepp2 skeppLVA"></div>
		</div>
	  <input class="knappar buy" id="LVA" type="button" name="buy" value="Köp" onclick="pick('LVA')"> <p id="LVAbuy"> 150$</p>
	</div>

	<div id="NORdiv" class="country">
		<h2> Norge </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppNOR"></div><div class="templSkepp1 skeppNOR"></div><div class="templSkepp1 skeppNOR"></div><div class="templSkepp1 skeppNOR"></div><div class="templSkepp2 skeppNOR"></div>
		</div>
	  <input class="knappar buy" id="NOR" type="button" name="buy" value="Köp" onclick="pick('NOR')"> <p id="NORbuy"> 150$</p>
	</div>

	<div id="SWEdiv" class="country">
		<h2> Sverige </h2>
		<div class="skepp" >
			<div class="templSkepp1 skeppSWE"></div><div class="templSkepp1 skeppSWE"></div><div class="templSkepp1 skeppSWE"></div><div class="templSkepp1 skeppSWE"></div><div class="templSkepp2 skeppSWE"></div>
		</div>
	  <input class="knappar buy" id="SWE" type="button" name="buy" value="Köp" onclick="pick('SWE')"> <p id="SWEbuy"> 150$</p>
	</div>

  <br> <br> <br>

  <br><input id="back" class="knappar" type="button" name="create" value="Gå tillbaka" onclick="document.location.href='Start.php'">


</body>
</html>
