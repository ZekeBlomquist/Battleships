<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="StatistikStil.css">

	<?php
		require "./Felhantering.php";
  ?>

  <script>
		var request = new XMLHttpRequest();
		request.open('GET', 'StatistikAjax.php?', true);
		request.onload = function() {

			var data = request.responseText;

			var test = JSON.parse(data);

			console.log(test[0])

		};
		request.send();
  </script>

  <div id="statistik">
    game on gamer
  </div>

</body>
</html>
