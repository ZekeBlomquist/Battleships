<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {
		//Kollar om spelaren är inloggad
		if (isset($_SESSION["name"])) {
			if (isset($_GET["ISO"])) {
				$ISO = $_GET["ISO"];

				$name = $_SESSION["name"];

				$sql = "SELECT userID AS userID FROM User WHERE name = '$name'";
				$result = $conn->query($sql);
				$ID = $result->fetch_assoc()["userID"];

				//Uppdaterar spelarens valda land till det köpta/valda
				$sql = "UPDATE User SET selected = '$ISO' WHERE name = '$name'";
				$conn->query($sql);

				if ($_GET["click"] == "buy") {
					//Lägger till det upplåsta landet i tabellen med upplåsta länder
					$sql = "INSERT INTO Unlocked (userID, country) VALUES ('$ID', '$ISO')";
					$conn->query($sql);

					//Subtraherar kostnaden från spelarens pengar
					$sql = "SELECT currency AS Currency FROM User WHERE name = '$name'";
					$result = $conn->query($sql);
					$currency = $result->fetch_assoc()["Currency"];

					$currency = ($currency - 150);

					$sql = "UPDATE User SET currency = '$currency' WHERE name = '$name'";
					$conn->query($sql);
				}


			}

			if (isset($_GET["val"])) {
				if ($_GET["val"] == "money") {
					$name = $_SESSION["name"];

					//tar fram spelarens pengar och skriver ut mängden pengar
					$sql = "SELECT currency AS Currency FROM User WHERE name = '$name'";
					$result = $conn->query($sql);
					$currency = $result->fetch_assoc()["Currency"];

					echo $currency;
				}

				if ($_GET["val"] == "selected") {
					$name = $_SESSION["name"];

					//tar fram spelarens valda land
					$sql = "SELECT selected AS Selected FROM User WHERE name = '$name'";
					$result = $conn->query($sql);
					$selected = $result->fetch_assoc()["Selected"];

					echo $selected;
				}

				if ($_GET["val"] == "unlocked") {
					$name = $_SESSION["name"];

					$sql = "SELECT userID AS userID FROM User WHERE name = '$name'";
					$result = $conn->query($sql);
					$ID = $result->fetch_assoc()["userID"];

					$unlocked = array();

					$sql = "SELECT country FROM Unlocked WHERE userID = '$ID'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo $row["country"];
						}
					}

					$unlocked = $result->fetch_assoc()["unlocked"];

					echo $unlocked;

				}
			}
		}
	}

?>
