




var JSON;

$.post("../API_Server/getCards.php", function(data){
		
	JSON = $.parseJSON(data);
});

alert(JSON[0]);

$(document).ready(function(){

	$("#createDeck").click(function(e){
	
	e.preventDefault();
	/* Get all the TD that are checked
	Submit them to a PHP function in an array
	PHP function makes the Deck
	*/

	/*Also needs a way to import all question from the Database */
		
	});

});
