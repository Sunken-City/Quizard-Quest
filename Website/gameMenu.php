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
					<button type="button" id="logOut" class="navButton">Log Out</button>
				</nav>
			</header>

			<div id="gameSelections">
				<!-- Select a Deck -->
				<div id="chooseDeck">
					<h2>Select Your Spellbook:</h2>
					<select id="deckSelect">
						<option value="">Select Spellbook</option>
						<!-- Dynamically Loaded -->
					</select>
				</div>

				<!-- Select a Mode -->
				<div id="chooseMode">
					<h2>Select Your Challenge:</h2>
					<select id="modeSelect" name="modeSelect">
						<option value="0">Training</option>
						<option value="1">Quest</option>
						<option value="2">Save the World</option>
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