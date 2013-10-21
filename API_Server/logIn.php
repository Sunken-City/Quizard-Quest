#Receives form data for Authenticating a current user
#Author: Nathan Moore

<?php

	include "API.php";

	$pass = $_POST['pass'];
	$user = $_POST['user'];

	$authenticated = validate_password($user,$pass);

	$postData = array('success' => $authenticated);
	echo json_encode($postData);

?>