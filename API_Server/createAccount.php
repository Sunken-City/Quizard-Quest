#Receives form data for creating a new user account
#Author: Nathan Moore

<?php
	include 'API.php';

	$formData = array(); #an array to house the submitted from data
	#[0] = fname
	#[1] = lname
	#[2] = Email
	#[3] = username
	#[4] = newpwd
	#[5] = gender
	#[6] = Grade

	###############################################
	#Insert user input data from form in $formData#
	###############################################
	foreach($_POST as $key => $val) {

		$formData[$key] = htmlentities($val,ENT_QUOTES,'UTF-8');

	}

	######################################################
	# User just submitted data to create a new account#
	######################################################
	if (isset($formData['fname']) && isset($formData['lname']) && isset($formData['Email']) 
		&& isset($formData['username']) && isset($formData['newpwd'])) {

		//echo "line 28 ";

		// send validated data to next layer for submission to database
		if (!(isset($formData['gender']) && isset($formData['Grade']))) {

			//echo "line 31 ";

			create_user($formData['fname'],$formData['lname'],$formData['Email'],$formData['username'],$formData['newpwd']);

		} else if (isset($formData['gender']) && !isset($formData['Grade'])) {

			create_user($formData['fname'],$formData['lname'],$formData['Email'],$formData['username'],$formData['newpwd'],$formData['gender']);

		} else if (!isset($formData['gender']) && isset($formData['Grade'])) {

			$gender = NULL;
			create_user($formData['fname'],$formData['lname'],$formData['Email'],$formData['username'],$formData['newpwd'],$gender,$formData['Grade']);
		}

	} else {
		die ("I don't know what you did, but it was a mistake. Go back and do not return here!");
	}

	################################
	#Being new session and redirect#
	################################

	/* Nathan's EC2: Location: http://54.200.66.93//Quizard-Quest/Website/mainMenu.html */

	header("Location: http://54.200.66.93//Quizard-Quest/Website/mainMenu.html");

	return true;
?>