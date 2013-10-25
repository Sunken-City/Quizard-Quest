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

	$("#submitQuestion").click(function(e){

		var category = document.getElementById('categorySelect').value;
		var subcategory = document.getElementById('newSubcategory').value;
		var question = document.getElementById('newQuestion').value;
		var answer = document.getElementById('newAnswer').value;
		var difficulty = document.getElementById('newDifficulty').value;

		var answer = prepareAnswer(answer);
		//Hoping that this will work now. Let's Test This Out
		alert(answer);

		var formData = {category:category,subcategory:subcategory,question:question, answer:answer, difficulty:difficulty};

		$.post("../API_Server/CardCreation.php",formData,function(){
		});

		e.preventDefault();
		alert("Question Added");
		window.location.href = "cardCreation.html";
	});

	function prepareAnswer(str) {
		var punctuationless = str.replace(/[\.,-\/#!$%\^&\*;:{}=\-_`~()@]/g,"")
		var noSpaces = punctuationless.replace(/\s{2,}/g," ");
		var finalString =noSpaces.toLowerCase();
		return finalString;
	}

});