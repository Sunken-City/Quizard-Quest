<!DOCTYPE HTML>
<!-- 
	Password Reset Page
	Author : Gustavo Castillo
 -->
<html lang="en">

	<head>

		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<title>Password Reset</title>
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/navigation.js"></script>
		<script type = "text/javascript" src="js/passwordReset.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>


	</head>
	
	<body>
		<div class="content">
			
			<form id="pwReset" action="../API_Server/checkSecurityAnswer.php" method="POST" autocomplete="off">
				<input type="text" placeholder="Username" id="user" name="user" required />
				<button type="button" value="Get Question" id="getSecurity"> Get Question</button>
				<div id="securityQuestion">
				</div>
			</form>


			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>2013 English (US)</p>
			</footer>

		</div>
	</body>

</html>
