<!DOCTYPE HTML>

<html lang="en">

  <head>

    <title>Quizard Quest Demo</title>
    <link rel="stylesheet" href="../css/mainStyle.css"/>
    <link rel="stylesheet" href="css/gameStyle.css"/>
    <meta charset="UTF-8">
    <script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type = "text/javascript" src="../js/mainMenu.js"></script>
    <script type = "text/javascript" src="js/requests.js"></script>
    <script type = "text/javascript" src="js/CanvasInput.js"></script>
    <script type="text/javascript" src="js/game.js"></script>
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
    <div class="Game">

      <!-- The canvas for the background -->
      <canvas id="background" width="765" height="666">
	       Your browser does not support canvas. Please try again with a different browser. (Please stop being a part of the IE6 problem!)
      </canvas>
      <!-- The canvas for the monster -->
      <canvas id="monster" width="765" height="666"></canvas>
      <!-- The canvas for the msc things onscreen -->
      <canvas id="etc" width="765" height="666"></canvas>
      <!-- The canvas for the avatar progress bar -->
      <canvas id="avatar" width="765" height="666"></canvas>
      <!-- The canvas for the answer box -->
      <canvas id="input" width="765" height="765"></canvas>
      <div class="lives"><span id="lives"></span></div>
      <div class="time"><span id="time"></span></div>
      <div class="question"><span id="question"></span></div>
      <div class="answer"><span id="answer"></span></div>
      <div class="loading">Loading...<span id = "loading"></div>
      <div class="loadingImage"><span id="loadingImage"></div>

    </div>

    <div id="postGame">

    </div>

  </body>

</html>