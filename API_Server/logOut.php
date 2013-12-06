<?php
	/*\
	|*|		PHP that destroys a session on logout
	\*/
	session_start();
	session_destroy();

	FB.logout(function(response) {
        // Person is now logged out
    });
?>