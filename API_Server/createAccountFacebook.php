<?php

	include "API.php";
	session_start();

	$uid = $_POST['id'];

	changeID($uid);
?>