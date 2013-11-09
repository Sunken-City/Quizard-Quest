/*\
|*|		Javascript for the mainMenu.php
\*/


$(document).ready(function() {

	/*\
	|*|		:: >> Link to Create a Card << ::
	|*|
	|*|		# add a click listener to the create card button
	|*|		# redirects to cardCreation.php
	|*|
	\*/

	$("#createCard").click(function(e) {
		window.location.href = "cardCreation.php";
	})

	/*\
	|*|		:: >> Link to Create a Deck << ::
	|*|
	|*|		# add a click listener to the create deck button
	|*|		# redirects to DeckCreate.php
	|*|
	\*/

	$("#createDeck").click(function(e) {
		window.location.href = "DeckCreate.php";
	});

	/*\
	|*|		:: >> Link to Edit Decks << ::
	|*|
	|*|		# add a click listener to the edit decks button
	|*|		# redirects to DeckDisplay.php
	|*|
	\*/

	$("#reviewDecks").click(function(e) {
		window.location.href = "DeckDisplay.php";
	});

	/*\
	|*|		:: >> This function will pull all the deck names and display them for the user << ::
	|*|
	|*|
	\*/

	/*\
	|*|		:: >> This function will display all the cards in the selected deck << ::
	|*|
	|*|
	\*/

});