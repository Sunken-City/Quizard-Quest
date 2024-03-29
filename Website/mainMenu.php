<!DOCTYPE HTML>
<!-- 
	Main Menu page for Quizard Quest
	Author: Nathan Moore
-->
<html lang="en">

	<head>

		<title>QQ: Your Profile</title>
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<link rel="stylesheet" href="css/menu.css"/>
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
				<img id="headerLogo" src="../Resources/Logo/VertLogo_v2.png" alt="Quizard Quest Logo"/>
				<nav class="navbar" class="nonIndex">
					<button type="button" id="startGame" >Begin your Quest!</button>
					<button type="button" id="gotoStore" >Secret Shop</button>
					<button type="button" id="createCard" >Create a Spell!</button>
					<button type="button" id="createDeck" >Create a Spellbook!</button>
					<button type="button" id="reviewDecks" >Edit your Spellbooks</button>
					<button type="button" id="logOut" class="navButton">Log Out</button>
				</nav>

			</header>

			<div id="subContent">

				<div id="usrnmDiv" class="heading">
					<h1 id="userName"></h1>
					<img id="avatar"src="" alt ="Avatar"></img>
				</div>

				<section id = "userProfile">

					<!-- Display user's decks -->
					<!--
						=>	List the User's Decks
							->	Each tag is selectable
							->	When selected:
								>	Display all cards in that deck
					  -->
					<div id="profileDecks" class="mainMenu">
						<h2 class="heading">Spellbooks:</h2>
					</div>

					<div id="deckCards">
						<p> -- No Spellbook Selected -- </p>						
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
					<div id="profileStats" class="mainMenu">
						<h2 class="heading">Progress:</h2>
						<div id="displayStats"></div>
					</div>

				</section>
				
				<section id = "newsFeed">

				    <iframe width="420" height="315" src="//www.youtube.com/embed/Ga0_0hMNuAk?rel=0" frameborder="0" allowfullscreen></iframe>

				</section>

			</div>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>

	</body>

</html>
