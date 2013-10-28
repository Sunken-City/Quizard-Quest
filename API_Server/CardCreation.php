<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
	session_start();

	// if ($_SESSION['timeout'] + 10 * 60 < time()) {
 //    	// session timed out
 //    	session_destroy();

 //    	$timedOut = array('timeout' => true );

	// } else {
	// 	// session ok
	// 	$category = $_POST['category'];
	// 	$subcategory = $_POST['subcategory'];
	// 	$question = $_POST['question'];
	// 	$answer = $_POST['answer'];
	// 	$difficulty = $_POST['difficulty'];


	// 	//$file = "../Design_Documents/test.txt";
	// 	//file_put_contents($file, $category);
	// 	$card = create_card($question,$answer,$category,$subcategory,$difficulty);

	// 	$timedOut = array('timeout' => false );
	// }

	// echo json_encode($timedOut);

	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$difficulty = $_POST['difficulty'];


	//$file = "../Design_Documents/test.txt";
	//file_put_contents($file, $category);
	$card = create_card($question,$answer,$category,$subcategory,$difficulty);
?>