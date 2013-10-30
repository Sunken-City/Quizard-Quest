/* This is the Javascript for creating the deck and loading all the user cards
to the window */
var JSON;

$.post("../API_Server/getCards.php", function(data){
	JSON = $.parseJSON(data);
	for( var i = 0, len = JSON.length;  i < len; i++){
		console.log(i);
		var tableData = document.createElement("td");
		var question = document.createElement("p");
		question.innerHTML = JSON[i].question
		tableData.appendChild(question);
		document.getElementById('UserCards').appendChild(tableData);
	}
		
});
	


$(document).ready(function(){

	$("#createDeck").click(function(e){
	alert(JSON[0]);
	e.preventDefault();
	/* Get all the TD that are checked
	Submit them to a PHP function in an array
	PHP function makes the Deck
	*/

	/*Also needs a way to import all question from the Database */
		
	});

});
window.addEventListener('load', function() {
	console.log("window loaded");
}, false);

