<?php
	/*\
	|*|		PHP that destroys a session on logout
	\*/
	session_start();
	if (isset($_SESSION['userID'])) {
		session_destroy();
	}
?>