
  $(document).ready(function() {

    //Ajax request för att hämta relevant information från databasen
		var request = new XMLHttpRequest();
		request.open('GET', 'StatistikAjax.php?', true);
		request.onload = function() {

			var data = request.responseText;

			var parseData = JSON.parse(data);

			//Objekt med all importerad information
			var statistics = {
				name: parseData[0],
				xp: parseData[1],
				winsEasy: parseInt(parseData[2]),
				winsMedium: parseInt(parseData[3]),
				winsHard: parseInt(parseData[4]),
				lossesEasy: parseInt(parseData[5]),
				lossesMedium: parseInt(parseData[6]),
				lossesHard: parseInt(parseData[7]),
				shots: parseInt(parseData[8]),
				hits: parseInt(parseData[9]),
				time: parseInt(parseData[10])
			};

			//Metod för att ta fram spelarens level, gör nästa level progressivt mer svårnådd.
			var level = 1;
			while ((statistics.xp/((level*100) * Math.pow(1.2 , level-1))) >= 1) {
				level++;
			}


			//Progressbar med xp som visar hur nära man är på att levla upp till nästa level
			var elem = document.getElementById("xpBar");
		  var width = 100*(statistics.xp/((level*100) * Math.pow(1.2 , level-1)));

		  elem.style.width = width + '%';
		  elem.innerHTML = statistics.xp+"xp";

			$("#level").html(level-1);

			//Gör sidan mer personlig genom att visa spelarens namn
			$("#header").html(statistics.name + "'s statistik");

			//Tar fram det totala antalet vinster
			var wTot = (statistics.winsEasy+statistics.winsMedium+statistics.winsHard);

			//Visar antalet vinster
			$("#wTot").html("Total wins: " + wTot);


			//Tar fram procenten för varje typ av vinst
			var percentEasy = statistics.winsEasy/wTot;

			var percentMedium = statistics.winsMedium/wTot;

			var percentHard = statistics.winsHard/wTot;


			//Sätter in antalet vinster i respektive progressbar
			$("#wEasyBar").html(statistics.winsEasy);

			$("#wMediumBar").html(statistics.winsMedium);

			$("#wHardBar").html(statistics.winsHard);


			//Ändrar progressbarens storlek baserat på procentuella andelen vinster av den här typen
			var elem = document.getElementById("wEasyBar");
		  var width = 100*percentEasy;

		  elem.style.width = width + '%';
		  elem.innerHTML = statistics.winsEasy;


			//Ändrar progressbarens storlek baserat på procentuella andelen vinster av den här typen
			var elem = document.getElementById("wMediumBar");
		 	var width = 100*percentMedium;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.winsMedium;


			//Ändrar progressbarens storlek baserat på procentuella andelen vinster av den här typen
			var elem = document.getElementById("wHardBar");
		 	var width = 100*percentHard;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.winsHard;


			//Tar fram det totala antalet förluster
			var lTot = (statistics.lossesEasy+statistics.lossesMedium+statistics.lossesHard);

			//Visar antalet förluster
			$("#lTot").html("Total losses: " + lTot);

			//Tar fram procenten för varje typ av förlust
			var percentEasy = statistics.lossesEasy/lTot;

			var percentMedium = statistics.lossesMedium/lTot;

			var percentHard = statistics.lossesHard/lTot;


			//Sätter in antalet förluster i respektive progressbar
			$("#lEasyBar").html(statistics.lossesEasy);

			$("#lMediumBar").html(statistics.lossesMedium);

			$("#lHardBar").html(statistics.lossesHard);

			//Ändrar progressbarens storlek baserat på procentuella andelen förluster av den här typen
			var elem = document.getElementById("lEasyBar");
		  var width = 100*percentEasy;

		  elem.style.width = width + '%';
		  elem.innerHTML = statistics.lossesEasy;

			//Ändrar progressbarens storlek baserat på procentuella andelen förluster av den här typen
			var elem = document.getElementById("lMediumBar");
		 	var width = 100*percentMedium;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.lossesMedium;

			//Ändrar progressbarens storlek baserat på procentuella andelen förluster av den här typen
			var elem = document.getElementById("lHardBar");
		 	var width = 100*percentHard;

			elem.style.width = width + '%';
			elem.innerHTML = statistics.lossesHard;

			var hitRatio = statistics.hits/statistics.shots;
			hitRatio = hitRatio.toFixed(3);

			var timeRatio = statistics.shots/statistics.time;
			timeRatio = timeRatio.toFixed(3);

      //Lägger till diverse text-baserad statistik
			$("#shots").html("Total shots: " + statistics.shots);

			$("#hits").html("Total hits: " + statistics.hits);

			$("#hitRatio").html("Hit-ratio: " + hitRatio);

			$("#timeRatio").html("Shots/second: " + timeRatio);

		};
		request.send();

  });
