<?php 
	require "./Felhantering.php";

	$conn = connect();

	$inloggadtext = "";
	$start = 1;	
	$mail = "";
	$pass = "";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (!empty($_POST["mail"])) {
			$mail = $_POST["mail"];
			$mail = sanitize($mail);

			$sql = "SELECT mail FROM User WHERE mail = '$mail'";
			$result = $conn->query($sql);
			if ($result->num_rows === 1) {
				if (!empty($_POST["pass"])) {
					$pass = sanitize($_POST["pass"]);

					$sql = "SELECT password AS Pass FROM User WHERE mail = '$mail'";
					$result = $conn->query($sql);
					$passcheck = $result->fetch_assoc()["Pass"];

					if ($passcheck === $pass) {
						$inloggadtext = "Du är nu inloggad";

						login($mail);

						$start = 0;
					} else {
						$inloggadtext = "Fel lösenord";
					}
		} else {
			$inloggadtext = "Ange lösenordet först";
		}
			} else {
				$inloggadtext = "Användaren finns inte";
			}

		} else {
			$inloggadtext = "Ange mailadressen först";
		}



		
	}
	else if ($_SERVER['REQUEST_METHOD'] == "GET") {
		logout();
		$start = 1;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Session Uppgift Sida</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="Stilmall.css">
 
<?php if ($start == 1) { ; ?>
		<form method="post" action="login.php" target="_self">

	Mailadress <br> <input type="text" name="mail" value="<?php echo sanitize($mail); ?>"> 
	
	<br> <br>

	Lösenord <br> <input type="text" name="pass" value="<?php echo sanitize($pass); ?>"> <br> <br>

	<?php if (!empty($inloggadtext)) {
		
		echo $inloggadtext; ?>
		<br> <br>
		<?php
	} 

	?>



	<input class="knappar" type="submit" name="login" value="Logga in">
	<br><br> 


</form>

<?php } else{ echo $inloggadtext ?> <br> <br>
	<form method="post" action="taBort.php" target="_self">
	<input class="knappar" type="submit" name="login" value="Ta bort användare"> <br><br>
<?php } 


					if (!islogged()) {
						?> <input id="btntest" type="button" value="Skapa användare" 
     						onclick="window.location.href = 'Skapa.php'" /> <br> <br> <?php 
					}			
	?>
		
		<div>
			<?php
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					if (islogged()) {
						?> <input id="btntest" type="button" value="Gå till spelet" 
     						onclick="window.location.href = 'Spel.php'" /> <?php
					}
				}
			?> 
		
		</div>
		<br>
		<div>
			<?php
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					if (islogged()) {
						?> <input id="btntest" type="button" value="Logga ut" 
     						onclick="window.location.href = 'login.php?log=0'" /> <?php
					}
				}
			?> 
		
		</div>

	</form>
</body>
</html>