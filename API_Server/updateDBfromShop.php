<?php

	include "API.php";
	session_start();

	$gold = intval($_POST['gold']);
	$path = $_POST['path'];

	$options = get_options();

	set_options($path, $options['cardBoarder'], $options['bgColor']);

	$_SESSION['gold'] = $gold;
	set_stats();

?>