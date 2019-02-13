<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

    if (isset($_GET["ISO"])) {
      $ISO = $_GET["ISO"];

      $name = $_SESSION["name"];

      $sql = "UPDATE User SET selected = '$ISO' WHERE name = '$name'";
      $conn->query($sql);

			$sql = "SELECT userID AS userID FROM User WHERE name = '$name'";
			$result = $conn->query($sql);
			$ID = $result->fetch_assoc()["userID"];

			$sql = "INSERT INTO Unlocked (userID, country) VALUES ('$ID', '$ISO')";
      $conn->query($sql);

      echo $ISO;
  }
}
?>
