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
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/navigation.js"></script>
		<script type = "text/javascript" src="js/deckDisplay.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

		<?php
			include '../API_Server/url.php';
			session_start();
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    //die ("You must log in to view this page");
			    $_SESSION['redirected'] = true;
			    header('Location: http://'.$url.'/Quizard-Quest/Website/Error.php?err=199');
			    // header('Location: http://Quizard-Quest/Website/Error.php?err=199');
			}
		?>

	</head>
	
	<body>
		<div class="content">

			<header class="nonIndex">
				<img id="headerLogo" src="../Resources/Logo/VertLogo_v2.png" alt="Quizard Quest Logo"/>
				<nav class="navbar">
					<button type="button" id="home" class="navButton">Home</button>
					<button type="button" id="createCard" >Create a Spell!</button>
					<button type="button" id="createDeck" >Create a Spellbook!</button>
					<button type="button" id="logOut" class="navButton">Log Out</button>
				</nav>
			</header>

			<h1 id="deckDisplayHeading"> Select the Spellbook You Wish to Edit!</h1>

			<div id="innerContent">

				<form id="cardRemove" action="../API_Server/editDeck.php" method="POST" >

					<select name="Decks" id="Decks" onchange="showDeck(this.value)">
						<option value="">Select Spellbook</option>
					</select>
					<h2>
						Current Spells in Spellbook:
					</h2>
					<div id="deckCards"></div>
					<h2>
						Spells Available to Add:
					</h2>
					<div id="userCards"></div>
					<input type="submit" value="Submit Changes" id="removeCards" class="submitButton" />

				</form>

			</div>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>
	</body>

</html>
