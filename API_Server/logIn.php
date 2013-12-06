<?php

	/*\
	|*|		#PHP that receives log in data from index.html
	|*|			and sends it to the API server for authentication
	|*|		#returns a string to index.js with the success/failure of authentication
	\*/

	include "API.php";
	session_start();

	// #If login through facebook
	if (isset($_POST['logInFrom'])) {

		//if Facebook
		if ( $_POST['logInFrom'] === 'Facebook') {

			$fID = $_POST['id'];

			//check if first time user
			$authenticated = facebookLoginCheck($fID);
			$postData = array('success' => $authenticated);
			echo json_encode($postData);
		}	

	} else { #If login from quizard quest

		$pass = $_POST['pass'];
		$user = $_POST['user'];

		$authenticated = validate_password($user,$pass);

		$postData = array('success' => $authenticated);
		$_SESSION['redirected'] = "logIn";
		echo json_encode($postData);

	}



?>