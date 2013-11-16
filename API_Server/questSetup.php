<?php
	
	session_start();

	$deckIDofChosenDeck = $_POST['deckSelect'];
	$questSelected = $_POST['modeSelect'];

	$_SESSION['deckSelected'] = $deckIDofChosenDeck;
	$_SESSION['questSelected'] = $questSelected;

?>