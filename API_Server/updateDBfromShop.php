<?php

	include "API.php";
	session_start();

	$gold = intval($_POST['gold']);
	$path = $_POST['path'];

	set_avatar($path);

	$_SESSION['gold'] = $gold;
	set_stats();

?>