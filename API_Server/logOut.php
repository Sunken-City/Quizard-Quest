<?php
	/*\
	|*|		PHP that destroys a session on logout
	\*/
	session_start();
	session_destroy();
	gapi.auth.signOut();
?>