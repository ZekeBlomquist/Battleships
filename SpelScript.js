
		var time = 0;

		//Startar timern
    var timerFunc = function(){
				time++;
    };
    setInterval(timerFunc, 1000);


		//Om spelet är påbörjat eller om det är i skepp-placeringsfasen
		let start = false;

		//Ser till så att menys utseende sparas första gången showDif funktionen används
		let difShow = 1;

		//Array med kordinater för alla ens egna skott, för att förhindra två skott på en ruta
		let egnaSkott = new Array();

		//Array med kordinater för alla fiendens skott, för att förhindra två skott på en ruta
		let fiendeSkott = new Array();

		//Om det är spelarens tur eller inte
		let tur = true;

		//AJAX data
		let data;

		//Längden på det valda skeppet
		let skeppLength = 0;

		//Längd på fiendeskepp
		let fiendeLength = 0;

		//Vilket steg av utläggningsprocessen för ett skepp man är på, 2 = nytt
		let antalKlick = 0;

		//Array med kordinater för skepp
		let egnaSkepp = new Array();
		let fiendeSkepp = new Array();

		//Placerats skepp första kordinater
		let firstX;
		let firstY;

		//Placerats skepp sista kordinater
		let lastX;
		let lastY;

		//Om datorns förra skott var en träff eller inte
		let hit = false;

		//om det skjutna skottet var en träff eller inte
		var localHit = 0;

		//upptäcker om det uppstår några fel. Om fel > 0 så går det inte att skjuta på valda kordinater
		var felFiende = 0;

		//Lista med kordinaterna för fiendens träffar
		let hitsFiende = new Array();

		//Lista med kordinaterna för egna träffar
		let hitsEgna = new Array();

		//Ser till att skepplistan sparas i början
		let reset = true;

		//Platser där skeppet i fråga får läggas ut
		let allowedPlace = new Array();

		//Sparar utlagda platser för skepp;
		let shipBP = new Array();

		//Om någon av möjliga utsättningspunkterna är utanför spelplanens begränsningar
		let felRev = true;

		//Om det inte går att lägga ut skeppet på någon av de fyra punkterna
		let notBlocked = true;

		//Om det valda sättet att lägga ut skepp är tillåtet
		let allowShadow;

		//Id't på skeppet som läggs ut
		let id = 0;

		//Kordinater för förra träffen
		let hitCords = "";

		//Om spelet är avslutat eller inte
		let end = false;

		//Om alla skeppen är uttlagda eller inte
		let shipCorrect = false;

		//Arrayer med alla fiendeskepps inviduella kordinater
		let enemy1 = new Array();
		let enemy2 = new Array();
		let enemy3 = new Array();
		let enemy4 = new Array();
		let enemy5 = new Array();

		//Arrayer med alla de egna skeppens inviduella kordinater
		let friendly1 = new Array();
		let friendly2 = new Array();
		let friendly3 = new Array();
		let friendly4 = new Array();
		let friendly5 = new Array();

		//antal träffar på inviduella fiendeskepp
		let shipHits1 = 0;
		let shipHits2 = 0;
		let shipHits3 = 0;
		let shipHits4 = 0;
		let shipHits5 = 0;

		//antal fiendeträffar på egna inviduella skepp
		let enemyHits1 = 0;
		let enemyHits2 = 0;
		let enemyHits3 = 0;
		let enemyHits4 = 0;
		let enemyHits5 = 0;

		//Svårighetsgraden på datorn
		let difficulty = 2;

		//antal skott sedan datorn senast skött ett "fuskskott"
		let cheat = 0;

		//temporär hårdkodning av spelarens design
		let layout = "DEF";

		//Färger för de egna skeppens olika lägen
		let shipColor;
		let shadowColor;
		let sunkColor;
		let hitColor;
		let flagEgen;

		//Färger för fiedens skepps färger i de olika lägena
		let shipColorEnemy = "#333333";
		let sunkColorEnemy = "#860d0d";
		let hitColorEnemy = '<img src="Images/Hit_Red.png" class="kryss" />';
		let flagEnemy;

			//Tar ut spelarens valda skepp-design
			var request = new XMLHttpRequest();
			request.open('GET', 'SpelAjax.php?val=country', true);
			request.onload = () => {

				layout = request.responseText;
				templateColor();
			};
				request.send();



		function playerDesign() {
			if (layout == "DEF") {
				shipColor = "#333333";
				shadowColor = "#555555";
				sunkColor = "#860d0d";
				hitColor = '<img src="Images/Hit_Red.png" class="kryss" />';
				flagEgen = "Images/Flag_DEF.png";
			}

			if (layout == "SWE") {
				shipColor = "#2d5fa1";
				shadowColor = "#6091d2";
				sunkColor = "#1c3b63";
				hitColor = '<img src="Images/Hit_Yellow.png" class="kryss" />';
				flagEgen = "Images/Flag_SWE.png";
			}

			if (layout == "DNK") {
				shipColor = "#C60C30";
				shadowColor = "#f43e63";
				sunkColor = "#910824";
				hitColor = '<img src="Images/Hit_White.png" class="kryss" />';
				flagEgen = "Images/Flag_DNK.png";
			}

			if (layout == "FIN") {
				shipColor = "#003580";
				shadowColor = "#0060e6";
				sunkColor = "#001533";
				hitColor = '<img src="Images/Hit_White.png" class="kryss" />';
				flagEgen = "Images/Flag_FIN.png";
			}

			if (layout == "NOR") {
				shipColor = "#002868";
				shadowColor = "#0044b3";
				sunkColor = "#EF2B2D";
				hitColor = '<img src="Images/Hit_White.png" class="kryss" />';
				flagEgen = "Images/Flag_NOR.png";
			}
			if (layout == "EST") {
				shipColor = "#0073D0";
				shadowColor = "#33a3ff";
				sunkColor = "#005499";
				hitColor = '<img src="Images/Hit_White.png" class="kryss" />';
				flagEgen = "Images/Flag_EST.png";
			}
			if (layout == "LVA") {
				shipColor = "#9E292B";
				shadowColor = "#d0494b";
				sunkColor = "#7a1f21";
				hitColor = '<img src="Images/Hit_White.png" class="kryss" />';
				flagEgen = "Images/Flag_LVA.png";
			}
			if (layout == "LTU") {
				shipColor = "#006A44";
				shadowColor = "#00b371";
				sunkColor = "#003320";
				hitColor = '<img src="Images/Hit_Lit.png" class="kryss" />';
				flagEgen = "Images/Flag_LTU.png";
			}
			if (layout == "DEU") {
				shipColor = "#FFCF00";
				shadowColor = "#ffe366";
				sunkColor = "#cca700";
				hitColor = '<img src="Images/Hit_Red.png" class="kryss" />';
				flagEgen = "Images/Flag_DEU.png";
			}
			if (layout == "ITA") {
				shipColor = "#009344";
				shadowColor = "#00e66b";
				sunkColor = "#006630";
				hitColor = '<img src="Images/Hit_Red.png" class="kryss" />';
				flagEgen = "Images/Flag_ITA.png";
			}
			if (layout == "BEL") {
				shipColor = "#FAE042";
				shadowColor = "#FCF09C";
				sunkColor = "#ED2939";
				hitColor = '<img src="Images/Hit_Red.png" class="kryss" />';
				flagEgen = "Images/Flag_BEL.png";
			}
			if (layout == "AUT") {
				shipColor = "#EE2536";
				shadowColor = "#F4717C";
				sunkColor = "#A60C19";
				hitColor = '<img src="Images/Hit_White.png" class="kryss" />';
				flagEgen = "Images/Flag_AUT.png";
			}
		}

		elements = document.getElementsByClassName("templSkepp1");
		for (var i = 0; i < elements.length; i++) {
			elements[i].innerHTML = shipColor;
		}


		//Löser problemet med att statistik visar undefined genom att kalla på buggFix funktionen
		window.onload= () => {
			buggFix();
			saveShips();
		};

		function randomColor() {
			let colorR = Math.floor(Math.random()*11);
			switch(colorR){
				case 0:
					//Standard färg
					shipColorEnemy = "#333333";
					sunkColorEnemy = "#860d0d";
					hitColorEnemy = '<img src="Images/Hit_Red.png" class="kryss" />';
					flagEnemy = "Images/Flag_DEF.png";
					break;
				case 1:
					//Svenska färger
					shipColorEnemy = "#2d5fa1";
					sunkColorEnemy = "#1c3b63";
					hitColorEnemy = '<img src="Images/Hit_Yellow.png" class="kryss" />';
					flagEnemy = "Images/Flag_SWE.png";
					break;
				case 2:
					//Danska färger
					shipColorEnemy = "#C60C30";
					sunkColorEnemy = "#910824";
					hitColorEnemy = '<img src="Images/Hit_White.png" class="kryss" />';
					flagEnemy = "Images/Flag_DNK.png";
					break;
				case 3:
					//Finska färger
					shipColorEnemy = "#003580";
					sunkColorEnemy = "#001533";
					hitColorEnemy = '<img src="Images/Hit_White.png" class="kryss" />';
					flagEnemy = "Images/Flag_FIN.png";
					break;
				case 4:
					//Norska färger
					shipColorEnemy = "#002868";
					sunkColorEnemy = "#EF2B2D";
					hitColorEnemy = '<img src="Images/Hit_White.png" class="kryss" />';
					flagEnemy = "Images/Flag_NOR.png";
					break;
				case 5:
					//Estoniska färger
					shipColorEnemy = "#0073D0";
					sunkColorEnemy = "#005499";
					hitColorEnemy = '<img src="Images/Hit_White.png" class="kryss" />';
					flagEnemy = "Images/Flag_EST.png";
					break;
				case 6:
					//latviska färger
					shipColorEnemy = "#9E292B";
					sunkColorEnemy = "#7a1f21";
					hitColorEnemy = '<img src="Images/Hit_White.png" class="kryss" />';
					flagEnemy = "Images/Flag_LVA.png";
					break;
				case 7:
					//Litauiska färger
					shipColorEnemy = "#006A44";
					sunkColorEnemy = "#003320";
					hitColorEnemy = '<img src="Images/Hit_Lit.png" class="kryss" />';
					flagEnemy = "Images/Flag_LTU.png";
					break;
				case 8:
					//Tyska färger
					shipColorEnemy = "#FFCF00";
					sunkColorEnemy = "#b39200";
					hitColorEnemy = '<img src="Images/Hit_rED.png" class="kryss" />';
					flagEnemy = "Images/Flag_DEU.png";
					break;
				case 9:
					//Italienska färger
					shipColorEnemy = "#009344";
					sunkColorEnemy = "#006630";
					hitColorEnemy = '<img src="Images/Hit_rED.png" class="kryss" />';
					flagEnemy = "Images/Flag_ITA.png";
					break;
				case 9:
					//Belgiska färger
					shipColorEnemy = "#FAE042";
					sunkColorEnemy = "#ED2939";
					hitColorEnemy = '<img src="Images/Hit_White.png" class="kryss" />';
					flagEnemy = "Images/Flag_BEL.png";
					break;
				case 10:
					//Österikiska färger
					shipColorEnemy = "#EE2536";
					sunkColorEnemy = "#A60C19";
					hitColorEnemy = '<img src="Images/Hit_White.png" class="kryss" />';
					flagEnemy = "Images/Flag_AUT.png";
					break;
			}
		}

		function templateColor() {
			randomColor();
			playerDesign();
			elements = document.getElementsByClassName("templSkepp1");
			for (var i = 0; i < elements.length; i++) {
				elements[i].style.backgroundColor = shipColor;
			}
			elements = document.getElementsByClassName("templSkepp2");
			for (var i = 0; i < elements.length; i++) {
				elements[i].style.backgroundColor = shipColor;
			}
			elements = document.getElementsByClassName("enemyShip");
			for (var i = 0; i < elements.length; i++) {
				elements[i].style.backgroundColor = shipColorEnemy;
			}
			document.getElementById("vs").innerHTML = '<img id="flag1" src='+flagEgen+' class="flag" /> <div id="vsText">VS</div>	<img id="flag2" src='+flagEnemy+' class="flag" />';


		}

		//Sparar rutan med skepp som kan placeras  när programmet först laddas
		function saveShips() {
			if (reset) {
				document.getElementById("storage").innerHTML = document.getElementById("egnaSkepp").innerHTML;
				document.getElementById("storage").style.visibility = "hidden";
				reset = false;
			}
		}


		//Funktion för att starta spelet och nollställa
		function startSpel() {
			if(difShow == 2) {
				$("#difficultySelecter").remove();
				difShow = 1;
			}



			if (start && 	$("#startKnapp").hasClass("knapp")) {

				//ändrar knappens text
				document.getElementById("startKnapp").innerHTML = "Starta spel";

				//Resettar spelplanen och diverse variabler
				templateColor();
				cheat = 0;
				start = false;
				end = false;
				antalKlick = 0;
				egnaSkott = [];
				fiendeSkott = [];
				egnaSkepp = [];
				fiendeSkepp = [];
				hitsFiende = [];
				hitsEgna = [];
				time = 0;

				//Gör startknappen oklickbar tills spelarens skepp har lagts ut
				$("#startKnapp").addClass("knappDisabled");
				$("#startKnapp").removeClass("knapp");
				shipCorrect = false;

				//Gör svårighetsgradsknappen klickbar
				$("#difficultyKnapp").addClass("knapp");
				$("#difficultyKnapp").removeClass("knappDisabled");

				//Nollställer träff-indikatörerna
				elements = document.getElementsByClassName("enemy1");
				for (var i = 0; i < elements.length; i++) {
					elements[i].innerHTML = "";
				}
				elements = document.getElementsByClassName("enemy2");
				for (var i = 0; i < elements.length; i++) {
					elements[i].innerHTML = "";
				}
				elements = document.getElementsByClassName("enemy3");
				for (var i = 0; i < elements.length; i++) {
					elements[i].innerHTML = "";
				}
				elements = document.getElementsByClassName("enemy4");
				for (var i = 0; i < elements.length; i++) {
					elements[i].innerHTML = "";
				}
				elements = document.getElementsByClassName("enemy5");
				for (var i = 0; i < elements.length; i++) {
					elements[i].innerHTML = "";
				}

				enemy1 = [];
				enemy2 = [];
				enemy3 = [];
				enemy4 = [];
				enemy5 = [];

				shipHits1 = 0;
				shipHits2 = 0;
				shipHits3 = 0;
				shipHits4 = 0;
				shipHits5 = 0;

				friendly1 = [];
				friendly2 = [];
				friendly3 = [];
				friendly4 = [];
				friendly5 = [];

				enemyHits1 = 0;
				enemyHits2 = 0;
				enemyHits3 = 0;
				enemyHits4 = 0;
				enemyHits5 = 0;

				//Skapar den egna spelplanen pånytt
 				let text = '';
				for (let i = 0; i < 10; i++) {
					for (let j = 0; j < 10; j++) {
						text += `<div id="${i + "-" + j}" class="ruta" ${"x"+i} ${"y" + j} onmouseenter=\"placeraMus(${i}, ${j})\" onmouseleave=\"placeraMusRemove(${i}, ${j})\" onclick=\"placera(${i}, ${j})\">&nbsp</div>`;
					}
				}
				$("#egen").html(text);

				//Skapar fiendens spelplan pånytt
 				text = '';
				for (let i = 0; i < 10; i++) {
					for (let j = 0; j < 10; j++) {
					text += `<div id="${i + "." + j}" class="rutaFiende" ${"x"+i} ${"y" + j} onclick=\"skott(${i}, ${j})\">&nbsp</div>`;
					}
				}
				$("#fiende").html(text);

				//Resettar skepplistan
				$("#egnaSkepp").html($("#storage").html());

				//Om spelet inte var startat och alla skeppen var utlaggda så startar spelet
			} else if(shipCorrect) {
				start = true;
				fiendePlacera();

				//Inaktiverar difficulty-knappen
				$("#difficultyKnapp").removeClass("knapp");
				$("#difficultyKnapp").addClass("knappDisabled");

				$("#startKnapp").addClass("knapp");
				$("#startKnapp").removeClass("knappDisabled");

				//ändrar knappens text
				document.getElementById("startKnapp").innerHTML = "Restart";
			}
		}


		//Skapar den egna spelplanen
		$(document).ready(function(){
 			let text = '';
			for (var i = 0; i < 10; i++) {
				for (var j = 0; j < 10; j++) {
					text += `<div id="${i + "-" + j}" class="ruta" ${"x"+i} ${"y" + j} onmouseenter=\"placeraMus(${i}, ${j})\" onmouseleave=\"placeraMusRemove(${i}, ${j})\" onclick=\"placera(${i}, ${j})\">&nbsp</div>`;
				}
			}
			document.getElementById('egen').innerHTML = text;
		  });

		//Skapar fiendens spelplan
		$(document).ready(function(){
 			let text = '';
			for (var i = 0; i < 10; i++) {
				for (var j = 0; j < 10; j++) {
					text += `<div id="${i + "." + j}" class="rutaFiende" ${"x"+i} ${"y" + j} onclick=\"skott(${i}, ${j})\">&nbsp</div>`;
				}
			}
			document.getElementById('fiende').innerHTML = text;
		  });

		//Funktikon för att registrera och visa skjutet skott på vald ruta
		function skott(x, y) {
			if (start && !end) {
				//Om skotten är satt på en ledig ruta (inget tidigare skott)
				let fel = 0;

				//loopar ingenom listan med egnaSkott rutor för att kolla om det nya skottet överlappar med gamla
				for (var i = 0; i < egnaSkott.length; i++) {
					if ((x+"."+y) == egnaSkott[i]) {
						fel = 1;
					}
				}
				if (fel == 0) {
					//lägger i det nya skottet i Arrayen med skott
					egnaSkott.push(x+"."+y);
					if (fiendeSkepp.includes(x+"."+y)) {
						//Träff
						document.getElementById(x+"."+y).innerHTML = hitColorEnemy;
					} else {
						//Miss
						document.getElementById(x+"."+y).innerHTML = '<img src="Images/Kryss.png" class="kryss" />';
					}

					if (fiendeSkepp.includes(x+"."+y)) {
						hitsEgna.push(x+"."+y);
					}

					if (enemy1.includes(x+"."+y)) {
						shipHits1++;
					}
					if (enemy2.includes(x+"."+y)) {
						shipHits2++;
					}
					if (enemy3.includes(x+"."+y)) {
						shipHits3++;
					}
					if (enemy4.includes(x+"."+y)) {
						shipHits4++;
					}
					if (enemy5.includes(x+"."+y)) {
						shipHits5++;
					}

					tur = false;
				}

				if (shipHits1 == 5) {

					//markerar sänkt skepp nere i skepp-rutan
					elements = document.getElementsByClassName("enemy1");
	    		for (var i = 0; i < elements.length; i++) {
	        	elements[i].innerHTML = hitColorEnemy;
	    		}

					//markerar sänkt skepp på spelplanen
					for (var i = 0; i < 5; i++) {
						document.getElementById(enemy1[i]).style.backgroundColor = sunkColorEnemy;
					}
				}

				if (shipHits2 == 4) {

					//markerar sänkt skepp nere i skepp-rutan
					elements = document.getElementsByClassName("enemy2");
	    		for (var i = 0; i < elements.length; i++) {
	        	elements[i].innerHTML = hitColorEnemy;
	    		}

					//markerar sänkt skepp på spelplanen
					for (var i = 0; i < 4; i++) {
						document.getElementById(enemy2[i]).style.backgroundColor = sunkColorEnemy;
					}
				}

				if (shipHits3 == 3) {
					//markerar sänkt skepp nere i skepp-rutan
					elements = document.getElementsByClassName("enemy3");
	    		for (var i = 0; i < elements.length; i++) {
	        	elements[i].innerHTML = hitColorEnemy;
	    		}

					//markerar sänkt skepp på spelplanen
					for (var i = 0; i < 3; i++) {
						document.getElementById(enemy3[i]).style.backgroundColor = sunkColorEnemy;
					}
				}

				if (shipHits4 == 3) {
					//markerar sänkt skepp nere i skepp-rutan
					elements = document.getElementsByClassName("enemy4");
	    		for (var i = 0; i < elements.length; i++) {
	        	elements[i].innerHTML = hitColorEnemy;
	    		}

					//markerar sänkt skepp på spelplanen
					for (var i = 0; i < 3; i++) {
						document.getElementById(enemy4[i]).style.backgroundColor = sunkColorEnemy;
					}
				}

				if (shipHits5 == 2) {
					//markerar sänkt skepp nere i skepp-rutan
					elements = document.getElementsByClassName("enemy5");
	    		for (var i = 0; i < elements.length; i++) {
	        	elements[i].innerHTML = hitColorEnemy;
	    		}

					//markerar sänkt skepp på spelplanen
					for (var i = 0; i < 2; i++) {
						document.getElementById(enemy5[i]).style.backgroundColor = sunkColorEnemy;
					}
				}

				if ((shipHits1+shipHits2+shipHits3+shipHits4+shipHits5) == fiendeSkepp.length) {

					//Delar upp tiden i sekunder och minuter
					if (time > 59) {
						var minuter = time;
						var sekunder = minuter%60;

						minuter -= sekunder;
						minuter = minuter/60;
						var tidText = minuter+"m, " + sekunder + "s";
					} else {
						var tidText = time + " sekunder";
					}
						end = true;

					//Skapar ett objekt för att skicka med diverse info till ajaxsidan
					var stats = {difficulty: difficulty, shots: egnaSkott.length, hits: hitsEgna.length, time: time};
					var statsString = JSON.stringify(stats);

					let winText = "Efter " + tidText + " och " + egnaSkott.length +" skott så är fiendens flotta sänkt!";
					alertify.alert(winText).set('closable', false).setHeader('<em id="message"> Du vann! </em> ').set('notifier','position', 'bottom-right').setting({'label':'agree', 'label':'Stäng'});;
					var request = new XMLHttpRequest();
					request.open('GET', 'SpelAjax.php?val=win&statsString='+statsString, true);
					request.onload = () => {


						data = request.responseText;
					};
						request.send();

				} else {
						//Datorns tur att skjuta
						fiendeSkottFunc();
					}
			}
		}


		//Fiendens skott
		function fiendeSkottFunc() {
			while(!tur) {
				//Kordinater för slumpande skott baserat på förra träff-kordinater
				let xR = 1;
				let yR = 1;

				felFiende = 0;

				//Variabel för att bestämma om loopen ska fortsätta slumpa fram kordinater eller inte
				var slumpa = true;


				let intillLiggande = new Array();


				if (hit) {
					var hitCordsSplit = hitCords.split("-");

					xR = parseInt(hitCordsSplit[0]);
					yR = parseInt(hitCordsSplit[1]);

					xTest = xR;
					yTest = yR;

					while(slumpa){
						//Nollställer arrayen
						intillLiggande = [];
						let overlap = false;
						R = Math.floor(Math.random()*5);

						//slumpar fram nytt
						switch(R){
							case 1:
								xR++;
								break;
							case 2:
								xR--;
								break;
							case 3:
								yR++;
								break;
							case 4:
								yR--;
								break;
						}
						//Felhantering så det nya skottet inte hamnar utanför spelplanen

						if (xR > 9) {
							overlap = true;
							intillLiggande[0] = 1;
						}
						if (xR < 0) {
							overlap = true;
							intillLiggande[1] = 1;
						}
						if (yR > 9) {
							overlap = true;
							intillLiggande[2] = 1;
						}
						if (yR < 0) {
							overlap = true;
							intillLiggande[3] = 1;
						}

						//Kollar igenom tidigare skott så att det nya inte överlappar med gamla skott

						if (hitsFiende.includes(xR+"-"+yR)) {
							overlap = true;
							if (xR == (xTest+1)) {
								intillLiggande[0] = 1;
							}
							if (xR == (xTest-1)) {
								overlap = true;
								intillLiggande[1] = 1;
							}
							if (yR == (yTest+1)) {
								overlap = true;
								intillLiggande[2] = 1;
							}
							if (yR == (yTest-1)) {
								overlap = true;
								intillLiggande[3] = 1;
							}
						}
						if (fiendeSkott.includes(xR+"-"+yR)) {
							overlap = true;
							if (xR == (xTest+1)) {
								intillLiggande[0] = 1;
							}
							if (xR == (xTest-1)) {
								overlap = true;
								intillLiggande[1] = 1;
							}
							if (yR == (yTest+1)) {
								overlap = true;
								intillLiggande[2] = 1;
							}
							if (yR == (yTest-1)) {
								overlap = true;
								intillLiggande[3] = 1;
							}
						}


						//slutar slumpa fram närliggande kordinater om alla intillliggande rutor är träffar
						if (intillLiggande.length == 4) {
							slumpa = false;
							intillLiggande = [];

							//slumpar fram kordinater helt slumpmässigt istället
							xR = Math.floor(Math.random()*10);
							yR = Math.floor(Math.random()*10);
						}

						if (!overlap) {
							slumpa = false;
						}
					}


					if (egnaSkepp.includes(xR+"-"+yR)) {
						localHit = 1;
					}

					if (localHit == 1) {
						//registrerar och visar en träff
						fiendeSkott.push(xR+"-"+yR);
						hitsFiende.push(xR+"-"+yR);
						document.getElementById(xR+"-"+yR).innerHTML = hitColor;
						tur = true;
						hit = true;
						hitCords = (xR+"-"+yR);
					} else {
						//registrerar och visar en miss
						fiendeSkott.push(xR+"-"+yR);
						document.getElementById(xR+"-"+yR).innerHTML = '<img src="Images/Kryss.png" class="kryss" />';
						tur = true;
						hit = false;
					}

				} else {
					//slumpar fram kordinater för skott
					xR = Math.floor(Math.random()*10);
					yR = Math.floor(Math.random()*10);

					if (difficulty == 3) {
						if (cheat == 3) {
							for (var i = 0; i < egnaSkepp.length; i++) {
								if (!hitsFiende.includes(egnaSkepp[i])) {
									fiendeSkott.push(egnaSkepp[i]);
									hitsFiende.push(egnaSkepp[i]);
									document.getElementById(egnaSkepp[i]).innerHTML = hitColor;
									hit = true;
									localHit = 1;
									cheat = -1;
									hitCords = egnaSkepp[i];

									break;
								}
							}
						} else {
							randomShot();
						}
						tur = true;
						cheat++;
					}

					else if (difficulty == 2) {
						if (cheat == 6) {
							for (var i = 0; i < egnaSkepp.length; i++) {
								if (!hitsFiende.includes(egnaSkepp[i])) {
									fiendeSkott.push(egnaSkepp[i]);
									hitsFiende.push(egnaSkepp[i]);
									if (	document.getElementById(egnaSkepp[i]).innerHTML == hitColor) {
									}
									document.getElementById(egnaSkepp[i]).innerHTML = hitColor;
									hit = true;
									localHit = 1;
									cheat = -1;
									hitCords = egnaSkepp[i];
									break;
								}
							}
						} else {
							randomShot();
						}
						tur = true;
						cheat++;
					}

					else if (difficulty == 1) {

						felFiende = 0;

						if (fiendeSkott.includes(xR+"-"+yR)) {
							felFiende = 1;
						}
						if (felFiende == 0) {

							if (egnaSkepp.includes(xR+"-"+yR)) {
								localHit = 1;
							}

							if (localHit == 1) {
								//registrerar och visar en träff
								fiendeSkott.push(xR+"-"+yR);
								hitsFiende.push(xR+"-"+yR);
								document.getElementById(xR+"-"+yR).innerHTML = hitColor;
								tur = true;
								hit = true;
								hitCords = (xR+"-"+yR);
							} else {
								//registrerar och visar en miss
								fiendeSkott.push(xR+"-"+yR);
								document.getElementById(xR+"-"+yR).innerHTML = '<img src="Images/Kryss.png" class="kryss" />';
								tur = true;
								hit = false;
							}


						}

					}
				}

				//Sätter träffen på vänliga skeppet baserat på vilket skepp det var som träffades
				if (localHit == 1) {
					if (friendly1.includes(hitCords)) {
						enemyHits1++;
					}
					if (friendly2.includes(hitCords)) {
						enemyHits2++;
					}
					if (friendly3.includes(hitCords)) {
						enemyHits3++;
					}
					if (friendly4.includes(hitCords)) {
						enemyHits4++;
					}
					if (friendly5.includes(hitCords)) {
						enemyHits5++;
					}

					if (enemyHits1 == 5) {
						//markerar sänkt skepp på spelplanen
						for (var i = 0; i < 5; i++) {
							document.getElementById(friendly1[i]).style.backgroundColor = sunkColor;
						}
					}

					if (enemyHits2 == 4) {
						//markerar sänkt skepp på spelplanen
						for (var i = 0; i < 4; i++) {
							document.getElementById(friendly2[i]).style.backgroundColor = sunkColor;
						}
					}

					if (enemyHits3 == 3) {
						//markerar sänkt skepp på spelplanen
						for (var i = 0; i < 3; i++) {
							document.getElementById(friendly3[i]).style.backgroundColor = sunkColor;
						}
					}

					if (enemyHits4 == 3) {
						//markerar sänkt skepp på spelplanen
						for (var i = 0; i < 3; i++) {
							document.getElementById(friendly4[i]).style.backgroundColor = sunkColor;
						}
					}

					if (enemyHits5 == 2) {
						//markerar sänkt skepp på spelplanen
						for (var i = 0; i < 2; i++) {
							document.getElementById(friendly5[i]).style.backgroundColor = sunkColor;
						}
					}
					localHit = 0;
				}
		}

			//Uppdaterar spelarens statistik vid förlust
			if (hitsFiende.length == egnaSkepp.length) {

				if (time > 59) {
					var minuter = time;
					var sekunder = minuter%60;

					minuter -= sekunder;
					minuter = minuter/60;
					var tidText = minuter+"m, " + sekunder + "s";
				} else {
					var tidText = time + " sekunder";
				}
					end = true;

				//Skapar ett objekt för att skicka med diverse info till ajaxsidan
				var stats = {difficulty: difficulty, shots: egnaSkott.length, hits: hitsEgna.length, time: time};
				var statsString = JSON.stringify(stats);

				let loseText = "Efter " + tidText + " och " + fiendeSkott.length +" skott så är din flotta sänkt!";
				alertify.alert(loseText).set('closable', false).setHeader('<em id="message"> Du förlorade! </em> ').set('notifier','position', 'bottom-right').setting({'label':'agree', 'label':'Stäng'});
				var request = new XMLHttpRequest();
				request.open('GET', 'SpelAjax.php?val=loss&statsString='+statsString, true);
				request.onload = () => {

					data = request.responseText;
				};
					request.send();

			}
		}

		function randomShot() {
			felFiende = 0;

			xR = Math.floor(Math.random()*10);
			yR = Math.floor(Math.random()*10);

			for (let i = 0; i < fiendeSkott.length; i++) {
				if ((xR+"-"+yR) == fiendeSkott[i]) {
					felFiende = 1;
				}
			}
			if (felFiende == 0) {
				for (let j = 0; j < egnaSkepp.length; j++) {
					if ((xR+"-"+yR) == egnaSkepp[j]) {
						localHit = 1;
					}
				}

				if (localHit == 1) {
					//registrerar och visar en träff
					fiendeSkott.push(xR+"-"+yR);
					hitsFiende.push(xR+"-"+yR);
					document.getElementById(xR+"-"+yR).innerHTML = hitColor;
					hitCords = (xR+"-"+yR);
					tur = true;
					hit = true;
				} else {
					//registrerar och visar en miss
					fiendeSkott.push(xR+"-"+yR);
					document.getElementById(xR+"-"+yR).innerHTML = '<img src="Images/Kryss.png" class="kryss" />';
					tur = true;
					hit = false;
				}
		}
			//Ser till så att nya kordinater slumpas fram vid fel (nytt skott är på en plats som redan är träffad)
			if (felFiende == 1) {;
					randomShot();
			}
		}

		//Funktion för att sätta ut skepp vid angivna kordinater
		function skeppPlace(x, y) {
			// document.getElementById(x+"-"+y).style.backgroundColor = "red";
			if (antalKlick == 1) {
				skeppLength = 0;
			}

			if (antalKlick == 2) {
				firstX = x;
				firstY = y;
				antalKlick--;
			}


			egnaSkepp.push(x+"-"+y);
			switch (id){
				case 1:
					friendly1.push(x+"-"+y);
					break;
				case 2:
					friendly2.push(x+"-"+y);
					break;
				case 3:
					friendly3.push(x+"-"+y);
					break;
				case 4:
					friendly4.push(x+"-"+y);
					break;
				case 5:
					friendly5.push(x+"-"+y);
					break;
			}
		}

		function overLap1() {
			if (firstX+skeppLength < 11) {
				tempBlocked = true;

				for (var j = firstX+1; j < firstX+skeppLength; j++) {
					// document.getElementById(j+"-"+y).innerHTML = '<img src="Images/Kryss.png" class="kryss" />';

					if (egnaSkepp.includes(j+"-"+firstY)) {
					tempBlocked = false;
					return false;
					}
				}
				if (tempBlocked) {
					return true;
				}
			}
		}

		function overLap2() {
			if ((firstX+-skeppLength) > -2) {
				tempBlocked = true;

				for (var j = firstX-skeppLength+1; j < firstX; j++) {
					// document.getElementById(j+"-"+y).innerHTML = '<img src="Images/Kryss.png" class="kryss" />';
					if (egnaSkepp.includes(j+"-"+firstY)) {
					tempBlocked = false;
					return false;
					}
				}
				if (tempBlocked) {
					return true;
				}
			}
		}

		function overLap3() {
			if (firstY+skeppLength < 11) {
				tempBlocked = true;

				for (var j = firstY+1; j < firstY+skeppLength; j++) {
					if (egnaSkepp.includes(firstX+"-"+j)) {
					tempBlocked = false;
					return false;
					}
				}
				if (tempBlocked) {
					return true;
				}
			}
		}
		function overLap4() {
			if ((firstY+-skeppLength) > -2) {
				tempBlocked = true;

				for (var j = firstY-skeppLength+1; j < firstY; j++) {

					if (egnaSkepp.includes(firstX+"-"+j)) {
					tempBlocked = false;
					return false;
					}
				}
				if (tempBlocked) {
					return true;
				}
			}
		}

		//Funktion för att registrera och visa den ursprunga utplaceringspunkten för ett skepp
		function placera(x, y) {
			if (!start && !end) {
				if (antalKlick == 2) {
					skeppPlace(x,y);

					notBlocked = true;

					notBlocked = overLap1();

					if ((x+skeppLength < 11) && notBlocked) {
						//lägger till möjliga skepp-placeringar i arrayen
						allowedPlace.push((x+skeppLength-1) + "-" + y);
					}

					notBlocked = overLap2();

					if ((x+-skeppLength) > -2  && notBlocked) {
						allowedPlace.push((x-skeppLength+1) + "-" + y);
					}

					notBlocked = overLap3();

					if (y+skeppLength < 11 && notBlocked) {
						allowedPlace.push(x + "-" + (y+skeppLength-1));
					};

					notBlocked = overLap4();

					if ((y+-skeppLength) > -2 && notBlocked) {
						allowedPlace.push(x + "-" + (y-skeppLength+1));
					}


					for (var i = 0; i < allowedPlace.length; i++) {
						document.getElementById(allowedPlace[i]).style.backgroundColor = shipColor;
					}
				}

				if (antalKlick == 1) {

					//Ser till att man bara kan klicka på skeppets möjliga utplaceringspunkter
					if (allowedPlace.includes(x+"-"+y)) {
							//tar bort de överflödiga placeringsrutorna
						for (var i = 0; i < allowedPlace.length; i++) {
							document.getElementById(allowedPlace[i]).style.backgroundColor = "";
						}
						allowedPlace = [];

						for (var i = 0; i < shipBP.length; i++) {
							egnaSkepp.push(shipBP[i]);
							switch (id){
								case 1:
									friendly1.push(shipBP[i]);
									break;
								case 2:
									friendly2.push(shipBP[i]);
									break;
								case 3:
									friendly3.push(shipBP[i]);
									break;
								case 4:
									friendly4.push(shipBP[i]);
									break;
								case 5:
									friendly5.push(shipBP[i]);
									break;
							}
						}
						shipBP = [];


						for (var i = 0; i < friendly1.length; i++) {
						}

						//sätter alla rutor till skepp-färgen
						for (var i = 0; i < egnaSkepp.length; i++) {
							document.getElementById(egnaSkepp[i]).style.backgroundColor = shipColor;
						}

						antalKlick--;
					}

					shipCorrect = false;

					//Aktiverar startknappen när alla spelarens skepp är utlagda
					if (egnaSkepp.length == 17) {
						$("#startKnapp").removeClass("knappDisabled");
						$("#startKnapp").addClass("knapp");
						shipCorrect = true;
					}
				}





			}
		}
    function randomKord(){
      let rand = Math.floor(Math.random()*10);
      return rand;
    }

		function fiendePlacera() {
			let fiendeSkeppNummer = 1;

			while(fiendeSkeppNummer < 6) {

				let fel = false;
				let fiendeFel = true;

				let xLast;
				let yLast;

				let overlap = false;

				xR = randomKord();
				yR = randomKord();

				while(fiendeSkepp.includes(xR+"."+yR)) {
          xR = randomKord();
  				yR = randomKord();
				}


				switch(fiendeSkeppNummer){
					case 1:
						fiendeLength = 5;
						fiendeSkeppNummer++;
						break;
					case 2:
						fiendeLength = 4;
						fiendeSkeppNummer++;
						break;
					case 3:
						fiendeLength = 3;
						fiendeSkeppNummer++;
						break;
					case 4:
						fiendeLength = 3;
						fiendeSkeppNummer++;
						break;
					case 5:
						fiendeLength = 2;
						fiendeSkeppNummer++;
						break;
					}

				//vilket riktning skeppet ligger åt
				DirectionError = new Array();

        let Error = true;

				direction = Math.floor(Math.random()*4);

				while(Error){
          direction = Math.floor(Math.random()*4);

        	DirectionError = [];

					let antalFel = 0;

					for (var i = xR; i < xR+fiendeLength ; i++) {
						if (fiendeSkepp.includes(i+"."+yR)) {
							DirectionError[0] = 0;
						}
            if (xR+fiendeLength > 9) {
              DirectionError[0] = 0;
            }
					}

          for (var i = (xR-fiendeLength); i < xR ; i++) {
						if (fiendeSkepp.includes(i+"."+yR)) {
							DirectionError[1] = 1;
						}
            if ((xR-fiendeLength) < 0) {
              DirectionError[1] = 1;
            }
					}

          for (var i = yR; i < yR+fiendeLength ; i++) {
						if (fiendeSkepp.includes(xR+"."+i)) {
							DirectionError[2] = 2;
						}
            if (yR+fiendeLength > 9) {
              DirectionError[2] = 2;
            }
					}

          for (var i = (yR-fiendeLength); i < yR ; i++) {
						if (fiendeSkepp.includes(xR+"."+i)) {
							DirectionError[3] = 3;
						}
            if ((yR-fiendeLength) < 0) {
              DirectionError[3] = 3;
            }
					}


          for (var i = 0; i < DirectionError.length; i++) {
            if (DirectionError.includes(i)) {
              antalFel++
            }
          }

          if (antalFel < 4) {
            Error = false;
          }
				}


        let wrongDirection = true;

        //Ser till att riktningen inte blir till någon av de rikningarna där problem uppstod
        while (wrongDirection) {
          direction = Math.floor(Math.random()*4);
          if (!DirectionError.includes(direction)) {
            wrongDirection = false;
          }
        }

				//Sätter ut skeppets slutkordinater baserat på skeppets riktning
				switch(direction){
					case 0:
						xLast = xR + fiendeLength;
						yLast = yR;
						break;
					case 1:
						xLast = xR - fiendeLength;
						yLast = yR;
						break;
					case 2:
						yLast = yR + fiendeLength;
						xLast = xR;
						break;
					case 3:
						yLast = yR - fiendeLength;
						xLast = xR;
						break;
				}


				if (xR != xLast) {
					if (xR < xLast) {
						for (var i = xR; i < xLast ; i++) {
							//document.getElementById(i+"."+yLast).style.backgroundColor = "#333333";
							switch(fiendeSkeppNummer) {
								case 2:
									enemy1.push(i+"."+yLast);
									break;
								case 3:
									enemy2.push(i+"."+yLast);
									break;
								case 4:
									enemy3.push(i+"."+yLast);
									break;
								case 5:
									enemy4.push(i+"."+yLast);
									break;
								case 6:
									enemy5.push(i+"."+yLast);
									break;
							}
							fiendeSkepp.push(i+"."+yLast);
						}

					} else {
						for (var i = xLast; i < xR ; i++) {
							//document.getElementById(i+"."+yLast).style.backgroundColor = "#333333";
							switch(fiendeSkeppNummer) {
								case 2:
									enemy1.push(i+"."+yLast);
									break;
								case 3:
									enemy2.push(i+"."+yLast);
									break;
								case 4:
									enemy3.push(i+"."+yLast);
									break;
								case 5:
									enemy4.push(i+"."+yLast);
									break;
								case 6:
									enemy5.push(i+"."+yLast);
									break;
							}
							fiendeSkepp.push(i+"."+yLast);
						}
					}

				} else {
					if (yR < yLast) {
						for (var i = yR; i < yLast ; i++) {
							//document.getElementById(xLast+"."+i).style.backgroundColor = "#333333";
							switch(fiendeSkeppNummer) {
								case 2:
									enemy1.push(xLast+"."+i);
									break;
								case 3:
									enemy2.push(xLast+"."+i);
									break;
								case 4:
									enemy3.push(xLast+"."+i);
									break;
								case 5:
									enemy4.push(xLast+"."+i);
									break;
								case 6:
									enemy5.push(xLast+"."+i);
									break;
							}
							fiendeSkepp.push(xLast+"."+i);
						}

					} else {
						for (var i = yLast; i < yR ; i++) {
							//document.getElementById(xLast+"."+i).style.backgroundColor = "#333333";
							switch(fiendeSkeppNummer) {
								case 2:
									enemy1.push(xLast+"."+i);
									break;
								case 3:
									enemy2.push(xLast+"."+i);
									break;
								case 4:
									enemy3.push(xLast+"."+i);
									break;
								case 5:
									enemy4.push(xLast+"."+i);
									break;
								case 6:
									enemy5.push(xLast+"."+i);
									break;
							}
							fiendeSkepp.push(xLast+"."+i);
						}
					}
				}

			}


		}

		function egnaSkeppPaint() {
			for (var i = 0; i < egnaSkepp.length; i++) {
					document.getElementById(egnaSkepp[i]).style.backgroundColor = shipColor;
			}
		}

		//tar bort "spökskeppet" från plats 1
		function remove1(){
			if (firstX+skeppLength < 11) {
				for (var i = firstX+1; i < (firstX+skeppLength-1); i++) {
				document.getElementById(i+"-"+firstY).style.backgroundColor = "";
				}
			}


			egnaSkeppPaint();

		}

		//tar bort "spökskeppet" från plats 2
		function remove2(){

			if (firstX+-skeppLength > -2) {
				for (var i = (firstX-skeppLength+2); i < firstX; i++) {
				document.getElementById(i+"-"+firstY).style.backgroundColor = "";
				}
			}



			egnaSkeppPaint();
		}

		//tar bort "spökskeppet" från plats 3
		function remove3(){

			if (firstY+skeppLength < 11) {
				for (var i = firstY+1; i < (firstY+skeppLength-1); i++) {
				document.getElementById(firstX+"-"+i).style.backgroundColor = "";
				}
			}



			egnaSkeppPaint();
		}

		//tar bort "spökskeppet" från plats 4
		function remove4(){

			if (firstY+-skeppLength > -2) {
				for (var i = (firstY-skeppLength+2); i < firstY; i++) {
				document.getElementById(firstX+"-"+i).style.backgroundColor = "";
				}
			}



			egnaSkeppPaint();
		}

		function possiblePlace(x, y){
			if (antalKlick == 1) {



				allowShadow = overLap1();


				if (firstX+skeppLength < 11 && allowShadow) {

					if (x == (firstX+skeppLength-1) && y == firstY ) {
						shipBP = [];
						for (var i = firstX+1; i < (firstX+skeppLength); i++) {
							document.getElementById(i+"-"+firstY).style.backgroundColor = shadowColor;
							shipBP.push(i+"-"+firstY);
						}
						document.getElementById((firstX+skeppLength-1)+"-"+firstY).style.backgroundColor = shipColor;

						//tar bort det visade skeppet från de andra lägerna
						remove2();
						remove3();
						remove4();
					}
				}

				allowShadow = overLap2();

				if (firstX+skeppLength > -2 && allowShadow) {
					if (x == (firstX-skeppLength+1) && y == firstY) {


						shipBP = [];
						for (var i = (firstX-skeppLength+1); i < firstX; i++) {
							document.getElementById(i+"-"+firstY).style.backgroundColor = shadowColor;
							shipBP.push(i+"-"+firstY);

						}
						document.getElementById((firstX-skeppLength+1)+"-"+firstY).style.backgroundColor = shipColor;

						//tar bort det visade skeppet från de andra lägerna
						remove1();
						remove3();
						remove4();
					}
				}

				allowShadow = overLap3();

				if (firstY+skeppLength < 11 && allowShadow) {
					if (x == firstX && y == (firstY+skeppLength-1)) {
						shipBP = [];
						for (var i = firstY+1; i < (firstY+skeppLength); i++) {
							document.getElementById(firstX+"-"+i).style.backgroundColor = shadowColor;
							shipBP.push(firstX+"-"+i);
						}
						document.getElementById(firstX+"-"+(firstY+skeppLength-1)).style.backgroundColor = shipColor;

						//tar bort det visade skeppet från de andra lägerna
						remove1();
						remove2();
						remove4();
					}
				}

				allowShadow = overLap4();

				if (firstY+skeppLength > -2 && allowShadow) {
					if (x == firstX && y == (firstY-skeppLength+1)) {
						shipBP = [];
						for (var i = (firstY-skeppLength+1); i < firstY; i++) {

							document.getElementById(firstX+"-"+i).style.backgroundColor = shadowColor;
							shipBP.push(firstX+"-"+i);
						}
						document.getElementById(firstX+"-"+(firstY-skeppLength+1)).style.backgroundColor = shipColor;

						//tar bort det visade skeppet från de andra lägerna
						remove1();
						remove2();
						remove3();
					}
				}
			}

		}

		function placeraMus(x, y) {
			if (!start && !end) {

				if (antalKlick == 2) {
					document.getElementById(x+"-"+y).style.backgroundColor = shipColor;
				}


				if (antalKlick == 1) {


				possiblePlace(x,y);



				}


			}
		}

		function placeraMusRemove(x, y) {

			var fel = 0;
			for (var i = 0; i < egnaSkepp.length; i++) {
				if ((x+"-"+y) == egnaSkepp[i]) {
					fel = 1;
				}
			}


			for (var i = 0; i < allowedPlace.length; i++) {
				if ((x+"-"+y) == allowedPlace[i]) {
					fel = 1;
				}
			}
			for (var i = 0; i < shipBP.length; i++) {
				if ((x+"-"+y) == shipBP[i]) {
					fel = 1;
				}
			}



			if (fel == 0) {

				document.getElementById(x+"-"+y).style.backgroundColor = "";
			}

			possiblePlace(x,y);
		}

		function showDif() {
			if (!start) {
				//visar eller gömmer svårighetsgradsväljaren
				if (difShow == 1) {
					let text = document.getElementById("meny").innerHTML;
					if (difficulty == 1) {
						text += `<div id="difficultySelecter" class="unselectable">
						<div id="easy" class="difficulty" onclick='changeDifficulty(1)'><img src="Images/Kryss.png" class="kryssDif" /></div>
						<div id="medium" class="difficulty" onclick='changeDifficulty(2)'>&nbsp</div>
						<div id="hard" class="difficulty" onclick='changeDifficulty(3)'>&nbsp</div>
						</div>`;
					} else if (difficulty == 2) {
						text += `<div id="difficultySelecter" class="unselectable">
						<div id="easy" class="difficulty" onclick='changeDifficulty(1)'>&nbsp</div>
						<div id="medium" class="difficulty" onclick='changeDifficulty(2)'><img src="Images/Kryss.png" class="kryssDif" /></div>
						<div id="hard" class="difficulty" onclick='changeDifficulty(3)'>&nbsp</div>
						</div>`;
					} else {
						text += `<div id="difficultySelecter" class="unselectable">
						<div id="easy" class="difficulty" onclick='changeDifficulty(1)'>&nbsp</div>
						<div id="medium" class="difficulty" onclick='changeDifficulty(2)'>&nbsp</div>
						<div id="hard" class="difficulty" onclick='changeDifficulty(3)'><img src="Images/Kryss.png" class="kryssDif" /></div>
						</div>`;
					}
					difShow = 2;
					document.getElementById("meny").innerHTML = text;
				} else {
					difShow = 1;
					$("#difficultySelecter").remove();
				}
				$("#difficultyKnapp").removeClass("knappDisabled");

			}
		}

		//Ändrar svårighetsgraden och markerar vald svårighetsgrad
		function changeDifficulty(value) {
			if (value == 1) {
				difficulty = 1;
				document.getElementById("easy").innerHTML = '<img src="Images/Kryss.png" class="kryssDif" />';
				document.getElementById("medium").innerHTML = '';
				document.getElementById("hard").innerHTML = '';
			} else if (value == 2) {
				difficulty = 2;
				document.getElementById("easy").innerHTML = '';
				document.getElementById("medium").innerHTML = '<img src="Images/Kryss.png" class="kryssDif" />';
				document.getElementById("hard").innerHTML = '';
			} else {
				difficulty = 3;
				document.getElementById("easy").innerHTML = '';
				document.getElementById("medium").innerHTML = '';
				document.getElementById("hard").innerHTML = '<img src="Images/Kryss.png" class="kryssDif" />';
			}
		}


		function place(idTemp) {
			if (antalKlick == 0) {
				id = idTemp;

				if (!start && !end) {
					allowedPlace = [];

					if (id == 1) {
						skeppLength = 5;
					} else if (id == 2){
						skeppLength = 4;
					} else if (id == 3){
						skeppLength = 3;
					} else if (id == 4){
						skeppLength = 3;
					} else if (id == 5){
						skeppLength = 2;
					}
					//sätter förra placerade kordinaterna till "nollställt" läge
					antalKlick = 2;

					document.getElementById("storage").style.visibility = "hidden";


					let skeppID = `skepp${id}`;

					var element = document.getElementById(skeppID);
	   				element.parentNode.removeChild(element);
				}
			}
		}

		function buggFix() {
			showDif();
			showDif();
		}
