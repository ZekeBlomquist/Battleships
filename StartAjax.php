<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $val = $_GET["val"];

			//Ändrar sidans utseende till "start-läge"
    if ($val == "1") {
			logout();
      ?>
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
	        <input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
	        <p id="skapadText"> </p>
				</div>
      <?php
    }

		//Ändrar sidans utseende till "login-läge"
    if ($val == "2") {
      ?>
				<div id="log">
	        <h1> Logga in </h1>

	        Namn eller mail <br> <input id="userLog" type="text" name="userLog">
	        <span class="fel" id="userFelLog"></span>
	        <br><br>

	        Lösenord <br> <input id="passLog" type="password" name="passLog">
	        <span class="fel" id="passFelLog"></span>
	        <br><br>
	        <input class="knappar" type="button" name="logIn" value="Logga in" onclick="verifieraLog()">
					<input type="button" value="Gå tillbaka" class="knappar"	onclick="refer(1)" />
					</div>
      <?php
    }

		//Ändrar sidans utseende till "registrerings-läge"
    if ($val == "3") {
			?>
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
	  			<input id="btnReg" class="knappar" type="button" name="create" value="Skapa användare" disabled="disabled" onclick="verifiera()">
	  			<input type="button" value="Gå tillbaka" class="knappar"	onclick="refer(1)" />
				</div>
			<?php
    }

		//Ändrar sidans utseende till "start-läge" med tilllagt notis om att användaren är skapad
    if ($val == "4") {
      ?>
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="create" value="Logga in" onclick="refer(2)">
	        <input class="knappar" type="button" name="create" value="Registrera" onclick="refer(3)">
	        <p> Användare skapad </p>
				</div>
      <?php
    }

		//Ändrar sidans utseende till "startside-läge" med tilllagt notis om att man nu är inloggad
    if ($val == "5") {
      ?>
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="game" value="Spela" onclick="game()">
					<input class="knappar" type="button" name="shop" value="Profil" onclick="refer(7)">
					<input class="knappar" type="button" name="logout" value="Logga ut" onclick="refer(1)">
	        <p> Du är nu inloggad </p>
				</div>
      <?php
    }

		//Ändrar sidans utseende till "startside-läge"
		if ($val == "6") {
      ?>
				<div id="start">
	        <h1> Startsida </h1>
	        <input class="knappar" type="button" name="game" value="Spela" onclick="game()">
					<input class="knappar" type="button" name="profile" value="Profil" onclick="refer(7)">
					<input class="knappar" type="button" name="logout" value="Logga ut" onclick="refer(1)">
				</div>
      <?php
    }

		//Ändrar sidans utseende till "profilläge"
		if ($val == "7") {
			$user = $_SESSION["name"];
			echo '
				<div id="spelarSida">
					<h1> ', $user, "´s profil", ' </h1>
	        <input class="knappar" type="button" name="game" value="Statistik" onclick="user()">
					<input class="knappar" type="button" name="shop" value="Affär" onclick="shop()">
					<input class="knappar" type="button" name="back" value="Tillbaka" onclick="refer(6)">
				</div>
			';
    }

  }
?>
