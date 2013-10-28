<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
	session_start();

	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$difficulty = $_POST['difficulty'];


	//$file = "../Design_Documents/test.txt";
	//file_put_contents($file, $category);
	$card = create_card($question,$answer,$category,$subcategory,$difficulty);

?>
