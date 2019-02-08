<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $val = $_GET["val"];

    if ($val == "1") {
			logout();
      echo '
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
	        <input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
	        <p id="skapadText"> </p>
				</div>
      ';
    }

    if ($val == "2") {
      echo '
				<div id="log">
	        <h1> Logga in </h1>

	        Namn eller mail <br> <input id="userLog" type="text" name="userLog">
	        <span class="fel" id="userFelLog"></span>
	        <br><br>

	        Lösenord <br> <input id="passLog" type="password" name="passLog">
	        <span class="fel" id="passFelLog"></span>
	        <br><br>
	        <input class="knappar" type="button" name="logIn" value="Logga in" onclick="verifieraLog()">
					<input id="btntest" type="button" value="Gå tillbaka" class="knappar"	onclick="refer(1)" />
					</div>
      ';
    }

    if ($val == "3") {
      echo '
				<div id="reg">
	        <h1> Registrera konto </h1>

					Användarnamn <br> <input type="text" name="nameCreate" onkeyup="nameFel(this.value)">
	  			<span class="fel" id="nameFel"></span>
	  			<br><br>

	  			Mailadress <br> <input type="text" name="mailCreate" onkeyup="mailFel(this.value)">
	  			<span class="fel" id="mailFel"></span>
	  			<br><br>

	  			Lösenord <br> <input type="password" name="passCreate" onkeyup="passFel(this.value)">
	  			<span class="fel" id="passFel"></span>
	  	 		<br><br>
	  			<input id="btnReg" class="knappar" type="button" name="create" value="Skapa Användare" disabled="disabled" onclick="verifiera()">
	  			<input id="btntest" type="button" value="Gå tillbaka" class="knappar"	onclick="refer(1)" />
				</div>
      ';
    }

    if ($val == "4") {
      echo '
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
	        <input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
	        <p> Användare skapad </p>
				</div>
      ';
    }

    if ($val == "5") {
      echo '
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="game" value="Spela" onclick="game()">
					<input class="knappar" type="button" name="shop" value="Profil" onclick="refer(7)">
					<input class="knappar" type="button" name="logout" value="Logga ut" onclick="refer(1)">
	        <p> Du är nu inloggad </p>
				</div>
      ';
    }

		if ($val == "6") {
      echo '
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="game" value="Spela" onclick="game()">
					<input class="knappar" type="button" name="shop" value="Profil" onclick="refer(7)">
					<input class="knappar" type="button" name="logout" value="logga ut" onclick="refer(1)">
				</div>
      ';
    }

		if ($val == "7") {
			$user = $_SESSION["name"];
      echo '
				<div id="spelarSida">
					<h1> ', $user, "s profil", ' </h1>
	        <input class="knappar" type="button" name="game" value="Statistik" onclick="game()">
					<input class="knappar" type="button" name="shop" value="Affär" onclick="shop()">
					<input class="knappar" type="button" name="back" value="Tillbaka" onclick="refer(6)">
				</div>
      ';
    }

  }
?>
