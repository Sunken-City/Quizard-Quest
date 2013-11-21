<?php
	include "API.php";
	session_start();

	$deckID = $_SESSION['deckSelected'];
	$mode = array('mode' => $_SESSION['questSelected']);


	if (strcmp($_POST['mode'], 'true') === 0) {

		echo json_encode($mode);

	} else {

		$deckCards = get_deck_cards($deckID);
		array_push($deckCars, $mode);
		echo json_encode($deckCards);

	}
	

?>