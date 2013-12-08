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
					<select id="modeSelect" name="modeSelect">
						<option value="-1">Select Challenge</option>
						<option value="0">Training (Free!)</option>
						<option value="1">Quest (150 gold)</option>
						<option value="2">Save the World (300 gold)</option>
					</select>
					<h3> Training mode:</h3> <p> No risk, just practice answering your questions. Don't expect to find much gold, though.</p></br>
					<h3> Quest mode:</h3> <p>  Like training, but if you miss 30% of the questions, you lose! However, you get more gold for this increased challenge.</p></br>
					<h3> Save the World:</h3> <p>  Think you know your stuff? This mode is a Boss Battle; you have a limited time to answer questions, but the rewards are great!</p></br>
					<h2>Select Your Challenge:</h2>
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
