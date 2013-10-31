<!DOCTYPE HTML>
<!-- 
	Main Menu page for Quizard Quest
	Author: Nathan Moore
-->
		<?php
			session_start();
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    $_SESSION['redirected'] = true;
			    header('Location:http://54.200.66.93/Quizard-Quest/Website/Error.php?err=199');
			    die();
			}
		?>
<html lang="en">

	<head>

		<title>QQ: Main Menu</title>
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<meta charset="UTF-8">
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/mainMenu.js"></script>
		<script type = "text/javascript" src="js/navigation.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>



	</head>

	<body>

		<div class="content">

			<header>

				<nav class="navbar">
					<button type="button" id="logOut" class="navButton">Log Out</button>
					<button type="button" id="createCard" >Create a Card!</button>
					<button type="button" id="createDeck" >Create a Deck!</button>
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