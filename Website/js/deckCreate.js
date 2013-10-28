$(document).ready(function(){

	$("#createDeck").click(function(e){\

	var JSON;
	$.post("../API_Server/DeckCreation.php",formData,function(data){
		JSON = data;
		},"json");
	alert(JSON['question']);
	
	/* Get all the TD that are checked
	Submit them to a PHP function in an array
	PHP function makes the Deck
	*/

	/*Also needs a way to import all question from the Database */

		
	});

});
