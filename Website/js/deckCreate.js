$(document).ready(function(){

	$("#createDeck").click(function(e){

	var JSON;

	$.getJSON("../API_Server/getCards.php",function(data){
		/*JSON = JSON.parse(data);
		alert(JSON.question);*/
		
		window.location.href = "DeckCreate.php";
		});
	alert('button Pressed');
	e.preventDefault();
	/* Get all the TD that are checked
	Submit them to a PHP function in an array
	PHP function makes the Deck
	*/

	/*Also needs a way to import all question from the Database */

		
	});

});
