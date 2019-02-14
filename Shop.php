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


    function buy(ISO) {

			//Lägger till landets ISO kod i tabellen med upplåsta länder
      var request = new XMLHttpRequest();
      request.open('GET', 'ShopAjax.php?ISO='+ISO, true);
      request.onload = function() {

        var data = request.responseText;
        console.log("Köp: "+data);
      };
      request.send();
		}

		//Kollar spelarens pengar
		var request = new XMLHttpRequest();
		request.open('GET', 'ShopAjax.php?val='+"money", true);
		request.onload = function() {

			var data = request.responseText;
			console.log("pengar: "+data);

			if (data < 150) {
				console.log("yup");
				$(".buy").prop('disabled', true);
			}
			unlocked();
		};
		request.send();

		function unlocked() {
			var unlocked = new Array();
			var unlocked2 = new Array();
			//Kollar spelarens upplåsta länder
			var request = new XMLHttpRequest();
			request.open('GET', 'ShopAjax.php?val='+"unlocked", true);
			request.onload = function() {

				var unlocked = request.responseText;
				var j = 0;
				for (var i = 0; i < unlocked.length; i++) {
					if (i%3 == 0 && i != 0) {
						j++;
					}
					unlocked2[j] += unlocked[i].toString();

				}
				console.log(unlocked2)
			};
			request.send();
		}

  </script>

	<div id="DEF" class="country">
		<h2> Default </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
  	<input class="knappar buy" id="DEF" type="button" name="buy" value="Köp" onclick="buy('DEF')"> 150$

	</div>

	<div id="DEU" class="country">
		<h2> Tyskland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="DEU" type="button" name="buy" value="Köp" onclick="buy('DEU')"> 150$
	</div>

	<div id="DNK" class="country">
		<h2> Danmark </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="DNK" type="button" name="buy" value="Köp" onclick="buy('DNK')"> 150$
	</div>

	<div id="EST" class="country">
		<h2> Estland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="EST" type="button" name="buy" value="Köp" onclick="buy('EST')"> 150$
	</div>

	<div id="FIN" class="country">
		<h2> Finland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="FIN" type="button" name="buy" value="Köp" onclick="buy('FIN')"> 150$
	</div>

	<div id="LTU" class="country">
		<h2> Litauen </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="LTU" type="button" name="buy" value="Köp" onclick="buy('LTU')"> 150$
	</div>

	<div id="LVA" class="country">
		<h2> Lettland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="LVA" type="button" name="buy" value="Köp" onclick="buy('LVA')"> 150$
	</div>

	<div id="NOR" class="country">
		<h2> Norge </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="NOR" type="button" name="buy" value="Köp" onclick="buy('NOR')"> 150$
	</div>

	<div id="SWE" class="country">
		<h2> Sverige </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar buy" id="SWE" type="button" name="buy" value="Köp" onclick="buy('SWE')"> 150$
	</div>

  <br> <br> <br>

  <br><input id="back" class="knappar" type="button" name="create" value="Gå tillbaka" onclick="document.location.href='Start.php'">


</body>
</html>
