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

		$.post("../API_Server/questSetup.php",sendData, function() {
			window.location.href = "index.php";
		});

	});

});
