<!DOCTYPE html>
<html>
<head>
	<title>Startsida</title>
</head>
<body>
	<?php
		require "./Felhantering.php";
 	?>

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


	<link rel="stylesheet" type="text/css" href="StartStil.css">

	<script>
		var name;
		var mail;
		var pass;
		//ser till att man inte kan trycka registrera utan att ha skrivit in något
		var startName = false;
		var startMail = false;
		var startPass = false;

		function nameFel(nameTest) {
			var request = new XMLHttpRequest();
			request.open('GET', 'SkapaAjax.php?nameTest='+nameTest, true);
			request.onload = function() {

				var data = request.responseText;

				console.log(data);
				document.getElementById("nameFel").innerHTML = data;
				name = nameTest;
				startName = true;
			};
			request.send();
		}

		function mailFel(mailTest) {
			var request = new XMLHttpRequest();
			request.open('GET', 'SkapaAjax.php?mailTest='+mailTest, true);
			request.onload = function() {

				var data = request.responseText;

				console.log(data);
				document.getElementById("mailFel").innerHTML = data;
				mail = mailTest;
				startMail = true;
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
				startPass = true;
			};
			request.send();
		}

			window.setInterval( function(){
				if (startName && startMail && startPass) {
					verifyReg();
				}

			},25)



		function verifyReg() {
			var nameText = document.getElementById("nameFel").innerHTML;
			var mailText = document.getElementById("mailFel").innerHTML;
			var passText = document.getElementById("passFel").innerHTML;

			if (nameText == "" && mailText == "" && passText == "") {
				document.getElementById("btnReg").disabled = false;
				console.log("yes");
			} else {
				console.log("yes2");
			}
		}

		function verifiera() {

			var verify = {name: name, mail: mail, pass: pass};

			var verifyString = JSON.stringify(verify);

			var request = new XMLHttpRequest();
			request.open('GET', 'SkapaAjax.php?verifyString='+verifyString, true);
			request.onload = function() {

				var data = request.responseText;

				console.log(data);
			};
			request.send();
			start = false
			refer(4);

			//gör knappen oklickbar så länge kraven på kontot inte möts
			document.getElementById("btnReg").disabled = true;
			startName = false;
			startMail = false;
			startPass = false;
		}

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

		function refer(val) {
			var request = new XMLHttpRequest();
			request.open('GET', 'StartAjax.php?val='+val, true);
			request.onload = function() {

				var data = request.responseText;
				document.getElementById("content").innerHTML = data;
			};
			request.send();
		}

		function logout() {
			var val = "6";
			var request = new XMLHttpRequest();
			request.open('GET', 'StartAjax.php?val='+val, true);
			request.onload = function() {

				var data = request.responseText;
			};
			request.send();
		}



		function game() {
			window.open("Spel.php", "_self");
		}

		function shop() {
			window.open("Shop.php", "_self");
		}

		function user() {
			window.open("statistik.php", "_self");
		}


		window.onload= () => {

		};

	</script>

	<?php

	if (isset($_SESSION["name"])) {
		echo '
			<script type="text/javascript">',
     	'refer("6");',
     	'</script>';
	} else {
		echo '
			<script type="text/javascript">',
     	'refer("1");',
     	'</script>';
	}

	$servername = "localhost";
	$username = "root";
	$password = "";

	$passwordError = 1;
	$mailError = 1;
	$skapad = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	?>
<div id="pane">
	<div id="content">

	</div>
</div>
</body>
</html>
