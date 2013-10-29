/*\
|*|		Javascript for the index.html
\*/

$(document).ready(function() {
	
	/*\
	|*|				:: >> Authenticate User After Login << ::
	|*|
	|*|		# add a click listener to the submit button associated 
	|*|			with the log in form (not the create account form)
	|*|		# make an ajax request that sends the form data to 
	|*|			logIn.php for authentication
	|*|		# if it is authenticated (i.e., success) the page will 
	|*|			be redirected to the mainMenu.html page
	|*|		# otherwise an alert will go off and form submission will 
	|*|			be aborted
	|*|
	\*/
	
	$("#logInButton").click(function(e) {
		var username = $("#user").val();
		var password = $("#password").val();

		var formData = {pass: password, user: username};

		$.post("../API_Server/logIn.php",formData,function(data){

			if(data['success']) {
            	// do successful things
            	window.location.href = "mainMenu.php";
        	}
        	else {
            	// do failure things
            	alert("Username or Password is Invalid!");
        	}
		},"json");

		e.preventDefault();

	});

});