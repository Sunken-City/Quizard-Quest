<?php
	
	session_start();

	$deckIDofChosenDeck = $_POST['deckSelected'];
	$questSelected = $_POST['questSelected'];

	$_SESSION['deckSelected'] = $deckIDofChosenDeck;
	$_SESSION['questSelected'] = $questSelected;

?>