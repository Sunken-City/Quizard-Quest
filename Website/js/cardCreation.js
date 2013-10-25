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

		alert(category + subcategory + question + answer + difficulty);
		//Hoping that this will work now. Let's Test This Out

		var formData = {category:category,subcategory:subcategory,question:question, answer:answer, difficulty:difficulty};

		$.post("../API_Server/CardCreation.php",formData,function(){
			alert("Question Added");
		},"json");

		e.preventDefault();

		window.location.href = "cardCreation.html";
	});

});