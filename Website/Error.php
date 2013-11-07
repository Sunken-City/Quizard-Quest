<!DOCTYPE HTML>

<html lang="en">

	<head>

		<title>QQ: Error</title>
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<meta charset="UTF-8">
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/Error.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>

	</head>

	<body>
		<div class="content">

			<header><nav class="navbar"></nav></header>

			<!-- <article class="directions">
				<button type="button" class="makeHeader1" id="redirect">
					Here's Where It All Begins!
				</button>
			</article> -->

			<?php

				if(isset($_GET['err'])) {
					echo '<h1 id="Error">Error #'.$_GET['err'].':</h1>';

				    if($_GET['err'] == 100) {

				      echo "<div class=\"error\" id=\"userPreexists\">
				      			<h2 class=\"errorMessage\">The username you entered is already associated with a user. 
					      			Please return to the previous page and log in with your password or use a different username.
					      			Or hit the button below.
				      			</h2>
				      		</div>";

				    } else if($_GET['err'] == 101) {

				      echo "<div class=\"error\" id=\"emailPreexists\">
				      			<h2 class=\"errorMessage\">The email you entered is already associated with a user.
					      			Please return to the previous page and log in with your password or use a different email.
					      			Or hit the button below.
				      			</h2>
				            </div>";

				    } else if($_GET['err'] == 199) {

				    	echo "<div class=\"error\" id=\"unLogin\">
				    			<h2 class=\"errorMessage\">You are not logged in. Only registered users can view this page.</h2>
					 		  </div>";

				    } else if($_GET['err'] == 404) {

				    	echo "<div class=\"error\" id=\"nonExistent\">
				    			<h2 class=\"errorMessage\">The page you requested doesn't exist.</h2>
					 		  </div>";

				    } else {

				      echo "<div class=\"error\" id=\"badError\">
				      			<h2 class=\"errorMessage\">
				      				Invalid error code. Please stop trying to make up even more errors! :c				      				
									Go away from this place and do not return! You should never have come here!
				      			</h2>
				      		</div>";
				    }
				
				} else {
					echo "<div class=\"error\" id=\"nonError\">
								<h2 class=\"errorMessage\">
									No problems here! Except that you got here without an error... That's a problem...
									Go away from this place and do not return! You should never have come here!
								</h2>
						  </div>";
				}
			?>

			<article id="redirections">
				<button type="button" class="makeHeader1" id="redirect">
					Quizard Quest Login Menu
				</button>
			</article>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>English (US)</p>
			</footer>

		</div>

	</body>

</html>