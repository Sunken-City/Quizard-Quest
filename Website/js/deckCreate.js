/* This is the Javascript for creating the deck and loading all the user cards
to the window */
var JSON;

$.post("../API_Server/getCards.php", function(data){
	JSON = $.parseJSON(data);
	// for( var i = 0, len = JSON.length;  i < len; i++){
	// 	console.log(i);
	// 	var tableData = document.createElement("td");
	// 	var question = document.createElement("p");
	// 	var checkBox = document.createElement("input");
	// 	checkBox.value = JSON[i].cardID;
	// 	checkBox.type = "checkbox";
	// 	checkBox.name = "flashCard[]";
	// 	question.innerHTML = "Question: " + JSON[i].question + " \nAnswer: " + JSON[i].answer;
	// 	tableData.appendChild(checkBox);
	// 	tableData.appendChild(question);
	// 	document.getElementById('UserCards').appendChild(tableData);
	// }

	for (var i = 0, len = JSON.length; i < len; i++) {

		var td = document.createElement("td");
		var card = document.createElement("div");
		var cardTitles = document.createElement("div");
		var cardDifficulty = document.createElement("div");
		var cardCategory = document.createElement("div");
		var cardSubcategory = document.createElement("div");
		var cardQuestion = document.createElement("div");
		var cardAnswer = document.createElement("div");
		var checkBox = document.createElement("input");

		checkBox.value = JSON[i].cardID;
		checkBox.type = "checkbox";
		checkBox.name = "flashCard[]";

		card.className = "card";
		cardQuestion.className = "cardQuestion";
		cardAnswer.className = "cardAnswer";
		cardDifficulty.className = "cardDifficulty";
		cardCategory.className = "cat cardCategory";
		cardSubcategory.className = "cat subCat cardSubcategory";
		cardTitles.className = "cardTitles";
		difficultyValue = JSON[i].difficulty;
		categoryValue = JSON[i].category;

		switch(categoryValue)
		{
			case "1":
				categoryName="Math";
				break;
			case "2":
				categoryName="Science";
				break;
			case "3":
				categoryName="History";
				break;
			case "4":
				categoryName="English";
				break;
			case "5":
				categoryName="Foreign Languages";
				break;

		}

		switch(difficultyValue)
		{
			case "1":
				difficultyName="Easy";
				break;
			case "2":
				difficultyName="Normal";
				break;
			case "3":
				difficultyName="Hard";
				break;
			case "4":
				difficultyName="Nigh-Impossible";
				break;
		}

		cardQuestion.innerHTML = "Q: " + JSON[i].question;
		cardAnswer.innerHTML = "A: " + JSON[i].answer;
		cardDifficulty.innerHTML = difficultyValue;
		cardCategory.innerHTML = categoryValue + ": ";
		cardSubcategory.innerHTML = JSON[i].subCategory;

		cardTitles.appendChild(cardDifficulty);
		cardTitles.appendChild(cardCategory);
		cardTitles.appendChild(cardSubcategory);
		card.appendChild(cardTitles);
		card.appendChild(cardQuestion);
		card.appendChild(cardAnswer);
		td.appendChild(checkBox);
		td.appendChild(card);
		document.getElementById('UserCards').appendChild(td);
	}
		$(".card").slideDown();

	/** Format to output for cards **
	<div class="card">
		<div class="cardTitles">
			<div class="cardDifficulty"></div>
			<div class="cat cardCategory"></div>
			<div class="cat subCat cardSubcategory"></div>
		</div>
		<div class="cardQuestion"></div>
		<div class="cardAnswer"></div>
	</div>

		question varchar(512) NOT NULL,
	    answer varchar(64) NOT NULL,
	    category int NOT NULL,
	    subCategory varchar(32),
	    difficulty int NOT NULL,
	    rating int default 0,
	**/
		
});
	


$(document).ready(function(){

	$("#createDeck").click(function(e){
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

