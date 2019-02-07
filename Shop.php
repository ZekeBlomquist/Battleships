<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="Stilmall.css">

  <script>
    function buy(ISO) {
      var request = new XMLHttpRequest();
      request.open('GET', 'ShopAjax.php?ISO='+ISO, true);
      request.onload = function() {

        var data = request.responseText;
        console.log(data);
      };
      request.send();
    }
  </script>

  <input class="knappar" type="button" name="buy" value="DEF" onclick="buy('DEF')">
  <input class="knappar" type="button" name="buy" value="DEU" onclick="buy('DEU')">
  <input class="knappar" type="button" name="buy" value="DNK" onclick="buy('DNK')">
  <input class="knappar" type="button" name="buy" value="EST" onclick="buy('EST')">
  <input class="knappar" type="button" name="buy" value="FIN" onclick="buy('FIN')">
  <input class="knappar" type="button" name="buy" value="LTU" onclick="buy('LTU')">
  <input class="knappar" type="button" name="buy" value="LVA" onclick="buy('LVA')">
  <input class="knappar" type="button" name="buy" value="NOR" onclick="buy('NOR')">
  <input class="knappar" type="button" name="buy" value="SWE" onclick="buy('SWE')">

  <br> <br>

  <input class="knappar" type="button" name="create" value="Gå tillbaka" onclick="document.location.href='Start.php'">

  <?php
  require "./Felhantering.php";
  ?>

</body>
</html>
