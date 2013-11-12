<!DOCTYPE HTML>
<html lang="en">
	<head>
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
		<script src="http://connect.facebook.net/en_US/all.js"></script>
	</body>

</html>