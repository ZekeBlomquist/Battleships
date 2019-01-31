<!DOCTYPE html>
<html>
<head>
	<title>Skapa</title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="Stilmall.css">

	
	<?php

	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$passwordError = 1;
	$mailError = 1;
	$skapad = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$mail = $_POST["mailCreate"];
	$pass = $_POST["passCreate"];

	if (!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", sanitize($mail))) { 
			$mailError = 0;
		} else {
			$mailError = 1;
		}
	if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", sanitize($pass))) {
			$passwordError = 0;
		} else {
			$passwordError = 1;
		}

		

		if ($passwordError == 1 && $mailError == 1) {
			$sql = "SELECT mail FROM User WHERE mail = '$mail'";
			$result = $conn->query($sql);
			if ($result->num_rows === 0) {
				$sql = "INSERT INTO User(mail, password, wins, losses) VALUES('$mail', '$pass', 0, 0)"; 
				$result = $conn->query($sql);
				$skapad = "Din användare är nu skapad <br> <br> <a class='knapp' href='Login.php'>Klicka här för att återvända </a>";
			} else {
				$skapad = "Mailadressen är upptagen";
			}
			
		} 


	}
	?>

	<form method="post" action="Skapa.php" >
	Mailadress <br> <input type="text" name="mailCreate">
	<?php if ($mailError == 0) { 
		echo "Fel format";
	} ?> <br><br>

	Lösenord <br> <input type="text" name="passCreate">
	<?php if ($passwordError == 0) {
		echo "Fel format";
	}
	 ?> 
	 <br><br>
	<input class="knappar" type="submit" name="create" value="Skapa Användare">
	<input id="btntest" type="button" value="Gå tillbaka" class="knappar" 
       onclick="window.location.href = 'Login.php'" />
	 
	<br><br> <?php echo $skapad; ?>
</form>
</body>
</html>