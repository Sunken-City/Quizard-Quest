<?php
	/*\
	|*|		PHP that destroys a session on logout
	\*/

	if (isset($_SESSION['userID'])) {
		session_destroy();
	}
?>