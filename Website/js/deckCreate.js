$(document).ready(function(){

	$("#createDeck").click(function(e){

	var JSON;
	$.post("../API_Server/DeckCreation.php",function(data){
		JSON = data;
		alert(JSON['question']);
		window.location.href = "DeckCreate.html";
		},"json");
	e.preventDefault();
	/* Get all the TD that are checked
	Submit them to a PHP function in an array
	PHP function makes the Deck
	*/

	/*Also needs a way to import all question from the Database */

		
	});

});
