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

			$name = sanitize($name);
			$mail = sanitize($mail);
			$pass = sanitize($pass);

			//$pass = hash($pass + "hs40dj2"); får hash inte att fungera. Försökt ett tag men löser det om det är ett krav på godkänt.

			//Lägger till spelarens profil till databasen
	    $sql = "INSERT INTO User(name, mail, password, currency, xp, selected) VALUES('$name', '$mail', '$pass', 0, 0, 'DEF')";
			$result = $conn->query($sql);

			//Tar fram den skapade spelarens ID för att sätta in default desgnen till spelaren
			$sql = "SELECT userID AS userID FROM User WHERE name = '$name'";
			$result = $conn->query($sql);
			$ID = $result->fetch_assoc()["userID"];

			//Lägger till default utseendet i unlocked arrayen
			$sql = "INSERT INTO Unlocked (userID, country) VALUES ('$ID', 'DEF')";
			$conn->query($sql);

	    echo "Användare Skapad";

	  }

		if (isset($_GET["verifyLogString"])) {
			$verifyLog = json_decode($_GET["verifyLogString"]);

	    $userLog = $verifyLog->userLog;
	    $passLog = $verifyLog->passLog;

			$userLog = sanitize($userLog);
			$passLog = sanitize($passLog);

			//Variabel som håller koll på om användarnamnet eller mailen finns i databasen
			$exist = 0;

			//Tar ut användarens namn
			$sql = "SELECT name FROM User WHERE name = '$userLog'";
			$result = $conn->query($sql);

			//Om namnet redan används så markeras det med att sätta exist till 1
			if ($result->num_rows === 1) {
				$exist = 1;
			}

			//Om mailen redan används så markeras det med att sätta exist till 2
			$sql = "SELECT mail FROM User WHERE mail = '$userLog'";
			$result = $conn->query($sql);

			if ($result->num_rows === 1) {
				$exist = 2;
			}

			//Om det inte uppstod något fel så sätts värderna in i databasen.
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


				if ($exist == 1) {
					//sätter in användarens mail i sessionen

					$_SESSION["name"] = $userLog;
				} else {
					//tar fram användarens mail och sedan sätter in den i sessionen

					$sql = "SELECT name AS userName FROM User WHERE mail = '$userLog'";
					$result = $conn->query($sql);
					$_SESSION["name"] = $result->fetch_assoc()["userName"];

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
