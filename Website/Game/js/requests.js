/*\
|*|		:: >> Retrieve Deck Data << ::
|*|
|*|		# Get DeckID through session variable
|*|		# Get Card data
|*|			-> card difficulty
|*|			-> card answer
|*|			-> card question
|*|			-> card category
|*|		# Put deck cards into array
|*|
\*/

function returnDeck () {

	/*\
	|*|		:: >> Deck Object << ::
	\*/

	function Deck() {
		var cards = [];
	}

	/*\
	|*|		:: >> Card Object << ::
	\*/

	function Card() {
		var category;
		var difficulty;
		var question;
		var answer;
	}

	/*\
	|*|		:: >> Request Deck Data << ::
	\*/

	var deck = new Deck();
	var data;
	var sendData = {tokenDta:'lalala'};

	$.post("../../API_Server/requestDeck.php",sendData,function(returnData) {

		data = $.parseJSON(returnData);

	});

	/*\
	|*|		:: >> Initialize the New Deck << ::
	\*/

	for (something in data) {
		var newCard = new Car();
		newCard.question = data['question'];
		alert('question' + newCard.question);
		newCard.answer = data['answer'];
		newCard.difficulty = data['difficulty'];
		newCard.category = data['category'];

		deck.cards.push(newCard);
	}

	return deck;
}

$(document).ready(function() {

	var data;
	var sendData = {tokenDta:'lalala'};

	$.post("../../API_Server/requestDeck.php",sendData,function(returnData) {

		data = $.parseJSON(returnData);

	});
	
});