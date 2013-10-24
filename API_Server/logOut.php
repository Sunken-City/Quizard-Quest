<?php
	if (isset($_SESSION['userID'])) {
		session_destroy();
	}
?>