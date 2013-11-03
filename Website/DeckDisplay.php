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
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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

			<header>
				<nav class="navbar">
					<button type="button" id="logOut" class="navButton">Log Out</button>
					<button type="button" id="home" class="navButton">Home</button>
				</nav>
			</header>

			<h1> Select the deck you wish to edit</h1>
			<form id="deckSelect">
				
				<select name="Decks" id="Decks" onchange="showDeck(this.value)">
					<option value="">Select Deck</option>
				</select>
			</form>

			<form id="cardRemove" action=# method="POST" >
				<table id="deckCards">  				
				</table>
				<input type="submit" value="removeCards" id="removeCards" class="submitButton" />
			</form>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>English (US)</p>
			</footer>

		</div>
	</body>

</html>
