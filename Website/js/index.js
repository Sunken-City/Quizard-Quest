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
        	} else {
            	// do failure things
            	alert("Username or Password is Invalid!");
        	}
		},"json");

		e.preventDefault();

	});

	$("#signUp").click(function (e) {

		var fname = $("#firstName").val();
		var lname = $("#lastName").val();
		var Email = $("#email").val();
		var username = $("#username").val();
		var newpwd = $("#newPassword").val();
		var gender;

		if ($("#male").val() != null) {

			gender = $("#male").val();

		} else {

			gender = $("#female").val();
		}

		var Grade = $("#grade").val();

		formData = {
			'fname':fname,
			'lname':lname,
			'Email':Email,
			'username':username,
			'newpwd':newpwd,
			'gender':gender,
			'Grade':Grade
		};

		$.post("../API_Server/createAccount.php",formData, function(data) {

			if (data['success'] === 'username') {
				// do failure things
            	alert("That username is already in use!");

        	} else if (data['success'] === 'email') {
            	// do failure things
            	alert("That email is already in use!");

        	} else {
        		// do successful things
            	window.location.href = "mainMenu.php";
        	}

		},"json");

		e.preventDefault();
	});

});
