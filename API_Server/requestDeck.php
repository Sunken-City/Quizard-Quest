<?php
	include "API.php";
	session_start();

	$deckID = $_SESSION['deckSelected'];

	$deckCards = get_deck_cards($deckID);

	echo json_encode($deckCards);

?>