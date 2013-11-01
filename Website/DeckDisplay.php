<!DOCTYPE HTML>
<!-- 
	Create a Deck page for Quizard Quest
	Author : Gustavo Castillo
 -->
<html lang="en">

	<head>

		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<title>Create-a-Deck</title>
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/navigation.js"></script>
		<script type = "text/javascript" src="js/deckDisplay.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

		<?php
			session_start();
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    //die ("You must log in to view this page");
			    $_SESSION['redirected'] = true;
			    header('Location: http://54.200.66.93/Quizard-Quest/Website/Error.php?err=199');
			    // header('Location: http://Quizard-Quest/Website/Error.php?err=199');
			}
		?>

	</head>
	
	<body>
	<ul id="Decks">
	
	</ul>

	</body>

</html>
