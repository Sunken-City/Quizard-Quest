$(document).ready(function(){


$("#submitQuestion").click(function(e){

	var category = document.getElementById('categorySelect').value;
	var subcategory = document.getElementById('newSubcategory').value;
	var question = document.getElementById('newQuestion').value;
	var answer = document.getElementById('newAnswer').value;
	var difficulty = document.getElementById('newDifficulty').value;

	alert(category + subcategory + question + answer + difficulty);


	var formData = {'category':category,'subcategory':subcategory,'question':question, 'answer':answer, 'difficulty':difficulty};

	$.post("../API_Server/cardCreation.php",formData,function(){
		alert("Question Added");
	},"json");

});

});