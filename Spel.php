<!DOCTYPE html>
<html>
<head>
	<?php 

		require "./Felhantering.php";
	?>

	<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		//Om spelet är påbörjat eller om det är i skepp-placeringsfasen 
		let start = false; 

		//Ser till så att menys utseende sparas första gången showStats funktionen används
		let stats = 1;

		//Array med kordinater för alla ens egna skott, för att förhindra två skott på en ruta
		let klickade = new Array();

		//Array med kordinater för alla fiendens skott, för att förhindra två skott på en ruta
		let klickadeFiende = new Array();

		//Om det är spelarens tur eller inte
		let tur = true;

		//Ursprungligt utseende på menyn som används för att gå tillbaka till det ursprungliga utseendet
		let orig;

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

		//Lista med kordinaterna för fiendens träffar
		let hitsFiende = new Array();

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

		let allowShadow;

		//Löser problemet med att statistik visar undefined genom att kalla på buggFix funktionen
		window.onload= () => {
			buggFix();
			saveShips();

		};

		//Sparar rutan med skepp som kan placeras  när programmet först laddas 
		

		function saveShips() {
			if (reset) {
				document.getElementById("temp").innerHTML = document.getElementById("egnaSkepp").innerHTML;
				document.getElementById("temp").style.visibility = "hidden";
				reset = false;
			}
		}
		
		//Funktion för att starta spelet och nollställa 
		function startSpel() {
			if(stats == 3) {
				document.getElementById("meny").innerHTML = orig;
				stats = 2;
			}

			if (start) {



				//Resettar spelplanen

				start = false;
				antalKlick = 0;
				klickade = [];
				klickadeFiende = [];
				egnaSkepp = [];
				fiendeSkepp = [];
				hitsFiende = [];
				
				//Skapar den egna spelplanen pånytt
 				let text = '';
				for (let i = 0; i < 10; i++) {
					for (let j = 0; j < 10; j++) {
						text += `<div id="${i + "-" + j}" class="ruta" ${"x"+i} ${"y" + j} onmouseenter=\"placeraMus(${i}, ${j})\" onmouseleave=\"placeraMusRemove(${i}, ${j})\" onclick=\"placera(${i}, ${j})\">&nbsp</div>`;
					}
				}
				document.getElementById('egen').innerHTML = text;

				//Skapar fiendens spelplan pånytt
 				text = '';
				for (let i = 0; i < 10; i++) {
					for (let j = 0; j < 10; j++) {
					text += `<div id="${i + "." + j}" class="rutaFiende" ${"x"+i} ${"y" + j} onclick=\"skott(${i}, ${j})\">&nbsp</div>`;
					}
				}
				document.getElementById('fiende').innerHTML = text;

				//Resettar skepplistan 
				document.getElementById("egnaSkepp").innerHTML = document.getElementById("temp").innerHTML;
			} else {
				start = true;	
				fiendePlacera();
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
			if (start) {
				
				//Om skotten är satt på en ledig ruta (inget tidigare skott)
				let fel = 0;

				//loopar ingenom listan med klickade rutor för att kolla om det nya skottet överlappar med gamla
				for (var i = 0; i < klickade.length; i++) {
					if ((x+"."+y) == klickade[i]) {
						fel = 1;
					}	
				}
				if (fel == 0) {
					//lägger i det nya skottet i Arrayen med skott 
					klickade.push(x+"."+y);
					if (fiendeSkepp.includes(x+"."+y)) {
						//Träff
						document.getElementById(x+"."+y).innerHTML = '<img src="Kryss_Hit.png" class="kryss" />';
					} else {
						//Miss
						document.getElementById(x+"."+y).innerHTML = '<img src="Kryss.png" class="kryss" />';	
					}
					
					tur = false;	
				}

				//Datorns tur att skjuta 
				fiendeSkott();
			}
			
		} 

		//Fiendens skott
		function fiendeSkott() {
			while(!tur) { 
				//Kordinater för slumpande skott baserat på förra träff-kordinater
				let xR = 1;
				let yR = 1;

				//upptäcker om det uppstår några fel. Om fel > 0 så går det inte att skjuta på valda kordinater
				var felFiende = 0;
				
				//Variabel för att bestämma om loopen ska fortsätta slumpa fram kordinater eller inte
				var slumpa = true;


				let intillLiggande = new Array(); 

				console.log("Fiende: "+hitsFiende.length +" | Skepp: "+ egnaSkepp.length);

				for (var i = 0; i < egnaSkepp.length; i++) {
					console.log("egnaSkepp: " + egnaSkepp[i]);
				}

				if (hit) {

					while(slumpa){
						let overlap = false;
						R = Math.floor(Math.random()*5);

						//slumpar fram nytt 
						switch(R){
							case 1: 
								xR = xR + 1;
								break;
							case 2: 
								xR = xR - 1;
								break;
							case 3: 
								yR = yR + 1;
								break;
							case 4: 
								yR = yR - 1;
								break; 
						}
						//Felhantering så det nya skottet inte hamnar utanför spelplanen
						if (xR == -1) {
							xR += 2;
							intillLiggande[0] = 1;
						}
						if (xR == 11) {
							xR -= 2;
							intillLiggande[1] = 1;
						}
						if (yR == -1) {
							yR += 2;
							intillLiggande[2] = 1;
						}
						if (yR == 11) {
							yR -= 2;
							intillLiggande[3] = 1;
						}

						//Kollar igenom tidigare skott så att det nya inte överlappar med gamla skott
						for (let i = 0; i < hitsFiende.length; i++) {
							if ((xR+"-"+yR) == hitsFiende[i]) {
								overlap = true;
							} 
						}
						for (let i = 0; i < klickadeFiende.length; i++) {
							if ((xR+"-"+yR) == klickadeFiende[i]) {
								overlap = true;
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
					
					
					
				} else {	
					//slumpar fram kordinater för skott		
					xR = Math.floor(Math.random()*10);
					yR = Math.floor(Math.random()*10);		
				}


				var localHit = 0; 
				
				for (let i = 0; i < klickadeFiende.length; i++) {
					if ((xR+"-"+yR) == klickadeFiende[i]) {
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
						klickadeFiende.push(xR+"-"+yR);
						hitsFiende.push(xR+"-"+yR);
						document.getElementById(xR+"-"+yR).innerHTML = '<img src="Kryss_Hit.png" class="kryss" />';	
						tur = true;
						hit = true;
					} else {
						//registrerar och visar en miss
						klickadeFiende.push(xR+"-"+yR);
						document.getElementById(xR+"-"+yR).innerHTML = '<img src="Kryss.png" class="kryss" />';	
						tur = true;
						hit = false;
					}		
				}
			}

			//Uppdaterar spelarens statistik vid förlust
			if (hitsFiende.length == egnaSkepp.length) {
				alert("Du förlorade!");
				var request = new XMLHttpRequest();
				request.open('GET', 'SpelAjax.php?text='+"loss", true);
				request.onload = () => {

					data = request.responseText;
				};
					request.send();
			}
		}

		//Funktion för att sätta ut skepp vid angivna kordinater
		function skeppPlace(x, y) {
			document.getElementById(x+"-"+y).style.backgroundColor = "#333333";
			if (antalKlick == 1) {
				skeppLength = 0;
			}

			if (antalKlick == 2) {
				firstX = x;
				firstY = y;
				antalKlick--;
			}
			
			
			egnaSkepp.push(x+"-"+y);
			
		}

		function overLap1() {
			if (firstX+skeppLength < 11) {				
				tempBlocked = true;

				for (var j = firstX+1; j < firstX+skeppLength; j++) {
					//document.getElementById(j+"-"+y).innerHTML = '<img src="Kryss.png" class="kryss" />';

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
					//document.getElementById(j+"-"+y).innerHTML = '<img src="Kryss.png" class="kryss" />';
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
			if (!start) {
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
						document.getElementById(allowedPlace[i]).style.backgroundColor = "#333333";
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
						}
						shipBP = [];

						//sätter alla rutor till skepp-färgen
						for (var i = 0; i < egnaSkepp.length; i++) {
							document.getElementById(egnaSkepp[i]).style.backgroundColor = "#333333";
						}

						antalKlick--;
					}
					
					
				}
				
 
					
				

			}		
		}

		function fiendePlacera() {
			let fiendeSkeppNummer = 1;

			while(fiendeSkeppNummer < 6) {

				let fel = false;
				let fiendeFel = true;

				let xLast;
				let yLast;

				let overlap = false;

				xR = Math.floor(Math.random()*10);
				yR = Math.floor(Math.random()*10);

				while(fiendeSkepp.includes(xR+"."+yR)) {
					xR = Math.floor(Math.random()*10);
					yR = Math.floor(Math.random()*10);
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
				overlapNum = new Array();

				while(fiendeFel && !overlap) {
					
				overlap = 0;

					Dir = Math.floor(Math.random()*4);
					while(overlap > 0){
						overlap = 0;
						for (var i = xR; i < xLast ; i++) {
							if (fiendeSkepp.includes(i+"."+yR)) {
								console.log("overlap1: " + (i+"."+yR) );
								document.getElementById(i+"."+yLast).innerHTML = '<img src="Kryss.png" class="kryss" />';	

								overlap++;
							}
						}
						Dir = Math.floor(Math.random()*4);
					}

					switch(Dir){
						case 0: 
							xLast = xR + fiendeLength;
							yLast = yR;
							break;
						case 1: 
							xLast = xR - fiendeLength;
							yLast = yR;
							for (var i = xR; i < xLast ; i++) {
								if (fiendeSkepp.includes(i+"."+xR)) {
								console.log("overlap2");
								document.getElementById(i+"."+yLast).style.backgroundColor = "red";
								}
							}
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

					if (xLast > -1 && xLast < 11 && yLast > -1 && yLast < 11) {
						fiendeFel = false;
					}



				}
				console.log(Dir);

				//console.log(xR +" | "+ yR);
				//console.log("X: " + xLast + " | Y: " + yLast);

				if (xR != xLast) {
					if (xR < xLast) {
						for (var i = xR; i < xLast ; i++) {
							document.getElementById(i+"."+yLast).style.backgroundColor = "#333333";
							fiendeSkepp.push(i+"."+yLast);
						}

					} else {
						for (var i = xLast; i < xR ; i++) {
							document.getElementById(i+"."+yLast).style.backgroundColor = "#333333";
							fiendeSkepp.push(i+"."+yLast);
						}
					}
					
				} else {
					if (yR < yLast) {
						for (var i = yR; i < yLast ; i++) {
							document.getElementById(xLast+"."+i).style.backgroundColor = "#333333";
							fiendeSkepp.push(xLast+"."+i);
						}

					} else {
						for (var i = yLast; i < yR ; i++) {
							document.getElementById(xLast+"."+i).style.backgroundColor = "#333333";
							fiendeSkepp.push(xLast+"."+i);
						}
					}
				}

			}


		}

		function egnaSkeppPaint() {
			for (var i = 0; i < egnaSkepp.length; i++) {
					document.getElementById(egnaSkepp[i]).style.backgroundColor = "#333333";
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
					//console.log("test: "+overLap1(x,y));

					if (x == (firstX+skeppLength-1) && y == firstY ) {
						shipBP = [];
						for (var i = firstX+1; i < (firstX+skeppLength); i++) {
							document.getElementById(i+"-"+firstY).style.backgroundColor = "#555555";
							shipBP.push(i+"-"+firstY);
						}	
						document.getElementById((firstX+skeppLength-1)+"-"+firstY).style.backgroundColor = "#333333";

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
							document.getElementById(i+"-"+firstY).style.backgroundColor = "#555555";	
							shipBP.push(i+"-"+firstY);

						}
						document.getElementById((firstX-skeppLength+1)+"-"+firstY).style.backgroundColor = "#333333";

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
							document.getElementById(firstX+"-"+i).style.backgroundColor = "#555555";	
							shipBP.push(firstX+"-"+i);
						}
						document.getElementById(firstX+"-"+(firstY+skeppLength-1)).style.backgroundColor = "#333333";

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
							
							document.getElementById(firstX+"-"+i).style.backgroundColor = "#555555";
							shipBP.push(firstX+"-"+i);	
						}
						document.getElementById(firstX+"-"+(firstY-skeppLength+1)).style.backgroundColor = "#333333";

						//tar bort det visade skeppet från de andra lägerna
						remove1();
						remove2();
						remove3();
					}			
				}
			}
				
		}

		function placeraMus(x, y) {
			if (!start) {

				if (antalKlick == 2) {
					document.getElementById(x+"-"+y).style.backgroundColor = "#333333";
				} 


				if (antalKlick == 1) {
					for (var i = 0; i < allowedPlace.length; i++) {
					
						
					}
					
				possiblePlace(x,y);
					
				//console.log("Mus: "+x+"-"+y);
					

				}

				
			}
		} 

		function placeraMusRemove(x, y) {
		
			var fel = 0;
			for (var i = 0; i < egnaSkepp.length; i++) {
				if ((x+"-"+y) == egnaSkepp[i]) {
					fel = 1;
					//console.log("fel: 1");	
				}	
			}


			for (var i = 0; i < allowedPlace.length; i++) {
				if ((x+"-"+y) == allowedPlace[i]) {
					fel = 1;
					//console.log("fel: 2");
				}
			}
			for (var i = 0; i < shipBP.length; i++) {
				if ((x+"-"+y) == shipBP[i]) {
					fel = 1;
					//console.log("fel: 3");
				}
			}

			

			if (fel == 0) {
				
				document.getElementById(x+"-"+y).style.backgroundColor = "";
			} 
			
			possiblePlace(x,y);
		} 

		function showStats() {
			
			
			//sparar menyns ursprungliga utseende
			if (stats == 1) {
				orig = document.getElementById("meny").innerHTML;

				var request = new XMLHttpRequest();
				request.open('GET', 'SpelAjax.php?text='+"stats", true);
				request.onload = () => {

					data = request.responseText;
				};
					request.send();
			}

			//visar eller gömmer statisiktabben
			if (stats == 1 || stats == 2) {
				let text = document.getElementById("meny").innerHTML;
				text += `<div id="stats" class="unselectable">${data}</div>`;
				stats = 3;
				document.getElementById("meny").innerHTML = text;
			} else {
				stats = 2;
				document.getElementById("meny").innerHTML = orig;
			}	
		}

		function place(id) {
			if (antalKlick == 0) {
				

				if (!start) {
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

					document.getElementById("temp").style.visibility = "hidden";


					let skeppID = `skepp${id}`;

					var element = document.getElementById(skeppID);
	   				element.parentNode.removeChild(element);
				}
			}				
		}

		function buggFix() {
			showStats();
			showStats();
		}
	</script>
</head>
<body id="body">
<link rel="stylesheet" type="text/css" href="SpelStil.css">
	<div id="spelplan">
		<div id="egen" class="spel"></div>
		<div id="meny">
			<div class="knapp unselectable" onclick="startSpel()">Starta spel</div>
			<div class="knapp unselectable" onclick="window.location.href = 'login.php?'">Till menyn</div>
			<div class="knapp unselectable" onclick="showStats()">Statistik</div>
		</div>
		<div id="fiende" class="spel"></div>

		<div id="egnaSkepp" class="skeppPlan">
			<div id="skepp1" class="skepp" onclick="place(1)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>

			<div id="skepp2" class="skepp" onclick="place(2)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
			
			<div id="skepp3" class="skepp" onclick="place(3)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>

			<div id="skepp4" class="skepp" onclick="place(4)">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>

			<div id="skepp5" class="skepp" onclick="place(5)">
				<div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
		</div>
		<div id="fiendeSkepp" class="skeppPlan">
			<div id="skepp6" class="skepp">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
			<div id="skepp7" class="skepp">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
			<div id="skepp8" class="skepp">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
			<div id="skepp9" class="skepp">
				<div class="templSkepp1"></div><div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
			<div id="skepp10" class="skepp">
				<div class="templSkepp1"></div><div class="templSkepp2"></div>
			</div>
		</div>
	</div>

	<div id="temp"></div>
</body>
</html>