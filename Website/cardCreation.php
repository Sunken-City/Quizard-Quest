<!DOCTYPE HTML>
<!-- 
	Create a Card page for Quizard Quest
	Author: Peter DeNicola
-->
<html lang="en">
<head>
	<title> Create-A-Card</title>
	<link rel="stylesheet" href="css/mainStyle.css"/>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type = "text/javascript" src="js/cardCreation.js"></script>
	<script type = "text/javascript" src="js/navigation.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

	<?php
		session_start();
		if(!isset($_SESSION['userID'])) {
		    // not logged in
		    session_destroy();
		    die ("You must log in to view this page");
			    //header('Location: http://54.200.66.93/Quizard-Quest/Website/');
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

		<div id ="submitCard">
			<table>
				<tr>
					<td><label for="categorySelect">Category:</label></td>
					<td><label for="newSubcategory">Subcategory: </label></td>
					<td><label for="newQuestion">Question: </label></td>
					<td><label for="newAnswer">Answer: </label></td>
					<td><label for="newDifficulty">Difficulty: </label></td>
				</tr>
				<tr>
					<td>
						<select id="categorySelect">
							<option value="">Select</option>
							<option value="1">Math</option>
							<option value="2">Science</option>
							<option value="3">History</option>
							<option value="4">English</option>
							<option value="5">Language</option>
						</select>
					</td>
					<td><input type="text" id="newSubcategory" maxlength="32" title="Please Enter A Subcategory." placeholder="Subcategory" required></td>
					<td><input type ="text" id="newQuestion" maxlength="512" title="Please Enter A Question." placeholder="Question" required></td>
					<td><input type ="text" id="newAnswer" maxlength="64" title="Please Enter An Answer." placeholder="Answer" required></td>
					<td>
						<select id="newDifficulty">
							<option value="">Select</option>
							<option value="1">Easy</option>
							<option value="2">Normal</option>
							<option value="3">Hard</option>
							<option value="4">Nigh-Impossible</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="blank"></td>
					<td class="blank"></td>
					<td class="blank"></td>
					<td class="blank"></td>
					<td><input type ="button" id="previewCard" value = "Preview New Card" /> </td>
					<td><input type ="button" id="submitQuestion" value ="Submit New Card" class="submitButton" /></td>
				</tr>	
			</table>			
		</div>

		<footer>
			<p>Quizard Quest is brought to you by cd msc/</p>
			<p>English (US)</p>
		</footer>

		<div id="card">
			<div id="cardBackground">
			</div>
			<div id="cardCategory">
			</div>
			<div id="cardSubcategory">
			</div>
			<div id="cardQuestion">
			</div>
			<div id="cardDifficulty">
			</div>
			<div id="cardAnswer">
		</div>
	</div>
	</div>

</body>
</html>
