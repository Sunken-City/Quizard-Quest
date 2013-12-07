/* This is the Javascript for creating the deck and loading all the user cards to the window */
//Gus did this...mostly
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

	/*\
	|*|
	|*|							:: >>Add a card preview for all cards the user has created<< ::
	|*|
	|*|		#	Get all cards from the database
	|*|		#	Create the necessary html elements to store the card data
	|*|		#	Give each element the proper class so that they will be uniformly styled
	|*|		#	Append each card to a table data element
	|*|		#	Append each table data element to the user's card table
	|*|
	\*/

	for (var i = 0, len = JSON.length; i < len; i++) {

		var td = document.createElement("div"); //holds a card for the table display
		var card = document.createElement("div"); //holds the card data
		var cardTitles = document.createElement("div"); //holds the category, subcategory, and difficulty for the card
		var cardDifficulty = document.createElement("div"); //holds the card's difficulty
		var cardCategory = document.createElement("div"); //holds the card's category
		var cardSubcategory = document.createElement("div"); //holds the card's subcategory
		var cardQuestion = document.createElement("div"); //holds the card's question
		var cardAnswer = document.createElement("div"); //holds the card's answer
		var checkBox = document.createElement("input"); //the checkbox that allows the user to select the card to be put into the new deck

		//#############################
		//#	Create the check box	#
		//#############################
		checkBox.value = JSON[i].cardID; //get the cardID from the db
		checkBox.type = "checkbox";
		checkBox.name = "flashCard[]";

		//#########################################################################
		//#	Set the appropriate html element classes for css styling purposes	#
		//#########################################################################
		td.className = "deckCreateDiv deckCreate";
		card.className = "card deckCreate";
		cardQuestion.className = "cardQuestion deckCreate";
		cardAnswer.className = "cardAnswer deckCreate";
		cardDifficulty.className = "cardDifficulty deckCreate";
		cardCategory.className = "cat cardCategory deckCreate";
		cardSubcategory.className = "cat subCat cardSubcategory deckCreate";
		cardTitles.className = "cardTitles deckCreate";
		var difficultyValue = JSON[i].difficulty;
		var categoryValue = JSON[i].category;
		var categoryName;
		var difficultyName;

		/*
		 *	The category and difficulty are stored as integers in the database
		 *	So these switches translate the integer into the matching text string
		 */
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
		   case "6":
		      categoryName="Misc";
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

		//#############################################################################################
		//#	Put all the data into the correct elements then put those elements into the card table	#
		//#############################################################################################
		cardQuestion.innerHTML = "Q: " + JSON[i].question;
		cardAnswer.innerHTML = "A: " + JSON[i].answer;
		cardDifficulty.innerHTML = difficultyName;
		cardCategory.innerHTML = categoryName + ": ";
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
		//#######################
		//#	Display the card	#
		//#######################
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

	// //add a click  listener to each card so that when they are clicked they are selected
	// $("div.deckCreateDiv.deckCreate").click(function(e) {

	// 	//get the checkbox and toggle the check

	// 	var check = $(e).children("input")[0];

	// 	if ($(check).prop("checked")) {

	// 		$(check).prop("checked",false);

	// 	} else {

	// 		$(check).prop("checked",true);

	// 	}

	// });

	var deckNames;

	$.post("../API_Server/DeckReview.php", function(data){

		deckNames = $.parseJSON(data);
		
	});

	/*\
	|*|
	|*|							:: >>Prevent Duplication of Deck Names<< ::
	|*|
	|*|		#	This function gets all the names of the users decks
	|*|		#	And compares the name entered by the user for the new deck to those that already exist
	|*|		#	If the entered name matches: An alert is given and the form submission cancelled
	|*|
	\*/

	$("#createDeck").click(function(e){

		var inputName = $("#nameDeck").val();
	
		for (var i = 0, len = deckNames.length; i < len; i++) {

			if (inputName === deckNames[i].name) {
				e.preventDefault();
				alert("That deckname has already been used: Please use another!");
				break;
			}

		}
		
	});

});

window.addEventListener('load', function() {
	console.log("window loaded");
}, false);

/*
$(document).ready(function(){

	$("#createDeck").click(function(e){

		var Deckname = $("#nameDeck").val();
		var checkNameFirst = true;

		var formData = {'Deckname':Deckname, 'checkNameFirst':checkNameFirst};
	
		$.post("../API_Server/DeckCreation.php",formData,function(data){
			if (data['success']) {
				// do successful things
				checkNameFirst = false;
				formData = {'checkNameFirst':checkNameFirst};

				$.post("../API_Server/DeckCreation.php",formData,function() {
					window.location.href = "mainMenu.php";
				});

            	
			} else {
				e.preventDefault();
				alert('That deck name is already taken! Please choose another.');
			}
		},"json");
		
	});
*/
