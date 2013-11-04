<?php
   $q=$_GET["q"];

	include "API.php";
	session_start();
	//file_put_contents($file, $category);
        $deckCards =  json_encode(get_deck_cards($q));
	
	foreach($deckCards as $card){
		
		echo $card;
	}
	
?>
