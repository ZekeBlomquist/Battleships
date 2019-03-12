<!DOCTYPE html>
<html>
<head>
	<title>Skapa</title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="Stilmall.css">

	<script>
		var name;
		var mail;
		var pass;

		//Funktion för att testa om namnet är i korrekt format
		function nameFel(nameTest) {
			var request = new XMLHttpRequest();
			request.open('GET', 'SkapaAjax.php?nameTest='+nameTest, true);
			request.onload = function() {

				var data = request.responseText;

				console.log(data);
				document.getElementById("nameFel").innerHTML = data;
				name = nameTest;
			};
			request.send();
		}

		//Funktion för att testa om mailen är i korrekt format
		function mailFel(mailTest) {
			var request = new XMLHttpRequest();
			request.open('GET', 'SkapaAjax.php?mailTest='+mailTest, true);
			request.onload = function() {

				var data = request.responseText;

				console.log(data);
				document.getElementById("mailFel").innerHTML = data;
				mail = mailTest;
			};
			request.send();
		}

		//Funktion för att testa om lösenordet är i korrekt format
		function passFel(passTest) {
			var request = new XMLHttpRequest();
			request.open('GET', 'SkapaAjax.php?passTest='+passTest, true);
			request.onload = function() {

				var data = request.responseText;

				console.log(data);
				document.getElementById("passFel").innerHTML = data;
				pass = passTest;
			};
			request.send();
		}

		//Lägger till användaren till databasen
		function verifiera() {
			var nameText = document.getElementById("nameFel").innerHTML;
			var mailText = document.getElementById("mailFel").innerHTML;
			var passText = document.getElementById("passFel").innerHTML;

			var verify = {name: name, mail: mail, pass: pass};

			var verifyString = JSON.stringify(verify);

			if (nameText == "" && mailText == "" && passText == "") {
				var request = new XMLHttpRequest();
				request.open('GET', 'SkapaAjax.php?verifyString='+verifyString, true);
				request.onload = function() {

					var data = request.responseText;

					console.log(data);
				};
				request.send();

				refer(4);
			}
		}

		//Verifierar användares uppgifter genom att undersöka om de stämmer överens med de lagrade uppgifterna
		function verifieraLog() {
			var userLog = document.getElementById("userLog").value;
			var passLog = document.getElementById("passLog").value;

			var verifyLog = {userLog: userLog, passLog: passLog};

			var verifyLogString = JSON.stringify(verifyLog);

			var request = new XMLHttpRequest();
			request.open('GET', 'SkapaAjax.php?verifyLogString='+verifyLogString, true);
			request.onload = function() {

				var data = request.responseText;

				console.log(data);

				if (data != "Inloggad") {

					if (data == "User") {
						document.getElementById("userFelLog").innerHTML = "Användaren finns inte";
						document.getElementById("passFelLog").innerHTML = "";
						document.getElementById("passLog").value = "";
					} else {
						document.getElementById("userFelLog").innerHTML = "";
						document.getElementById("passFelLog").innerHTML = "Fel lösenord";
						document.getElementById("passLog").value = "";
					}
				} else {
					refer(5);
				}
			};
			request.send();
		}

		//Ändrar utseendet på sidan till diverse olika lägen. T.ex till "inloggat läge" eller "profil-läge"
		function refer(val) {
			var request = new XMLHttpRequest();
			request.open('GET', 'StartAjax.php?val='+val, true);
			request.onload = function() {

				var data = request.responseText;
				document.getElementById("content").innerHTML = data;
			};
			request.send();
		}

		function game() {
			window.location.href = "Spel.php";
		}
	</script>

	<?php

	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$passwordError = 1;
	$mailError = 1;
	$skapad = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	?>

	<div id="content">
		<div id="start">
			<h1> Startsida </h1>
			<input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
			<input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
			<p id="skapadText"> </p>
		</div>
	</div>
</body>
</html>
