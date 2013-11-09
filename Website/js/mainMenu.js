/*\
|*|		Javascript for the mainMenu.php
\*/


$(document).ready(function() {

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the create card button
	|*|		# redirects to cardCreation.php
	|*|
	\*/

	$("#createCard").click(function(e) {
		window.location.href = "cardCreation.php";
	})

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the create deck button
	|*|		# redirects to DeckCreate.php
	|*|
	\*/

	$("#createDeck").click(function(e) {
		window.location.href = "DeckCreate.php";
	});

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the edit decks button
	|*|		# redirects to DeckDisplay.php
	|*|
	\*/

	$("#reviewDecks").click(function(e) {
		window.location.href = "DeckDisplay.php";
	});

});