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

				<h1 id="userName"></h1>
				<img id="avatar"src="" alt ="Avatar"></img>

				<section id = "userProfile">

					<!-- Display user's decks -->
					<!--
						=>	List the User's Decks
							->	Each tag is selectable
							->	When selected:
								>	Display all cards in that deck
					  -->
					<div id="profileDecks" class="mainMenu">
						<h2>Decks:</h2>
						<div id="deckCards">
							<h2>Cards in Selected Deck:</h2>
							<p> -- No Deck Selected -- </p>						
						</div>
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
						<h2>User Stats:</h2>
						<div id="displayStats"></div>
					</div>

				</section>
				
				<section id = "newsFeed">

				    <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/QuizardQ" data-widget-id="400154213004492800">Tweets by @QuizardQ</a>
					    <script>
						    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
						    if(!d.getElementById(id)){js=d.createElement(s);js.id=id;
					    	js.src=p+"://platform.twitter.com/widgets.js";
					    	fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
					    </script>

				</section>

			</div>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>

	</body>

</html>
