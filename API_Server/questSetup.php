<?php
	
	include "API.php";
	session_start();

	$deckIDofChosenDeck = $_POST['deckSelect'];
	$questSelected = $_POST['modeSelect'];

	$_SESSION['deckSelected'] = $deckIDofChosenDeck;
	$_SESSION['questSelected'] = $questSelected;

	$avatar = get_avatar();

	$_SESSION['avatarPath'] = $avatar;

?>