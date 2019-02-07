<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {

		if (isset($_GET["nameTest"])) {
      $nameTest = $_GET["nameTest"];


      if (strlen($nameTest) < 3) {
				echo "För kort";
      } else if (strlen($nameTest) > 15) {
				echo "För långt";
      } else {
				echo "";
			}

			$sql = "SELECT name FROM User WHERE name = '$nameTest'";
			$result = $conn->query($sql);

			if ($result->num_rows === 1) {
				echo "Användarnamnet används redan";
			}
    }

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

	  if (isset($_GET["verifyString"])) {
			$verify = json_decode($_GET["verifyString"]);

			$name = $verify->name;
			$mail = $verify->mail;
			$pass = $verify->pass;

	    $sql = "INSERT INTO User(name, mail, password, wins, losses, currency, xp, selected) VALUES('$name', '$mail', '$pass', 0, 0, 0, 0, 'DEF')";
			$result = $conn->query($sql);

	    echo "Användare Skapad";

	  }

		if (isset($_GET["verifyLogString"])) {
			$verifyLog = json_decode($_GET["verifyLogString"]);

	    $userLog = $verifyLog->userLog;
	    $passLog = $verifyLog->passLog;

			//Variabel som håller koll på om användarnamnet eller mailen finns i databasen
			$exist = 0;

			$sql = "SELECT name FROM User WHERE name = '$userLog'";
			$result = $conn->query($sql);

			if ($result->num_rows === 1) {
				$exist = 1;
			}

			$sql = "SELECT mail FROM User WHERE mail = '$userLog'";
			$result = $conn->query($sql);

			if ($result->num_rows === 1) {
				$exist = 2;
			}

			if ($exist != 0) {
				if ($exist == 1) {
					$sql = "SELECT password AS passWord FROM User WHERE name = '$userLog'";
					$result = $conn->query($sql);
					$passCheck = $result->fetch_assoc()["passWord"];
				} else {
					$sql = "SELECT password AS passWord FROM User WHERE mail = '$userLog'";
					$result = $conn->query($sql);
					$passCheck = $result->fetch_assoc()["passWord"];
				}

				if ($passCheck == $passLog) {


				if ($exist == 2) {
					//sätter in användarens mail i sessionen

					$_SESSION["mail"] = $userLog;
				} else {
					//tar fram användarens mail och sedan sätter in den i sessionen

					$sql = "SELECT mail AS userMail FROM User WHERE name = '$userLog'";
					$result = $conn->query($sql);
					$_SESSION["mail"] = $result->fetch_assoc()["userMail"];

				}

					echo "Inloggad";
				} else {
					echo "Pass";
				}

			} else {
				echo "User";
			}
	  }

}

?>
