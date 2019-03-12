<?php
	require "./Felhantering.php";

  $servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($_SERVER['REQUEST_METHOD'] === "GET") {
		//Kollar om spelaren är inloggad
		if (isset($_SESSION["name"])) {
      $name = $_SESSION["name"];

      $sql = "SELECT userID AS userID FROM User WHERE name = '$name'";
      $result = $conn->query($sql);
      $ID = $result->fetch_assoc()["userID"];


			//tar fram spelarens antal vinster mot lätt dator
			$sql = "SELECT count(outcome) AS outcome FROM Statistics WHERE userID = '$ID' AND outcome = 'Win' AND difficulty = 'Easy'";
			$result = $conn->query($sql);
			$winsEasy = $result->fetch_assoc()["outcome"];

      //tar fram spelarens antal vinster mot medium dator
			$sql = "SELECT count(outcome) AS outcome FROM Statistics WHERE userID = '$ID' AND outcome = 'Win' AND difficulty = 'Medium'";
			$result = $conn->query($sql);
			$winsMedium = $result->fetch_assoc()["outcome"];

      //tar fram spelarens antal vinster mot svår dator
			$sql = "SELECT count(outcome) AS outcome FROM Statistics WHERE userID = '$ID' AND outcome = 'Win' AND difficulty = 'Hard'";
			$result = $conn->query($sql);
			$winsHard = $result->fetch_assoc()["outcome"];


      //tar fram spelarens antal förluster mot lätt dator
      $sql = "SELECT count(outcome) AS outcome FROM Statistics WHERE userID = '$ID' AND outcome = 'Loss' AND difficulty = 'Easy'";
      $result = $conn->query($sql);
      $lossesEasy = $result->fetch_assoc()["outcome"];

      //tar fram spelarens antal förluster mot medium dator
      $sql = "SELECT count(outcome) AS outcome FROM Statistics WHERE userID = '$ID' AND outcome = 'Loss' AND difficulty = 'Medium'";
      $result = $conn->query($sql);
      $lossesMedium = $result->fetch_assoc()["outcome"];

      //tar fram spelarens antal förluster mot svår dator
      $sql = "SELECT count(outcome) AS outcome FROM Statistics WHERE userID = '$ID' AND outcome = 'Loss' AND difficulty = 'Hard'";
      $result = $conn->query($sql);
      $lossesHard = $result->fetch_assoc()["outcome"];

      //tar fram spelarens totala avfyrade skott
      $sql = "SELECT sum(shots) AS shots FROM Statistics WHERE userID = '$ID'";
      $result = $conn->query($sql);
      $shots = $result->fetch_assoc()["shots"];

      //tar fram spelarens totala antal träffar
      $sql = "SELECT sum(hits) AS hits FROM Statistics WHERE userID = '$ID'";
      $result = $conn->query($sql);
      $hits = $result->fetch_assoc()["hits"];

      //tar fram spelarens totala speltid
      $sql = "SELECT sum(matchTime) AS matchTime FROM Statistics WHERE userID = '$ID'";
      $result = $conn->query($sql);
      $time = $result->fetch_assoc()["matchTime"];

      //Lägger inte värderna i en array
      $statistics = array($name, $winsEasy, $winsMedium, $winsHard, $lossesEasy, $lossesMedium, $lossesHard, $shots, $hits, $time);
			
      //Encodar arrayen så den kan skickas tillbaka
      $statisticsJSON = json_encode($statistics);

			echo $statisticsJSON;

		}
	}

?>
