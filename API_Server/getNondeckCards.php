<?php
	include "API.php";
	session_start();

	$deckID = $_POST['deckID'];
	//file_put_contents($file, $category);
   echo json_encode(get_non_deck_cards($deckID));
	
?>
