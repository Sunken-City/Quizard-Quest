<?php
   $q=$_GET["q"];

	include "API.php";
	session_start();
	//file_put_contents($file, $category);
        $deckCards =  get_non_deck_cards($q);
	
	var_dump($deckCards);
	
?>
