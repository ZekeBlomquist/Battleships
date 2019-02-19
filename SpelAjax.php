<?php
	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

		if (isset($_SESSION["name"])) {
			$val = $_GET["val"];
			$name = $_SESSION["name"];

			//Tar fram spelarens ID
			$sql = "SELECT userID AS id FROM User WHERE name = '$name'";
			$result = $conn->query($sql);
			$ID = $result->fetch_assoc()["id"];

			if (isset($_GET["statsString"])) {
				//Decodar json objektet och tar ut diverse variabler från det
				$stats = json_decode($_GET["statsString"]);

				$dif = $stats->difficulty;
				$shots = $stats->shots;
				$hits = $stats->hits;
				$time = $stats->time;

			}

			//Tar fram spelarens valda design
			if ($val == "country") {

				$sql = "SELECT selected AS Sel FROM User WHERE name = '$name'";
				$result = $conn->query($sql);
				$selected = $result->fetch_assoc()["Sel"];

				echo $selected;
			}

			//Om spelaren vann
			else if ($val == "win") {

				//Tar fram spelarens xp
				$sql = "SELECT xp AS xp FROM User WHERE name = '$name'";
				$result = $conn->query($sql);
				$xp = $result->fetch_assoc()["xp"];

				//Tar fram spelarens pengar
				$sql = "SELECT currency AS cur FROM User WHERE name = '$name'";
				$result = $conn->query($sql);
				$cur = $result->fetch_assoc()["cur"];

				//Tar fram mängden pengar/xp spelaren ska få baserat på svårighetsgrad, ändrar också svårighetsgrader till ordformat
				if ($dif == 1) {
					$xp += 50;
					$cur += 25;
					$dif = "Easy";
				} else if ($dif == 2) {
					$xp += 100;
					$cur += 50;
					$dif = "Medium";
				} else if ($dif == 3) {
					$xp += 150;
					$cur += 70;
					$dif = "Hard";
				}
				//Uppdaterar spelarens xp
				$sql = "UPDATE User SET xp = '$xp' WHERE name = '$name'";
				$conn->query($sql);

				//Uppdaterar spelarens pengamängd
				$sql = "UPDATE User SET currency = '$cur' WHERE name = '$name'";
				$conn->query($sql);

				//Bokför matchen i statikstik-tabellen
				$sql = "INSERT INTO Statistics(userID, outcome, difficulty, shots, hits, matchTime) VALUES('$ID', 'win', '$dif', '$shots', '$hits', '$time')";
				$result = $conn->query($sql);
			}
			if ($val == "loss") {
				$sql = "INSERT INTO Statistics(userID, outcome, difficulty, shots, hits, matchTime) VALUES('$ID', 'loss', '$dif', '$shots', '$hits', '$time')";
				$result = $conn->query($sql);
			}
		} else {
			echo "logga in först";
		}
	}

?>
