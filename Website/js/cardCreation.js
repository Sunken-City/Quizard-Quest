/*\
|*|		Javascript for the cardCreation.html
\*/

$(document).ready(function(){

	/*\
	|*|			:: >> Submit a New Card to the Database << ::
	|*|
	|*|		# add a click listener to the submit button associated 
	|*|			with card creation
	|*|		# make an ajax request that sends the form data to 
	|*|			CardCreation.php for validation
	|*|
	\*/
	var selected = false;

	$("#submitQuestion").click(function(e){

		var category = document.getElementById('categorySelect').value;
		var subcategory = document.getElementById('newSubcategory').value;
		var question = document.getElementById('newQuestion').value;
		var answer = document.getElementById('newAnswer').value;
		var difficulty = document.getElementById('newDifficulty').value;

		//var answer = prepareAnswer(answer);
		//Hoping that this will work now. Let's Test This Out.
		subcategory = subcategory.trim();
		question = question.trim();
		answer = answer.trim();
		var formData = {category:category,subcategory:subcategory,question:question, answer:answer, difficulty:difficulty};

		if(category == 0){
		 	alert("Please Select a Category");
		} else if(subcategory == 0){
		 	alert("Please Select a Difficulty");
		} else if (question == 0) {
			alert("Please Enter a Question");
		} else if (answer == 0) {
			alert("Please Enter an Answer");
		} else {			
			$.post("../API_Server/CardCreation.php",formData,function(){
				alert("Question Added");
				window.location.href = "cardCreation.php";
			});
		}		

		e.preventDefault();
	});

	$("#closePreview").click(function(e) {
		selected = false;
		$('#card').slideUp();
	});

	$("#previewCard").click(function(e){
		var category = document.getElementById('categorySelect');
		var subcategory = document.getElementById('newSubcategory');
		var question = document.getElementById('newQuestion');
		var answer = document.getElementById('newAnswer');
		var difficulty = document.getElementById('newDifficulty');

		var categoryValue = category.value;
		var subcategoryValue = subcategory.value;
		var questionValue = question.value;
		var answerValue = answer.value;
		var difficultyValue = difficulty.value;
		var categoryName = "Failed";
		var difficultyName = "Failed";

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

		//answerValue = prepareAnswer(answerValue);
		//Hoping that this will work now. Let's Test This Out
		subcategoryValue = subcategoryValue.trim();
		questionValue = questionValue.trim();
		answerValue = answerValue.trim();


		var cardCategory = document.getElementById('cardCategory');
		var cardSubcategory = document.getElementById('cardSubcategory');
		var cardQuestion = document.getElementById('cardQuestion');
		var cardAnswer = document.getElementById('cardAnswer');
		var cardDifficulty = document.getElementById('cardDifficulty');


		if(categoryValue == 0){
		 	alert("Please Select a Category");
		} else if(difficultyValue == 0){
		 	alert("Please Select a Difficulty");
		} else if (questionValue == 0) {
			alert("Please Enter a Question");
		} else if (answerValue == 0) {
			alert("Please Enter an Answer");
		} else{			
			cardDifficulty.innerHTML = difficultyName;
			cardCategory.innerHTML = categoryName + ": ";
			cardSubcategory.innerHTML = subcategoryValue;
			cardQuestion.innerHTML = "Q: " + questionValue;
			cardAnswer.innerHTML = "A: " + answerValue;

			if (!selected) {
				selected = true;
				$('#card').slideDown();
			}
		}

	});

	function prepareAnswer(str) {
		var punctuationless = str.replace(/[\.,-\/#!$%\^&\*;:{}=\-_`~()@]/g,"")
		var noSpaces = punctuationless.replace(/\s{2,}/g," ");
		var finalString =noSpaces.toLowerCase();
		return finalString;
	}

});
