<?php
	include "API.php"
	sessionstart();

	$deckID = $_SESSION['deckSelected'];

	$deckCards = get_deck_cards($deckID);

	echo json_encode($deckCards);

?>