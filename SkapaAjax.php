<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

    if (isset($_GET["mailTest"])) {
      $mailTest = $_GET["mailTest"];

      $sql = "SELECT mail FROM User WHERE mail = '$mailTest'";
	    $result = $conn->query($sql);

      if (!preg_match("/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/", sanitize($mailTest))) {

        echo "Fel format";
      } else if ($result->num_rows != 0) {
        echo "Mailadressen används redan";
      } else {
        echo "";
      }

    }

    if (isset($_GET["passTest"])) {
      $passTest = $_GET["passTest"];

      if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", sanitize($passTest))) {

          echo "Fel format";
      } else {
        echo "";
      }
    }

	}

  if (isset($_GET["mail"]) && isset($_GET["pass"])) {
    $mail = $_GET["mail"];
    $pass = $_GET["pass"];

    $sql = "INSERT INTO User(mail, password, wins, losses, currency, xp, selected) VALUES('$mail', '$pass', 0, 0, 0, 0, 'DEF')";
		$result = $conn->query($sql);

    echo "Användare Skapad";

  }

	if (isset($_GET["mailLog"]) && isset($_GET["passLog"])) {
    $mailLog = $_GET["mailLog"];
    $passLog = $_GET["passLog"];

		$sql = "SELECT mail FROM User WHERE mail = '$mailLog'";
		$result = $conn->query($sql);

		if ($result->num_rows === 1) {
			$sql = "SELECT password AS passWord FROM User WHERE mail = '$mailLog'";
			$result = $conn->query($sql);
			$passCheck = $result->fetch_assoc()["passWord"];

			if ($passCheck == $passLog) {

				/*
				$sql = "SELECT mail AS userMail FROM User WHERE mail = '$mailLog'";
				$result = $conn->query($sql);
				$mailLogged = $result->fetch_assoc()["userMail"];
				$_SESSION["mail"] = $mailLogged;
				*/

				echo "Inloggad";
			} else {
				echo "Pass";
			}

		} else {
			echo "Mail";
		}
  }

?>
