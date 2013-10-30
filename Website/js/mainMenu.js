/*\
|*|		Javascript for the all mainMenu.html
\*/


$(document).ready(function() {

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the create card button
	|*|		# redirects to cardCreation.html
	|*|
	\*/

	$("#createCard").click(function(e) {
		window.location.href = "cardCreation.php";
	})

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the create deck button
	|*|		# redirects to DeckCreate.html
	|*|
	\*/

	$("#createDeck").click(function(e) {
		window.location.href = "DeckCreate.php";
	});

});