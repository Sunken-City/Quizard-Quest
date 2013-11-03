<?php
$q=$_GET["q"];

	include "API.php";
	session_start();

	
	//file_put_contents($file, $category);
        echo get_deck_cards_byName($q);
	
	
?>
