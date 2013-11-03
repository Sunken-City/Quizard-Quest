/* This is the Javascript for displaying the decks a user has created along with the cards*/
var JSON;

$.post("../API_Server/DeckReview.php", function(data){
	JSON = $.parseJSON(data);
	for( var i = 0, len = JSON.length;  i < len; i++){
		var Deck = document.createElement("option");
		Deck.value = JSON[i].name;
		Deck.innerHTML = JSON[i].name;
		document.getElementById('Decks').appendChild(Deck);
	}		
});

$(document).ready(function(){

	$("#deckToEdit").click(function(e){

	$.post("../API_Server/getCards.php", function(data){
	JSON = $.parseJSON(data);
	for( var i = 0, len = JSON.length;  i < len; i++){
		console.log(i);
		var tableData = document.createElement("td");
		var question = document.createElement("p");
		var checkBox = document.createElement("input");
		checkBox.value = JSON[i].cardID;
		checkBox.type = "checkbox";
		checkBox.name = "flashCard[]";
		question.innerHTML = "Question: " + JSON[i].question + " \nAnswer: " + JSON[i].answer;
		tableData.appendChild(checkBox);
		tableData.appendChild(question);
		document.getElementById('deckCards').appendChild(tableData);
	}
		
});

	/*Also needs a way to import all question from the Database */
		
	});

});
