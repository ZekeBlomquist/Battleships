<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		function uppgift() {
			location.replace("uppgift.php");
		}
	</script>
</body>
</html>
<?php

	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

if ($_SERVER['REQUEST_METHOD'] === "GET") {


		$obj = json_decode($_GET["text"]);

		$namn = $obj->namn;
		$pass = $obj->password;
		$typ = $obj->typ;

	if ($typ == "add") { //skapa användare
		$sql = "SELECT namn FROM User WHERE namn = '$namn'";
		$result = $conn->query($sql);

		if ($result->num_rows === 0) {
			$sql = "INSERT INTO User (namn, pass) VALUES ('$namn', '$pass')";
			$conn->query($sql);

			echo "
			<h1>Startsida</h1>

			<button id='btnMem' onclick='log(2)''>Redan medlem</button>
			<button id='btnReg' onclick='log(3)''>Bli medlem</button>
			<br> <br>
			<div> Användare skapad </div>
			";
		} else {
			echo "
			<h1> Registrera konto </h1>
			<div id='newName'>Namn: <input type='text' id='textName'> </div>
			<div id='newPass'>Lösenord: <input type='text' id='textPass'> </div>
			<div id='fel'>Kontonamnet är upptaget</div>
			<br>
			<button id='btnLog' onclick='Reg()'>Skapa konto</button>
			<button id='btnHem' onclick='log(1)'>Tillbaka till startsidan</button>
			";

		}
	} else { //logga in
		$sql = "SELECT namn FROM User WHERE namn = '$namn'";
		$result = $conn->query($sql);

		if ($result->num_rows === 1) {
			$sql = "SELECT pass AS passWord FROM User WHERE namn = '$namn'";
			$result = $conn->query($sql);
			$passcheck = $result->fetch_assoc()["passWord"];

			if ($passcheck == $pass) {
				$sql = "SELECT namn AS userName FROM User WHERE namn = '$namn'";
				$result = $conn->query($sql);
				$name = $result->fetch_assoc()["userName"];
				$_SESSION["namn"] = $name;

				header("Location: uppgift.php");
			} else {
				echo "
					<h1> Logga in </h1>
					<div id='newName'>Namn: <input type='text' id='textName'> <div id='felN'></div> </div>
					<div id='newPass'>Lösenord: <input type='text' id='textPass'> <div id='felP'></div> </div>
					<div id='fel'>Fel lösenord</div>
					<br>
					<button id='btnLog' onclick='logIn()'>Logga in</button>
					<button id='btnHem' onclick='log(1)'>Tillbaka till startsidan</button>
				";
			}
		} else {
			echo "
				<h1> Logga in </h1>
				<div id='newName'>Namn: <input type='text' id='textName'> <div id='felN'></div> </div>
				<div id='newPass'>Lösenord: <input type='text' id='textPass'> <div id='felP'></div> </div>
				<div id='fel'>Fel användarnamn</div>
				<br>
				<button id='btnLog' onclick='logIn()'>Logga in</button>
				<button id='btnHem' onclick='log(1)'>Tillbaka till startsidan</button>
				";
		}



		}
	}



?>
