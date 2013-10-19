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

		// send validated data to next layer for submission to database
		if (!(isset($formData['gender']) && isset($formData['Grade']))) {

			create_user($formData[0],$formData[1],$formData[2],$formData[3],$formData[4]);

		} else if (isset($formData['gender']) && !isset($formData['Grade'])) {

			create_user($formData[0],$formData[1],$formData[2],$formData[3],$formData[4],$formData['gender']);

		} else if (!isset($formData['gender']) && isset($formData['Grade'])) {

			$gender = NULL;
			create_user($formData[0],$formData[1],$formData[2],$formData[3],$formData[4],$gender,$formData['Grade']));
		}

	} else {
		die ("I don't know what you did, but it was a mistake. Go back and do not return here!");
	}
	#######################################################
	#If form data was successfully authenticated/submitted#
	#######################################################
	if ($submission) {
		# Redirect to
		session_start();
		$_SESSION['uname'] = $formData['Email'];	
		include 'redirect.php';

	} else {
		die ("I don't know what you did, but it was a mistake. Go back and do not return here!");
	}
?>