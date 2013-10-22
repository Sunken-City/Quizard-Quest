<?php

	include "API.php";

	$username = $_POST['username'];
	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$difficulty = $_POST['difficulty'];

	$card = create_card($username,$question,$answer,$category,$subcategory,$difficulty);

?>