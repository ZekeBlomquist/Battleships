<!DOCTYPE html>
<html>
<head>
	<title>Databas för min sida</title>
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		//Skapar databasen
		$sql = "CREATE DATABASE projektDB";
		if ($conn->query($sql) === TRUE) {
			echo "Databas skapad";
		}
		else {
			echo "Fel när databasen skulle skapas: " . $conn->error;
		}

		mysqli_select_db($conn,"projektDB");

		$sql = "CREATE TABLE User(
		userID int NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL,
		mail varchar(255) NOT NULL,
		password varchar(255) NOT NULL,
		wins int,
		losses int,
		currency int,
		xp int,
		selected varchar(255),
		PRIMARY KEY (userID)
		)";
		if ($conn->query($sql) === TRUE) {
			echo "Tabellen med användare är skapad!";
		}
		else {
			echo "Färfrågan misslyckades med följande fel:" . $conn->error;
		}

		$sql = "CREATE TABLE Unlocked(
		userID int NOT NULL,
		country varchar(255) NOT NULL,
		PRIMARY KEY (userID)
		)";
		if ($conn->query($sql) === TRUE) {
			echo "Tabellen med upplåsta länder är skapad!";
		}
		else {
			echo "Färfrågan misslyckades med följande fel:" . $conn->error;
		}




		$conn->close();
	?>
</body>
</html>
