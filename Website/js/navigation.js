/*\
|*|		Javascript for the all html pages
\*/

$(document).ready(function() {

	// Load the SDK asynchronously
    (function(d){
	   var js, id = 'facebook-jssdk',
	   ref = d.getElementsByTagName('script')[0];
	   if (d.getElementById(id)) {return;}
	   js = d.createElement('script');
	   js.id = id;
	   js.async = true;
	   js.src = "http://connect.facebook.net/en_US/all.js";
	   ref.parentNode.insertBefore(js, ref);
	}(document));

	// Load the SDK asynchronously
	(function(){
	    // If we've already installed the SDK, we're done
	    if (document.getElementById('facebook-jssdk')) {return;}

	    // Get the first script element, which we'll use to find the parent node
	    var firstScriptElement = document.getElementsByTagName('script')[0];

	    // Create a new script element and set its id
	    var facebookJS = document.createElement('script'); 
	    facebookJS.id = 'facebook-jssdk';

	    // Set the new script's source to the source of the Facebook JS SDK
	    facebookJS.src = '//connect.facebook.net/en_US/all.js';

	    // Insert the Facebook JS SDK into the DOM
	    firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
	}());

	var newHeight = $(".navbar").height() * 2;
	var lessHeight = newHeight/4;

	$("header.nonIndex").css({
		// 'height':newHeight + 'px',
		'vertical-align':'middle',
	});

	$(".navbar").css({
		'margin-top': lessHeight + 'px',
	});

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the log out button
	|*|		# make an ajax request that sends the form data to 
	|*|			logOut.php to end the current session
	|*|		# redirects to the log in page (index.html)
	|*|
	\*/


	$("#logOut").click(function(e) {

		FB.logout(function(response) {
	        // Person is now logged out
    	});

		$.ajax({
			url: "../API_Server/logOut.php",
			success: function () {
				$.post("../API_Server/ajaxurl.php",function (url) {
					window.location.href = "http://" + url + "/Quizard-Quest/Website/";
				},"json");
				//http://54.200.66.93/Quizard-Quest/Website/
			}
		});

	});

	/*\
	|*|		:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the home button
	|*|		# redirect to mainMenu.html
	|*|
	\*/

	$("#home").click(function(e) {

		window.location.href = "mainMenu.php";

	});

	/*\
	|*|		:: >> Link to Create a Card << ::
	|*|
	|*|		# add a click listener to the create card button
	|*|		# redirects to cardCreation.php
	|*|
	\*/

	$("#createCard").click(function(e) {
		window.location.href = "cardCreation.php";
	})

	/*\
	|*|		:: >> Link to Create a Deck << ::
	|*|
	|*|		# add a click listener to the create deck button
	|*|		# redirects to DeckCreate.php
	|*|
	\*/

	$("#createDeck").click(function(e) {
		window.location.href = "DeckCreate.php";
	});

	/*\
	|*|		:: >> Link to Edit Decks << ::
	|*|
	|*|		# add a click listener to the edit decks button
	|*|		# redirects to DeckDisplay.php
	|*|
	\*/

	$("#reviewDecks").click(function(e) {
		window.location.href = "DeckDisplay.php";
	});

	$("#startGame").click(function(e) {
		window.location.href = "gameMenu.php";
	});

	$("#gotoStore").click(function(e) {
		window.location.href = "supplyShop.php";
	});

	$("#headerLogo").click(function(e) {
		window.location.href = "mainMenu.php";
	});

});
