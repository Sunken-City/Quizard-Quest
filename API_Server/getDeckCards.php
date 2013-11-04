<?php
   $q=$_GET["q"];

	include "API.php";
	session_start();
	//file_put_contents($file, $category);
        $deckCards =  get_deck_cards($q);
	
	echo $deckCards[0].question;
	
?>
