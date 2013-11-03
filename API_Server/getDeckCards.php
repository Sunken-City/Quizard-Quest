<?php
$q=$_GET["q"];

	include "API.php";
	session_start();

	
	//file_put_contents($file, $category);
        echo json_encode(get_all_cards());
	
?>
