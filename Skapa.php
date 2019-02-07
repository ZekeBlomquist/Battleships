<!DOCTYPE html>
<html>
<head>
	<title>Skapa</title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="Stilmall.css">

	<script>
		var mail;
		var pass;

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

		function verifiera() {
			var mailText = document.getElementById("mailFel").innerHTML;
			var passText = document.getElementById("passFel").innerHTML;

			if (mailText == "" && passText == "") {
				console.log("mail: " + mail + ", pass: " + pass);

				var request = new XMLHttpRequest();
				request.open('GET', 'SkapaAjax.php?mail='+mail+'&pass='+pass, true);
				request.onload = function() {

					var data = request.responseText;

					console.log(data);
				};
				request.send();

				refer(4);
			}
		}

		function verifieraLog() {
			var mailLog = document.getElementById("mailLog").value;
			var passLog = document.getElementById("passLog").value;

			console.log("mail: " + mailLog + ", pass: " + passLog);

				var request = new XMLHttpRequest();
				request.open('GET', 'SkapaAjax.php?mailLog='+mailLog+'&passLog='+passLog, true);
				request.onload = function() {

					var data = request.responseText;

					console.log(data);

					if (data != "Inloggad") {


						if (data == "Mail") {
							document.getElementById("passFelLog").innerHTML = "Användaren finns inte";
							//document.getElementById("passFelLog").value == "";
						} else {
							document.getElementById("passFelLog").innerHTML = "Fel lösenrod";
							//document.getElementById("passFelLog").innerHTML == "yes";
						}
					} else {
						refer(5);
					}
				};
				request.send();



		}

		function refer(val) {
			var request = new XMLHttpRequest();
			request.open('GET', 'StartAjax.php?val='+val, true);
			request.onload = function() {

				var data = request.responseText;
				document.getElementById("content").innerHTML = data;
			};
			request.send();
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
		<h1> Startsida </h1>
		<input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
		<input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
		<p id="skapadText"> </p>
	</div>
</body>
</html>
