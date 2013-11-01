/*\
|*|		Javascript for the all html pages
\*/

$(document).ready(function() {

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

		$.ajax({
			url: "../API_Server/logOut.php",
			success: function () {
				$.post("../../API_Server/ajaxurl.php",function (url) {
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

});
