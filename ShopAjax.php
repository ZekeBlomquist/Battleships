<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

    if (isset($_GET["ISO"])) {
      $ISO = $_GET["ISO"];

      $mail = $_SESSION["mail"];

      $sql = "UPDATE User SET selected = '$ISO' WHERE mail = '$mail'";
      $conn->query($sql);

      echo $ISO;
  }
}
?>
