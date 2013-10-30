<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
	session_start();

	
	//file_put_contents($file, $category);
        echo json_encode(get_all_cards());

?>
