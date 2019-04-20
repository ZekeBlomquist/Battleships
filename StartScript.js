var name;
var mail;
var pass;
//ser till att man inte kan trycka registrera utan att ha skrivit in något
var startName = false;
var startMail = false;
var startPass = false;

function nameFel(nameTest) {
  var request = new XMLHttpRequest();
  request.open('GET', 'SkapaAjax.php?nameTest='+nameTest, true);
  request.onload = function() {

    var data = request.responseText;

    document.getElementById("nameFel").innerHTML = data;
    name = nameTest;
    startName = true;
  };
  request.send();
}

//Kollar om mailadressen är i rätt format och inte redan är använd
function mailFel(mailTest) {
  var request = new XMLHttpRequest();
  request.open('GET', 'SkapaAjax.php?mailTest='+mailTest, true);
  request.onload = function() {

    var data = request.responseText;

    document.getElementById("mailFel").innerHTML = data;
    mail = mailTest;
    startMail = true;
  };
  request.send();
}

//Kollar om lösenordet är i rätt format
function passFel(passTest) {
  var request = new XMLHttpRequest();
  request.open('GET', 'SkapaAjax.php?passTest='+passTest, true);
  request.onload = function() {

    var data = request.responseText;

    document.getElementById("passFel").innerHTML = data;
    pass = passTest;
    startPass = true;
  };
  request.send();
}

  window.setInterval( function(){
    if (startName && startMail && startPass) {
      verifyReg();
    }

  },25)



function verifyReg() {
  var nameText = document.getElementById("nameFel").innerHTML;
  var mailText = document.getElementById("mailFel").innerHTML;
  var passText = document.getElementById("passFel").innerHTML;

  if (nameText == "" && mailText == "" && passText == "") {
    document.getElementById("btnReg").disabled = false;
  }
}

function verifiera() {

  var verify = {name: name, mail: mail, pass: pass};

  var verifyString = JSON.stringify(verify);

  var request = new XMLHttpRequest();
  request.open('GET', 'SkapaAjax.php?verifyString='+verifyString, true);
  request.onload = function() {

    var data = request.responseText;

  };
  request.send();
  start = false
  refer(4);

  //gör knappen oklickbar så länge kraven på kontot inte möts
  document.getElementById("btnReg").disabled = true;
  startName = false;
  startMail = false;
  startPass = false;
}

function verifieraLog() {
  var userLog = document.getElementById("userLog").value;
  var passLog = document.getElementById("passLog").value;
  passLog = (passLog);

  var verifyLog = {userLog: userLog, passLog: passLog};

  var verifyLogString = JSON.stringify(verifyLog);

  var request = new XMLHttpRequest();
  request.open('GET', 'SkapaAjax.php?verifyLogString='+verifyLogString, true);
  request.onload = function() {

    var data = request.responseText;

    if (data != "Inloggad") {

      if (data == "User") {
        document.getElementById("userFelLog").innerHTML = "Användaren finns inte";
        document.getElementById("passFelLog").innerHTML = "";
        document.getElementById("passLog").value = "";
      } else {
        document.getElementById("userFelLog").innerHTML = "";
        document.getElementById("passFelLog").innerHTML = "Fel lösenord";
        document.getElementById("passLog").value = "";
      }
    } else {
      refer(5);
    }
  };
  request.send();
}

function refer(val) {
  var request = new XMLHttpRequest();
  request.open('GET', 'StartAjax.php?val='+val, true);
  request.onload = function() {

    var data = request.responseText;
    document.getElementById("content").innerHTML = data;
  };
  request.send();
}

function logout() {
  var val = "6";
  var request = new XMLHttpRequest();
  request.open('GET', 'StartAjax.php?val='+val, true);
  request.onload = function() {

    var data = request.responseText;
  };
  request.send();
}



function game() {
  window.open("Spel.php", "_self");
}

function shop() {
  window.open("Shop.php", "_self");
}

function user() {
  window.open("statistik.php", "_self");
}


window.onload= () => {

};
