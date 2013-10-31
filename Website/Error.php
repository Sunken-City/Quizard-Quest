<!--<!DOCTYPE HTML>

<html lang="en">

	<head>

		<title>QQ: Error</title>
		<link rel="stylesheet" href="css/mainStyle.css"/>
		<meta charset="UTF-8">
		<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type = "text/javascript" src="js/Error.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>-->

		<?php
			 echo "<html lang=\"en\">
		  <head>
			  <title>QQ: Error</title>
			  <link rel=\"stylesheet\" href=\"css/mainStyle.css\"/>
			  <meta charset=\"UTF-8\">
			  <script type = \"text/javascript\" src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js\"></script>
			  <script type = \"text/javascript\" src=\"js/Error.js\"></script>
			  <link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono|VT323' rel='stylesheet' type='text/css'>
		  </head>";
		  if(isset($_GET['err']))
		  {
		    if($_GET['err'] == 100)
		    {
		      echo "<body>The username you entered is already associated with a user.
		                 Please return to the previous page and log in with your 
		                 password or use a different username</body>";
		    }
		    else if($_GET['err'] == 101)
		    {
		      echo "<body>The email you entered is already associated with a user.
		                 Please return to the previous page and log in with your 
		                 password or use a different email</body>";
		    }
		    else if($_GET['err'] == 199)
		    {
		      echo "<body>You are not logged in. Only registered users can view this page.</body>";
		    }
		    else
		    {
		      echo "<body>Invalid error code. Please stop trying to make up even more errors! :c</body>";
		    }
		  }
		  else
		  {
		    echo "<body>No problems here!</body>";
		  }
		    

		    echo "
		    <div class=\"content\">

			<header><nav class=\"navbar\"></nav></header>

			<article class=\"directions\">
				<button type=\"button\" class=\"makeHeader1\" id=\"redirect\">
					Click here to return to the main menu
				</button>
			</article>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>English (US)</p>
			</footer>

		    </div></html>";
		?>
<!--
	</head>

	<body>
		<div class="content">

			<header><nav class="navbar"></nav></header>

			<article class="directions">
				<button type="button" class="makeHeader1" id="redirect">
					Here's Where It All Begins!
				</button>
			</article>

			<footer>
				<p>Quizard Quest is brought to you by cd msc/</p>
				<p>English (US)</p>
			</footer>

		</div>

	</body>

</html>-->