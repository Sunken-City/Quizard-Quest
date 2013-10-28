<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
	session_start();

	$name = $_POST['name'];


	//$file = "../Design_Documents/test.txt";
	//file_put_contents($file, $category);
	return create_deck($name);

?>
