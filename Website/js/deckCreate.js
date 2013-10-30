




var JSON;

$.post("../API_Server/getCards.php", function(data){
		
	JSON = $.parseJSON(data);
});

function FlashCard(){
	var question;
	var answer;
	var cardID;
	var subCategory;
}

for( var i = 0, len = JSON.length;  i < len; i++){
	var tableData = document.createElement("td");
	var question = document.createElement("p");
	question.innerHTML = JSON[i].question
	tableData.appendChild(question);
	body.getElementById('UserCards').appendChild(tableData);
}

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
