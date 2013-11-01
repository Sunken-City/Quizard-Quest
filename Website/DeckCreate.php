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
		<script type = "text/javascript" src="js/deckCreate.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

		<?php
			session_start();
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    //die ("You must log in to view this page");
			    $_SESSION['redirected'] = true;
			    header('Location: http://54.200.66.93/Quizard-Quest/Website/Error.php?err=199');
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

			<h1>Create-a-Deck!</h1>

			<form id="deckCreate" action="../API_Server/DeckCreation.php" method="POST" >
				<input type="text" name="Deckname" maxlength="32" title="Please Enter A Deck Name" placeholder="Deck Name" required>
				<select name="Categories" id="categories" required>
					<option value="1">Math</option>
					<option value="2">Science</option>
					<option value="3">History</option>
					<option value="4">English</option>
					<option value="5">Language</option>
				</select>
				<table id="UserCards">  				
				</table>
				<input type="submit" value="Create Deck" id="createDeck" class="submitButton" />
			</form>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>English (US)</p>
			</footer>

		</div>

	</body>

</html>
