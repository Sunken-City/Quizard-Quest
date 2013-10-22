$(document).ready(function(){


$("#submitQuestion").click(function(e){

	var category = document.getElementById('categorySelect').getAttribute("value");
	var subcategory = document.getElementById('newSubcategory').getAttribute("value");
	var question = document.getElementById('newQuestion').getAttribute("value");
	var answer = document.getElementById('newAnswer').getAttribute("value");
	var difficulty = document.getElementById('newDifficulty').getAttribute("value");
	var formData = {category:category,subcategory:subcategory,question:question, answer:answer, difficulty:difficulty};

	$.post("../API_Server/cardCreation.php",formData,function(){
		alert("Question Added");
	},"json");

});

});