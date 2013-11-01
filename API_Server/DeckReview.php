<?php
	include 'API.php';	
	session_start();

	$deckNames = get_deck_names();

	echo json_encode($deckNames);
?>