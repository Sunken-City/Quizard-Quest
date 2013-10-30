$(document).ready(function(){

	$("#createDeck").click(function(e){

	e.preventDefault();
	var JSON;

	$.getJSON("../API_Server/getCards.php", function(data){
		
		JSON = JSON.parse(data);
		console.log(data);
		
		window.location.href = "DeckCreate.php";
		});
	alert('button Pressed');
	
	/* Get all the TD that are checked
	Submit them to a PHP function in an array
	PHP function makes the Deck
	*/

	/*Also needs a way to import all question from the Database */

		
	});

});
