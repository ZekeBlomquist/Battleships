unlocked();

function selected() {
  //Tar fram spelarens valda land
  var request = new XMLHttpRequest();
  request.open('GET', 'ShopAjax.php?val='+"selected", true);
  request.onload = function() {

    var data = request.responseText;

    //Sätter knappens text till "Vald"
    $("#"+data).prop('value', 'Vald');
    //Ger knappen klassen "selected" för identifiering
    $("#"+data).addClass("selected");
    //Gör knappen oklickbar
    $(".selected").prop('disabled', true);

  };
  request.send();
}

function nyVald() {
  //Gör det förra valda landets knapp klickbar
  $(".selected").prop('disabled', false);
  //Sätter förra valets knapp-text till "Välj"
  $(".selected").prop('value', 'Välj');
  //Tar bort identifieringsklassen "selected" från förra valets knapp
  $(".selected").removeClass("selected");
}

function pick(iso) {

  //om man klickar på ett redan ägt land så väljer man det
  if ($("#"+iso).hasClass('buy')) {

    //Om man inte äger landet så köper man landet
    var request = new XMLHttpRequest();
    request.open('GET', 'ShopAjax.php?ISO='+iso+'&click=buy', true);
    request.send();
  } else {

    //Sätter det valda landet som spelaren valda land
    var request = new XMLHttpRequest();
    request.open('GET', 'ShopAjax.php?ISO='+iso+'&click=selected', true);
    request.send();
  }

  unlocked();
  nyVald();
}

function moneyCheck() {
  //Kollar spelarens pengar
  var request = new XMLHttpRequest();
  request.open('GET', 'ShopAjax.php?val='+"money", true);
  request.onload = () => {
    var money = request.responseText;

    //Undersöker om spelaren har råd att köpa nya länder, om inte gör den köp knappen oklickbar och köp priserna röda
    if (money < 150) {
      $(".buy").prop('disabled', true);
      $(".price").css('color', 'red');
    }

    //Visar upp spelarens pengar
    $("#moneyAmount").html("Pengar: $" + money);
  };
  request.send();
}


//Undersöker vilka länder som spelaren har upplåst, och gör de länderna oköpbara
function unlocked() {
  var unlocked;
  var unlockedISO = new Array();

  //Kollar spelarens upplåsta länder
  var request = new XMLHttpRequest();
  request.open('GET', 'ShopAjax.php?val='+"unlocked", true);
  request.onload = () => {
    var unlocked = request.responseText;
    var text = "";

    //Splittar de inkommande ordsträngen till bokstäver
    for (var i = 0; i < unlocked.length; i++) {
      text += unlocked[i];

      if ((i+1)%3 == 0 && i != 0) {
        unlockedISO.push(text);
        text = "";
      }
    }

    for (var i = 0; i < unlockedISO.length; i++) {
      //Tar bort identifieringsklassen "buy" från köpta länders knappar
      $("#"+unlockedISO[i]).removeClass("buy");
      //Sätter knappens text till "Välj"
      $("#"+unlockedISO[i]).prop('value', 'Välj');
      $("#"+unlockedISO[i]+"buy").html("");

      //Sätter det ursprungligt valda landets knapp till valt läge
      $(".selected").prop('value', 'Vald');
    }
    moneyCheck();
    selected();
  };
  request.send();

}
