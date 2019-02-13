<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="ShopStil.css">

	<?php
		require "./Felhantering.php";
  ?>

  <script>
    function buy(ISO) {
      var request = new XMLHttpRequest();
      request.open('GET', 'ShopAjax.php?ISO='+ISO, true);
      request.onload = function() {

        var data = request.responseText;
        console.log(data);
      };
      request.send();
    }

		
  </script>

	<div id="DEF" class="country">
		<h2> Default </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
  	<input class="knappar" type="button" name="buy" value="Köp" onclick="buy('DEF')"> 150$

	</div>

	<div id="DEU" class="country">
		<h2> Tyskland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('DEU')"> 150$
	</div>

	<div id="DNK" class="country">
		<h2> Danmark </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('DNK')"> 150$
	</div>

	<div id="EST" class="country">
		<h2> Estland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('EST')"> 150$
	</div>

	<div id="FIN" class="country">
		<h2> Finland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('FIN')"> 150$
	</div>

	<div id="LTU" class="country">
		<h2> Litauen </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('LTU')"> 150$
	</div>

	<div id="LVA" class="country">
		<h2> Lettland </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('LVA')"> 150$
	</div>

	<div id="NOR" class="country">
		<h2> Norge </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('NOR')"> 150$
	</div>

	<div id="SWE" class="country">
		<h2> Sverige </h2>
		<div class="skepp" >
			<div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp1 skepp1"></div><div class="templSkepp2 skepp1"></div>
		</div>
	  <input class="knappar" type="button" name="buy" value="Köp" onclick="buy('SWE')"> 150$
	</div>

  <br> <br> <br>

  <br><input id="back" class="knappar" type="button" name="create" value="Gå tillbaka" onclick="document.location.href='Start.php'">


</body>
</html>
