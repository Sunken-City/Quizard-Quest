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
			include '../API_Server/url.php';
			if(!isset($_SESSION['userID'])) {
			    // not logged in
			    $_SESSION['redirected'] = true;
			    //die ("You must log in to view this page");
				header('Location: http://'.$url.'/Quizard-Quest/Website/Error.php?err=199');
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
				<form action="#" method="POST" id="cardForm">
					<table id="cardTable">
						<tr>
							<td><label for="categorySelect">Category:</label></td>
							<td><label for="newSubcategory">Subcategory: </label></td>
							<td><label for="newQuestion">Question: </label></td>
							<td><label for="newAnswer">Answer: </label></td>
							<td><label for="newDifficulty">Difficulty: </label></td>
						</tr>
						<tr>
							<td>
								<select id="categorySelect" required>
									<option value="">Select</option>
									<option value="1">Math</option>
									<option value="2">Science</option>
									<option value="3">History</option>
									<option value="4">English</option>
									<option value="5">Language</option>
								</select>
							</td>
							<td><input type="text" id="newSubcategory" maxlength="32" placeholder="Subcategory"></td>
							<td><input type ="text" id="newQuestion" maxlength="512" title="Please Enter A Question." placeholder="Question" required></td>
							<td><input type ="text" id="newAnswer" maxlength="256" title="Please Enter An Answer." placeholder="Answer" required></td>
							<td>
								<select id="newDifficulty" required>
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
							<td><button type ="button" id="previewCard" class="submitButton">Preview New Card</button></td>
							<td><button type ="button" id="closePreview" class="submitButton">Close Preview</button></td>
							<td><input type ="submit" id="submitQuestion" value ="Submit New Card" class="submitButton" /></td>
						</tr>	
					</table>
				</form>			
			</div>

			<div id="card" class="card">
				<div id="cardTitles" class="cardTitles">
					<div id="cardDifficulty" class="cardDifficulty"></div>
					<div id="cardCategory" class="cat cardCategory"></div>
					<div id="cardSubcategory" class="cat subCat cardSubcategory"></div>
				</div>
				<div id="cardQuestion" class="cardQuestion"></div>
				<div id="cardAnswer" class="cardAnswer"></div>
			</div>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>

	</body>
</html>
