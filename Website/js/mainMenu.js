//Author: Nathan Moore
//Scripts to run in concert with mainMenu.html


$(document).ready(function() {

	$("#createCard").click(function(e) {
		window.location.href = "cardCreation.html";
	})

	$("#createDeck").click(function(e) {
		window.location.href = "DeckCreate.html";
	});

});