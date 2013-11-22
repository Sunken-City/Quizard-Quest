<!DOCTYPE HTML>

<html lang="en">

	<head>

		<meta charset="UTF-8">
		<title>Quizard Quest</title>
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!-- <script type = "text/javascript" src="js/supplyShop.js"></script> -->
		<script type = "text/javascript" src="js/navigation.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

		<?php
		    session_start();
		    include '../../API_Server/url.php';
		    if(!isset($_SESSION['userID'])) {
		        // not logged in
		        $_SESSION['redirected'] = true;
		        header('Location:http://'.$url.'/Quizard-Quest/Website/Error.php?err=199');
		        die();
		    }
    	?>

	</head>

	<body>

		<footer>
			<p>Quizard Quest is brought to you by cd msc/</p>
			<p>2013 English (US)</p>
		</footer>

	</body>

</html>