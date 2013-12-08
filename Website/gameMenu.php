<!DOCTYPE HTML>

<html land="en">

	<head>

	<title>QQ: Begin Quest</title>
	<link rel="stylesheet" href="css/mainStyle.css"/>
	<meta charset="UTF-8">
	<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type = "text/javascript" src="js/gameMenu.js"></script>
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
					<button type="button" id="home" class="navButton">Home</button>
					<button type="button" id="gotoStore" >Secret Shop</button>
					<button type="button" id="createCard" >Create a Spell!</button>
					<button type="button" id="createDeck" >Create a Spellbook!</button>
					<button type="button" id="reviewDecks" >Edit your Spellbooks</button>
					<button type="button" id="logOut" class="navButton">Log Out</button>
				</nav>
			</header>

			<div id="gameSelections">
				<!-- Select a Deck -->
				<div id="chooseDeck">
					<h2>Select Your Spellbook:</h2>
					<select id="deckSelect">
						<option value="-1">Select Spellbook</option>
						<!-- Dynamically Loaded -->
					</select>
				</div>

				<!-- Select a Mode -->
				<div id="chooseMode">
					<p> Training mode: No risk just play and practice answering questions, but do not expect to find much gold</p><br>
					<p> Quest mode: After feeling a little more comfortable with your decks, you can go to Quest mode. Cost 300 gold, miss more than 1/3rd of the questions and you lose. You get more gold for doing this one</p><br>
					<p> Save the World: Think you mastered a deck. Try Save the World, You are have limited time to answer questions, but the reward is gold and lots of it. </p><br>
					<p> press enter to submit your answeres</p>
					<h2>Select Your Challenge:</h2>
					<select id="modeSelect" name="modeSelect">
						<option value="-1">Select Challenge</option>
						<option value="0">Training (Free!)</option>
						<option value="1">Quest (300 gold)</option>
						<option value="2">Save the World (500 gold)</option>
					</select>
				</div>

				<!-- Start Game -->
				<div id="beginSelect">
					<button type="button" id="begin">Begin Your Quest!</button>
				</div>
			</div>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>

	</body>

</html>
