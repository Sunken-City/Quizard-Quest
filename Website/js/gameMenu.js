/* This is the Javascript for gameMenu.js */

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
