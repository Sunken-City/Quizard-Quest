$(document).ready(function(){


$("#submitQuestion"){

	var category = document.getElementById('categorySelect').value;
	var subcategory = document.getElementById('newSubcategory').value;
	var question = document.getElementById('newQuestion').value;
	var answer = document.getElementById('newAnswer').value;

	var formDate = {category:category,subcategory:subcategory,question:question, answer:answer};

	$.post("php/newQuestion.php",formData,function(){
		alert("Question Added");
	})
});