<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $val = $_GET["val"];

    if ($val == "1") {
      echo '
        <h1> Startsida </h1>
        <input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
        <input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
        <p id="skapadText"> </p>
      ';
    }

    if ($val == "2") {
      echo '
        <h1> Logga in </h1>

        Mailadress <br> <input id="mailLog" type="text" name="mailCreate">
        <span id="mailFelLog"></span>
        <br><br>

        Lösenord <br> <input id="passLog" type="password" name="passCreate">
        <span id="passFelLog"></span>
        <br><br>
        <input class="knappar" type="button" name="logIn" value="Logga in" onclick="verifieraLog()">
      ';
    }

    if ($val == "3") {
      echo '
        <h1> Registrera konto </h1>

  			Mailadress <br> <input type="text" name="mailCreate" onkeyup="mailFel(this.value)">
  			<span id="mailFel"></span>
  			<br><br>

  			Lösenord <br> <input type="password" name="passCreate" onkeyup="passFel(this.value)">
  			<span id="passFel"></span>
  	 		<br><br>
  			<input class="knappar" type="button" name="create" value="Skapa Användare" onclick="verifiera()">
  			<input id="btntest" type="button" value="Gå tillbaka" class="knappar"	onclick="refer(1)" />
      ';
    }

    if ($val == "4") {
      echo '
        <h1> Startsida </h1>
        <input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
        <input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
        <p> Användare skapad </p>
      ';
    }

    if ($val == "5") {
      echo '
        <h1> Startsida </h1>
        <input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
        <input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
        <p> Du är nu inloggad </p>
      ';
    }


  }
?>
