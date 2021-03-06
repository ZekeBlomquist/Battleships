<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>

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


	<link rel="stylesheet" type="text/css" href="SpelStil.css">

	<script src="ShopScript.js"> </script>

</head>
<body>
  <link rel="stylesheet" type="text/css" href="ShopStil.css">

	<?php
		require "./Felhantering.php";
  ?>

	<div id="shopFront">

		<h1> Affär</h1>
		<div id="money"> <p id="moneyAmount"> y </p></div>

		<div id="countries">
			<div id="DEFdiv" class="country">
				<h2> Default </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppDEF"></div><div class="templSkepp1 skeppDEF"></div><div class="templSkepp1 skeppDEF"></div><div class="templSkepp1 skeppDEF"></div><div class="templSkepp2 skeppDEF"></div>
				</div>
		  	<input class="knappar buy" id="DEF" type="button" name="buy" value="Köp" onclick="pick('DEF')"> <p id="DEFbuy" class="price"> 150$</p>
			</div>

			<div id="DEUdiv" class="country">
				<h2> Tyskland </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppDEU"></div><div class="templSkepp1 skeppDEU"></div><div class="templSkepp1 skeppDEU"></div><div class="templSkepp1 skeppDEU"></div><div class="templSkepp2 skeppDEU"></div>
				</div>
			  <input class="knappar buy" id="DEU" type="button" name="buy" value="Köp" onclick="pick('DEU')"> <p id="DEUbuy" class="price"> 150$</p>
			</div>

			<div id="DNKdiv" class="country">
				<h2> Danmark </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppDNK"></div><div class="templSkepp1 skeppDNK"></div><div class="templSkepp1 skeppDNK"></div><div class="templSkepp1 skeppDNK"></div><div class="templSkepp2 skeppDNK"></div>
				</div>
			  <input class="knappar buy" id="DNK" type="button" name="buy" value="Köp" onclick="pick('DNK')"> <p id="DNKbuy" class="price"> 150$</p>
			</div>

			<div id="ESTdiv" class="country">
				<h2> Estland </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppEST"></div><div class="templSkepp1 skeppEST"></div><div class="templSkepp1 skeppEST"></div><div class="templSkepp1 skeppEST"></div><div class="templSkepp2 skeppEST"></div>
				</div>
			  <input class="knappar buy" id="EST" type="button" name="buy" value="Köp" onclick="pick('EST')"> <p id="ESTbuy" class="price"> 150$</p>
			</div>

			<div id="FINdiv" class="country">
				<h2> Finland </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppFIN"></div><div class="templSkepp1 skeppFIN"></div><div class="templSkepp1 skeppFIN"></div><div class="templSkepp1 skeppFIN"></div><div class="templSkepp2 skeppFIN"></div>
				</div>
			  <input class="knappar buy" id="FIN" type="button" name="buy" value="Köp" onclick="pick('FIN')"> <p id="FINbuy" class="price"> 150$</p>
			</div>

			<div id="LTUdiv" class="country">
				<h2> Litauen </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppLTU"></div><div class="templSkepp1 skeppLTU"></div><div class="templSkepp1 skeppLTU"></div><div class="templSkepp1 skeppLTU"></div><div class="templSkepp2 skeppLTU"></div>
				</div>
			  <input class="knappar buy" id="LTU" type="button" name="buy" value="Köp" onclick="pick('LTU')"> <p id="LTUbuy" class="price"> 150$</p>
			</div>

			<div id="LVAdiv" class="country">
				<h2> Lettland </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppLVA"></div><div class="templSkepp1 skeppLVA"></div><div class="templSkepp1 skeppLVA"></div><div class="templSkepp1 skeppLVA"></div><div class="templSkepp2 skeppLVA"></div>
				</div>
			  <input class="knappar buy" id="LVA" type="button" name="buy" value="Köp" onclick="pick('LVA')"> <p id="LVAbuy" class="price"> 150$</p>
			</div>

			<div id="NORdiv" class="country">
				<h2> Norge </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppNOR"></div><div class="templSkepp1 skeppNOR"></div><div class="templSkepp1 skeppNOR"></div><div class="templSkepp1 skeppNOR"></div><div class="templSkepp2 skeppNOR"></div>
				</div>
			  <input class="knappar buy" id="NOR" type="button" name="buy" value="Köp" onclick="pick('NOR')"> <p id="NORbuy" class="price"> 150$</p>
			</div>

			<div id="SWEdiv" class="country">
				<h2> Sverige </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppSWE"></div><div class="templSkepp1 skeppSWE"></div><div class="templSkepp1 skeppSWE"></div><div class="templSkepp1 skeppSWE"></div><div class="templSkepp2 skeppSWE"></div>
				</div>
			  <input class="knappar buy" id="SWE" type="button" name="buy" value="Köp" onclick="pick('SWE')"> <p id="SWEbuy" class="price"> 150$</p>
			</div>

			<div id="ITAdiv" class="country">
				<h2> Italien </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppITA"></div><div class="templSkepp1 skeppITA"></div><div class="templSkepp1 skeppITA"></div><div class="templSkepp1 skeppITA"></div><div class="templSkepp2 skeppITA"></div>
				</div>
			  <input class="knappar buy" id="ITA" type="button" name="buy" value="Köp" onclick="pick('ITA')"> <p id="ITAbuy" class="price"> 150$</p>
			</div>

			<div id="BELdiv" class="country">
				<h2> Belgien </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppBEL"></div><div class="templSkepp1 skeppBEL"></div><div class="templSkepp1 skeppBEL"></div><div class="templSkepp1 skeppBEL"></div><div class="templSkepp2 skeppBEL"></div>
				</div>
			  <input class="knappar buy" id="BEL" type="button" name="buy" value="Köp" onclick="pick('BEL')"> <p id="BELbuy" class="price"> 150$</p>
			</div>

			<div id="AUTdiv" class="country">
				<h2> Österrike </h2>
				<div class="skepp" >
					<div class="templSkepp1 skeppAUT"></div><div class="templSkepp1 skeppAUT"></div><div class="templSkepp1 skeppAUT"></div><div class="templSkepp1 skeppAUT"></div><div class="templSkepp2 skeppAUT"></div>
				</div>
			  <input class="knappar buy" id="AUT" type="button" name="buy" value="Köp" onclick="pick('AUT')"> <p id="AUTbuy" class="price"> 150$</p>
			</div>
		</div>

		<!-- Tillbaka-knapp -->
		<input id="back" type="button" name="create" value="Tillbaka" onclick="document.location.href='Start.php'">


	</div>

	<?php
		//Kollar om spelaren är inloggad eller inte
		if (!isset($_SESSION["name"])) {
			?>
				<script>
					//Gömmer affärens innehåll
					$("#shopFront").hide();
					//Skapar popup som tar en tillbaka till startsidan
					alertify.alert('Error', 'You must be logged in to be able to access the shop', function(){ window.open("Start.php", "_self"); }).set('closable', false).setting({'label':'Back to start'});
				</script>
			<?php
		}
	?>

</body>
</html>
