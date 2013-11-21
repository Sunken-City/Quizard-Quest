<?php
	include "API.php";
	session_start();

	$deckID = $_SESSION['deckSelected'];
	$mode = array('mode' => $_SESSION['questSelected']);


	if ($_POST['mode']) {

		echo json_encode($mode);

	} else {

		$deckCards = get_deck_cards($deckID);
		echo json_encode($deckCards);

	}
	

?>