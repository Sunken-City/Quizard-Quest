<?php

	/*\
	|*|		#PHP that receives log in data from index.html
	|*|			and sends it to the API server for authentication
	|*|		#returns a string to index.js with the success/failure of authentication
	\*/

	include "API.php";
	session_start();

	$pass = $_POST['pass'];
	$user = $_POST['user'];

	$authenticated = validate_password($user,$pass);

	$postData = array('success' => $authenticated);
	echo json_encode($postData);

?>