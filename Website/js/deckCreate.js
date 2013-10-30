$(document).ready(function(){

	$("#createDeck").click(function(e){

	var JSON;

	$.getJSON("../API_Server/DeckCreation.php",function(data){
		JSON = JSON.parse(data);
		alert(pJSON.question);
		alert('button Pressed)';
		window.location.href = "DeckCreate.php";
		});
	e.preventDefault();
	/* Get all the TD that are checked
	Submit them to a PHP function in an array
	PHP function makes the Deck
	*/

	/*Also needs a way to import all question from the Database */

		
	});

});
