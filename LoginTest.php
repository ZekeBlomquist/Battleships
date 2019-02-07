<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");


?>
<style type="text/css">
	* { font-family: comic sans MS; }
</style>



<div id="textSida">
	<h1>Startsida</h1>

	<button id="btnMem" onclick="log(2)">Redan medlem</button>
	<button id="btnReg" onclick="log(3)">Bli medlem</button>
</div>



<script type="text/javascript">
	function log(text) {
		document.getElementById("textSida").innerHTML = "";

		var request = new XMLHttpRequest();
		request.open('GET', 'AjaxStartTest.php?text='+text, true);
		request.onload = function() {

			var data = request.responseText;

			document.getElementById("textSida").innerHTML = data;
		};
		request.send();
	}

function logIn() {
		var name = document.getElementById("textName").value;
		var pass = document.getElementById("textPass").value;

	if (name != "" && pass != "") {
		document.getElementById("fel").innerHTML = "";

		var Login = { namn: name, password: pass, typ: "log"};

		var stringJSON = JSON.stringify(Login);



		var request = new XMLHttpRequest();
		request.open('GET', 'SkapaTest.php?text='+stringJSON, true);
		request.onload = function() {

			var data = request.responseText;

			document.getElementById("textSida").innerHTML = data;
			};
		request.send();


	} else {
		document.getElementById("fel").innerHTML = "Lämna inga fält tomma.";
	}
}

function Reg() {
		var name = document.getElementById("textName").value;
		var pass = document.getElementById("textPass").value;

	if (name != "" && pass != "") {
		document.getElementById("fel").innerHTML = "";

		var Login = { namn: name, password: pass, typ: "add"};

		var stringJSON = JSON.stringify(Login);



		var request = new XMLHttpRequest();
		request.open('GET', 'SkapaTest.php?text='+stringJSON, true);
		request.onload = function() {

			var data = request.responseText;

			document.getElementById("textSida").innerHTML = data;
			};
		request.send();

	} else {
			document.getElementById("fel").innerHTML = "Lämna inga fält tomma.";
	}
}
</script>
</body>
</html>
