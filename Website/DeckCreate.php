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
		<script type = "text/javascript" src="js/deckCreate.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

		<?php
			session_start();
			include '../API_Server/url.php';
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    //die ("You must log in to view this page");
			    $_SESSION['redirected'] = true;
			    header('Location: http://'.$url.'/Quizard-Quest/Website/Error.php?err=199');
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
					<button type="button" id="reviewDecks" >Edit your Spellbooks</button>
					<button type="button" id="logOut" class="navButton">Log Out</button>
				</nav>
			</header>

			<h1 id="CreateDeckHeading">Create a Spellbook!</h1>

			<form id="deckCreate" action="../API_Server/DeckCreation.php" method="POST" >
				<input id="nameDeck" type="text" name="Deckname" maxlength="32" title="Please Enter a Spellbook Name" placeholder="Spellbook Name" required>
				<div id="UserCards"></div>
				<input type="submit" value="Create Spellbook" id="createDeck" class="submitButton" />
			</form>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>

	</body>

</html>
