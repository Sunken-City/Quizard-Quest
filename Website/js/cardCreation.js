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

		//var answer = prepareAnswer(answer);
		//Hoping that this will work now. Let's Test This Out.
		subcategory = subcategory.trim();
		question = question.trim();
		answer = answer.trim();
		var formData = {category:category,subcategory:subcategory,question:question, answer:answer, difficulty:difficulty};

		if(category == 0){
			//alert("Please Select a Category");
		}
		else if(difficulty == 0){
			//alert("Please Select a Difficulty");
		}
		else{
			$.post("../../API_Server/CardCreation.php",formData,function(){
			});

			e.preventDefault();
			alert("Question Added");
			window.location.href = "cardCreation.php";
		}
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
		// 	alert("Please Select a Category");
		}
		else if(difficultyValue == 0){
		// 	alert("Please Select a Difficulty");
		}
		else{			
			cardDifficulty.innerHTML = difficultyName;
			cardCategory.innerHTML = categoryName + ": ";
			cardSubcategory.innerHTML = subcategoryValue;
			cardQuestion.innerHTML = "Q: " + questionValue;
			cardAnswer.innerHTML = "A: " + answerValue;
		}

		// var widthForPreview = $(".content").width() - $("#submitCard").width() - 10;
		// var heightOffset = $("#submitCard").height() - 20;
		// var widthOffset = $("#submitCard").width() + 40;

		var Card = $('#card');
		var titles = $('#cardTitles');
		var Category = $("#cardCategory");
		var SubCategory = $("#cardSubcategory");
		var Question = $("#cardQuestion");
		var Answer = $("#cardAnswer");
		var Difficulty = $("#cardDifficulty");

		$('#card').css({
			'border':'5px ridge rgb(188,188,188)',
			'background-color': 'rgba(0,113,147,.25)',			
			'font-family':"'VT323', cursive",
		});

		$('#cardTitles').css({
			'border-bottom':'2px groove rgb(188,188,188)',
			'background-color':'rgba(0,113,147,.45)',
			'margin':'-10px',
			'-moz-border-top-left-radius': '12px',
  			'-webkit-border-top-right-radius': '12px',
  			'-moz-border-top-right-radius': '12px',
  			'-webkit-border-top-left-radius': '12px',
		});

		$("#cardCategory").css({
			'position':'relative',
			'display':'inline-block',
			'font-size':'3em',			
		});

		$("#cardSubcategory").css({
			'position':'relative',
			'display':'inline-block',
			'font-size':'2.25em',
		});

		$('.cat').css({
			'margin-top':'-5px',
			'margin-bottom':'10px',
		});

		$("#cardQuestion").css({
			'position':'relative',
			'font-size':'1.75em',
			'margin-top':'40px',
			'margin-bottom':'50px',
			'margin-left':'40px',
			'margin-right':'40px',
			'text-align':'center',
		});

		$("#cardAnswer").css({
			'position':'relative',
			'font-size':'1.25em',
			'border':'4px outset rgb(233,233,233)',
			'padding':'10px',
			'background-color': 'rgba(0,113,147,.25)',
			'margin-left':'80px',
			'margin-right':'80px',
			'margin-bottom':'30px',
			'-moz-border-radius': '5px',
  			'-webkit-border-radius': '5px',
		});

		$("#cardDifficulty").css({
			'text-align': 'right',
			'padding-right': '20px',
			'padding-top': '5px',
		});

	});

	function prepareAnswer(str) {
		var punctuationless = str.replace(/[\.,-\/#!$%\^&\*;:{}=\-_`~()@]/g,"")
		var noSpaces = punctuationless.replace(/\s{2,}/g," ");
		var finalString =noSpaces.toLowerCase();
		return finalString;
	}

});
