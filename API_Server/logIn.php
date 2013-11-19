<?php

	/*\
	|*|		#PHP that receives log in data from index.html
	|*|			and sends it to the API server for authentication
	|*|		#returns a string to index.js with the success/failure of authentication
	\*/

	include "API.php";
	session_start();

	// #If login through facebook or google
	// if (isset($_POST['logInFrom'])) {

	// 	//if Facebook
	// 	if ( $_POST['logInFrom'] === 'Facebook') {

	// 		//check if first time user
			

	// 	} else { //if Google



	// 	}		

	// } else { #If login from quizard quest

		$pass = $_POST['pass'];
		$user = $_POST['user'];

		$authenticated = validate_password($user,$pass);

		$postData = array('success' => $authenticated);
		$_SESSION['redirected'] = "logIn";
		echo json_encode($postData);

	// }



?>