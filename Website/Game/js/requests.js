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

var deck1 = new Deck();
var cardArray = [];
var data;
var md;
var questMode = 0;

//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/array/shuffle [v1.0]
function shuffle(o) {
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};

/*\
|*|		:: >> Request Deck Data << ::
\*/

var sendData = {mode:'false'};

$.post("../../API_Server/requestDeck.php",sendData,function(returnData) {

	data = $.parseJSON(returnData);

  sendData = {mode:'true'};

  $.post("../../API_Server/requestDeck.php",sendData,function(returnData) {
    data = $.parseJSON(returnData);
    md = data['mode'];
    
  });

});

initMode(md);
initDeck();

/*\
|*|		:: >> Deck Object << ::
\*/

function Deck() {
  var cards;
  
  this.add = function(card) {
  this.cards.push(card); 
  }
  
  this.draw = function() {
    return this.cards.pop();
  }
  
  this.shuffle = function() {
    this.cards = shuffle(this.cards);
  }
}

/*\
|*|		:: >> Card Object << ::
\*/

function Card() {
  var category;
  var question;
  var answer;
  var difficulty;
}

function initDeck() {

	/*\
	|*|		:: >> Initialize the New Deck << ::
	\*/

	for (var i = 0, len = data.length; i < len; i++) {
		var newCard = new Card();
		newCard.question = data[i]['question'];
		newCard.answer = data[i]['answer'];
		newCard.category = data[i]['category'];
		newCard.difficulty = data[i]['difficulty'];

		cardArray.push(newCard);
	}

	deck1.cards = cardArray;
}

/*\
|*|   :: >> Fetch the Game Mode << ::
\*/

function initMode(mod) {
  questMode = mod;
}

