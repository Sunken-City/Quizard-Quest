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

	$.post("../../API_Server/requestDeck.php",sendData,function(returnData) {

		data = returnData;

	},"json");

	/*\
	|*|		:: >> Initialize the New Deck << ::
	\*/

	for (var i = 0, len = data.length; i < len; i++) {
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