/*\
|*|		Javascript for the all html pages
\*/

$(document).ready(function() {

	var newHeight = $(".navbar").height() * 2;

	$("header.nonIndex").css({
		'height':newHeight + 'px',
		'vertical-align':'middle',
	});

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the log out button
	|*|		# make an ajax request that sends the form data to 
	|*|			logOut.php to end the current session
	|*|		# redirects to the log in page (index.html)
	|*|
	\*/


	$("#logOut").click(function(e) {

		$.ajax({
			url: "../API_Server/logOut.php",
			success: function () {
				$.post("../API_Server/ajaxurl.php",function (url) {
					window.location.href = "http://" + url + "/Quizard-Quest/Website/";
				},"json");
				//http://54.200.66.93/Quizard-Quest/Website/
			}
		});

	});

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the home button
	|*|		# redirect to mainMenu.html
	|*|
	\*/

	$("#home").click(function(e) {

		window.location.href = "mainMenu.php";

	});

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

});
