<?php
	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "testDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {
		$val = $_GET['text'];

		if ($val == 1) { //tillbaka till startsidan
			echo "
			<h1>Startsida</h1>

			<button id='btnMem' onclick='log(2)''>Redan medlem</button>
			<button id='btnReg' onclick='log(3)''>Bli medlem</button>
			";
		}

		if ($val == 2) { //logga in
			echo "
			<h1> Logga in </h1>
			<div id='newName'>Namn: <input type='text' id='textName'> <div id='felN'></div> </div>
			<div id='newPass'>Lösenord: <input type='text' id='textPass'> <div id='felP'></div> </div>
			<div id='fel'></div>
			<br>
			<button id='btnLog' onclick='logIn()'>Logga in</button>
			<button id='btnHem' onclick='log(1)'>Tillbaka till startsidan</button>
			";
		}

		if ($val == 3) { //registrera konto
			echo "
			<h1> Registrera konto </h1>
			<div id='newName'>Namn: <input type='text' id='textName'> </div>
			<div id='newPass'>Lösenord: <input type='text' id='textPass'> </div>
			<div id='fel'></div>
			<br>
			<button id='btnLog' onclick='Reg()'>Skapa konto</button>
			<button id='btnHem' onclick='log(1)'>Tillbaka till startsidan</button>
			";
		}

	}

?>
