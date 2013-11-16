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

	for (var i = 0, len = data.length; i < len; i++) {
		var newCard = new Card();
		newCard.question = data[i]['question'];
		newCard.answer = data[i]['answer'];
		newCard.category = data[i]['category'];

		deck.cards.push(newCard);
	}

	return deck;
}


