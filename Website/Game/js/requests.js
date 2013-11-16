var deck = new Deck();

$(document).ready(function() {
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

	/*\
	|*|		:: >> Deck Object << ::
	\*/

	function Deck() {
		var cards = array();
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

	var data;

	$.post("../../API_Server/requestDeck.php",sendData,function(returnData) {

		data = returnData;

	},"json");

	/*\
	|*|		:: >> Initialize the New Deck << ::
	\*/

	for (int i = 0, len = data.length; i < len; i++) {
		var newCard = new Card();
		newCard.question = data['question'];
		alert('question' + newCard.question);
		newCard.answer = data['answer'];
		newCard.difficulty = data['difficulty'];
		newCard.category = data['category'];

		deck.cards.push(newCard);
	}

});	

function returnDeck () {
		return deck;
}