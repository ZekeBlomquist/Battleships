<?php


// DETTA ÄR EN TEST KOMMENTAR
error_reporting(-1); // Report all type of errors
ini_set('display_errors', 1); // Display all errors
ini_set('output_buffering', 0); // Do not buffer outputs, write directly

session_start();

function sanitize($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function logout(){
	session_destroy();
	session_unset();
	$_SESSION = [];
}

function login($mail){
	$_SESSION["mail"] = $mail;
}

function islogged(){
	if (isset($_SESSION["mail"])) {
		return true;
	}
	else {
		return false;
	}
}

function connect(){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$conn = new mysqli($servername, $username, $password, "projektDB");

	if ($conn->connect_error) {
		return null;
		die("Connection failed: " . $conn->connection_error);
		} else {
			return $conn;
		}
}


?>
