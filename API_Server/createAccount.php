<?php

	/*\
	|*|		#PHP that receives form data for creating a new user account
	|*|			and sends it to the API server for authentication
	\*/

        include 'API.php';
        session_start();

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
                		# if gender and grade are not in the submitted data then only submit what's required #

                        create_user($formData['fname'],$formData['lname'],$formData['Email'],$formData['username'],$formData['newpwd']);

                } else if (isset($formData['gender']) && !isset($formData['Grade'])) {
                		# if gender is set but grade is not then only submit what's included #

                        create_user($formData['fname'],$formData['lname'],$formData['Email'],$formData['username'],$formData['newpwd'],$formData['gender']);

                } else if (!isset($formData['gender']) && isset($formData['Grade'])) {
                		# if grade is set and gender is not then submit gender as null with everything that is included #

                        $gender = NULL;
                        create_user($formData['fname'],$formData['lname'],$formData['Email'],$formData['username'],$formData['newpwd'],$gender,$formData['Grade']);
                        
                } else if (isset($formData['gender']) && isset($formData['Grade'])){
                	# if gender and grade are in the submitted data then submit everything #

                	create_user($formData['fname'],$formData['lname'],$formData['Email'],$formData['username'],$formData['newpwd'],$formData['gender'],$formData['Grade']);
                }

        } else {
                die ("I don't know what you did, but it was a mistake. Go back and do not return here!");
        }

        #################################################
        #Redirect to the mainMenu.html page upon success#
        #################################################

        /* Nathan's EC2: Location: http://54.200.66.93/Quizard-Quest/Website/mainMenu.html */

        header("Location: http://54.200.66.93/Quizard-Quest/Website/mainMenu.html");

        return true;
?>