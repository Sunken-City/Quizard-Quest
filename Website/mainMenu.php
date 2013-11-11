<!DOCTYPE HTML>
<!-- 
	Main Menu page for Quizard Quest
	Author: Nathan Moore
-->
<html lang="en">

	<head>

		<title>QQ: Your Profile</title>
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<meta charset="UTF-8">
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/mainMenu.js"></script>
		<script type = "text/javascript" src="js/navigation.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

		<?php
			session_start();
			include '../API_Server/url.php';
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    $_SESSION['redirected'] = true;
			    header('Location:http://'.$url.'/Quizard-Quest/Website/Error.php?err=199');
			    die();
			}
		?>

	</head>

	<body>

		<div class="content">

			<header class="nonIndex">

				<nav class="navbar" class="nonIndex">
					<button type="button" id="startGame" >Begin your Quest!</button>
					<button type="button" id="gotoStore" >Quizards' Outfitters</button>
					<button type="button" id="createCard" >Create a Card!</button>
					<button type="button" id="createDeck" >Create a Deck!</button>
					<button type="button" id="reviewDecks" >Edit your Decks</button>
					<button type="button" id="logOut" class="navButton">Log Out</button>
				</nav>

			</header>

			<section id = "userProfile">

				<img id="avatar"></img>
				<h2 id="userName"></h2>
				<!-- Display user's decks -->
				<!--
					=>	List the User's Decks
						->	Each tag is selectable
						->	When selected:
							>	Display all cards in that deck
				  -->
				<div id="profileDecks">

				</div>
				
				<!-- Display user's stats -->
				<!--
					=>	Display by Category
						->	Math
						->	Science
						->	English
						->	Language
						->	History
					=>	Display Total
					=>	Display Gold Earned
					=>	Display Achievements
				  -->
				<div id="profileStats">

				</div>

			</section>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>

	</body>

</html>