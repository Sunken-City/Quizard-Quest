/* This is the Javascript for gameMenu.js */

$(document).ready(function() {

	var JSON;

	/*\
	|*|		:: >> Display the Names of the User's decks << ::
	\*/

	$.post("../API_Server/DeckReview.php", function(data){
		JSON = $.parseJSON(data);
		for( var i = 0, len = JSON.length;  i < len; i++){
			var Deck = document.createElement("option");
			Deck.value = JSON[i].deckID;
			Deck.innerHTML = JSON[i].name;
			document.getElementById('deckSelect').appendChild(Deck);
		}		
	});

	/*\
	|*|		:: >> Get gold << ::
	\*/

	var gold;
	var goldDisplay;

	var sendData = {'life':'and death'};

	$.post("../API_Server/supplyShopSetup.php",sendData,function(data) {
		gold = data['gold'];
		goldDisplay = gold + " gold";
	},"json");

	/*\
	|*|		:: >>Click listener for begin quest button<< ::
	|*|
	|*|		#	set session variable
	|*|		#	redirects to the game index
	|*|
	\*/

	$("#begin").click(function (e) {

		var deck = $("#deckSelect").val();
		var mode = $("#modeSelect").val();

		var sendData = {deckSelect:deck, modeSelect:mode};

		if (deck != -1 && mode != -1) { //if a deck is selected and game mode selected

			if (mode == 1 && gold < 300) {

				alert("You need 300 gold! You only have " + goldDisplay + ". You must train to earn more gold!");

			} else if (mode == 2 && gold < 500) {

				alert("You need 500 gold! You only have " + goldDisplay + ". You must train or go on a quest to earn more gold!");

			} else if (mode == 0) {

				$.post("../API_Server/questSetup.php",sendData, function() {
					window.location.href = "Game/index.php";
				});

			} else if (mode == 1 && gold > 299) {

				$.post("../API_Server/questSetup.php",sendData, function() {
					window.location.href = "Game/index.php";
				});

			} else if (mode == 2 && gold > 499) {

				$.post("../API_Server/questSetup.php",sendData, function() {
					window.location.href = "Game/index.php";
				});

			}
			

		} else if (deck == -1 && mode != -1) {

			alert("You have to select a Spellbook! If you do not have one you should return to Home and from there you can create a Spellbook!");

		} else if (mode == -1 && deck != -1) {

			alert("You have to select a Challenge");

		} else {

			alert("You have to select a Spellbook and Challenge!");
		}
		

	});

});
