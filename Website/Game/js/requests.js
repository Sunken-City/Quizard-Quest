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

var deck1 = new rDeck();
var cardArray = [];
var data;

$(document).ready(function () {
	/*\
	|*|		:: >> Request Deck Data << ::
	\*/

	var sendData = {tokenDta:'lalala'};

	$.post("../../API_Server/requestDeck.php",sendData,function(returnData) {

		data = $.parseJSON(returnData);

	});

	returnDeck();
});

/*\
|*|		:: >> Deck Object << ::
\*/

function rDeck() {
	var cards;
}

/*\
|*|		:: >> Card Object << ::
\*/

function rCard() {
	var category;
	var question;
	var answer;
}

function returnDeck() {

	/*\
	|*|		:: >> Initialize the New Deck << ::
	\*/

	for (var i = 0, len = data.length; i < len; i++) {
		var newCard = new rCard();
		newCard.question = data[i]['question'];
		newCard.answer = data[i]['answer'];
		newCard.category = data[i]['category'];

		cardArray.push(newCard);
	}

	deck1.cards = cardArray;
}


