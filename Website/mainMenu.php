<!DOCTYPE HTML>
<!-- 
	Main Menu page for Quizard Quest
	Author: Nathan Moore
-->
<html lang="en">

	<head>

		<title>QQ: Main Menu</title>
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<meta charset="UTF-8">
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/mainMenu.js"></script>
		<script type = "text/javascript" src="js/navigation.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

		<?php
			session_start();
			include '../API_Server/url.php';
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    $_SESSION['redirected'] = true;
			    header('Location:http://'.$url.'/Quizard-Quest/Website/Error.php?err=19999999999994123480941204');
			    die();
			}
		?>

	</head>

	<body>

		<div class="content">

			<header>

				<nav class="navbar">
					<button type="button" id="logOut" class="navButton">Log Out</button>
					<button type="button" id="createCard" >Create a Card!</button>
					<button type="button" id="createDeck" >Create a Deck!</button>
					<button type="button" id="reviewDecks" >Review your Decks!</button>
				</nav>

			</header>

			<article class="directions">
				<!-- <button type="button" class="makeHeader1">
					Here's Where It All Begins!
				</button> -->
				<h3>Use the navbar at the top of the page to test deck and card creation or log out to the index page!</h3>
			</article>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>English (US)</p>
			</footer>

		</div>

	</body>

</html>