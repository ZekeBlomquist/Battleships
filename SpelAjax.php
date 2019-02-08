<?php
	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

		if (isset($_SESSION["name"])) {
			$name = $_SESSION["name"];
			$val = $_GET['val'];

			if (isset($_GET['dif'])) {
				$dif = $_GET['dif'];
			}

			$sql = "SELECT wins AS W FROM User WHERE name = '$name'";
			$result = $conn->query($sql);
			$wins = $result->fetch_assoc()["W"];

			$sql = "SELECT losses AS L FROM User WHERE name = '$name'";
			$result = $conn->query($sql);
			$losses = $result->fetch_assoc()["L"];

			$sql = "SELECT xp AS xp FROM User WHERE name = '$name'";
			$result = $conn->query($sql);
			$xp = $result->fetch_assoc()["xp"];

			$sql = "SELECT currency AS cur FROM User WHERE name = '$name'";
			$result = $conn->query($sql);
			$cur = $result->fetch_assoc()["cur"];

			if ($val == "stats") {

				echo "<span style='color:green;'> W: " . $wins . "</span>" . " | " . "<span style='color:red;'> L: " . $losses . " </span>";

			} else if ($val == "win") {

				if ($dif == 1) {
					$xp += 50;
					$cur += 10;
				} else if ($dif == 2) {
					$xp += 100;
					$cur += 25;
				} else if ($dif == 3) {
					$xp += 150;
					$cur += 60;
				}

				$wins++;

				$sql = "UPDATE User SET wins = '$wins' WHERE name = '$name'";
				$conn->query($sql);

				$sql = "UPDATE User SET xp = '$xp' WHERE name = '$name'";
				$conn->query($sql);

				$sql = "UPDATE User SET currency = '$cur' WHERE name = '$name'";
				$conn->query($sql);




				echo "<span style='color:green;'> W: " . $wins . "</span>" . " | " . "<span style='color:red;'> L: " . $losses . " </span>";

			} else if ($val == "loss") {

				$losses++;

				$sql = "UPDATE User SET losses = '$losses' WHERE name = '$name'";
				$conn->query($sql);

				echo "<span style='color:green;'> W: " . $wins . "</span>" . " | " . "<span style='color:red;'> L: " . $losses . " </span>";
			} else if ($val == "dif") {

				$sql = "SELECT selected AS S FROM User WHERE name = '$name'";
				$result = $conn->query($sql);
				$selected = $result->fetch_assoc()["S"];

				echo $selected;
			}
		} else {
		echo "Inte inloggad";
		}

	}
?>
