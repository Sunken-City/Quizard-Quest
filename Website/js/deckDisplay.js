/* This is the Javascript for displaying the decks a user has created along with the cards*/
var JSON;

$.post("../API_Server/DeckReview.php", function(data){
	JSON = $.parseJSON(data);
	for( var i = 0, len = JSON.length;  i < len; i++){
		var listData = document.createElement("li");
		var Deck = document.createElement("p");
		
		Deck.innerHTML = JSON[i].name;
		listData.appendChild(Deck);
		document.getElementById('Decks').appendChild(listData);
	}
		
});
