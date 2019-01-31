<?php
	require "./Felhantering.php";

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

		if (isset($_SESSION["mail"])) {
			$mail = $_SESSION["mail"];
			$val = $_GET['text'];

			$sql = "SELECT wins AS W FROM User WHERE mail = '$mail'";
			$result = $conn->query($sql);
			$wins = $result->fetch_assoc()["W"];

			$sql = "SELECT losses AS L FROM User WHERE mail = '$mail'";
			$result = $conn->query($sql);
			$losses = $result->fetch_assoc()["L"];



			if ($val == "stats") {	
				
				echo "<span style='color:green;'> W: " . $wins . "</span>" . " | " . "<span style='color:red;'> L: " . $losses . " </span>";
			
			} else if ($val == "win") {

				$wins++; 

				$sql = "UPDATE User SET wins = '$wins' WHERE mail = '$mail'";
				$conn->query($sql);

				echo "<span style='color:green;'> W: " . $wins . "</span>" . " | " . "<span style='color:red;'> L: " . $losses . " </span>";

			} else if ($val == "loss") {

				$losses++; 

				$sql = "UPDATE User SET losses = '$losses' WHERE mail = '$mail'";
				$conn->query($sql);

				echo "<span style='color:green;'> W: " . $wins . "</span>" . " | " . "<span style='color:red;'> L: " . $losses . " </span>";
			}
		} else {
		echo "logga in först";
		}

	}	


		
	
?>