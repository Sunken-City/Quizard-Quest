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
  }
  else
  {
    echo "<body>No problems here!</body>";
  }
    

    echo "</html>";
?>