<?
   include "API.php";
   session_start();
   $username = $_GET["q"];
   echo $username."</br>";
   $value = get_userID($username)['userID'];
   if ($value == false)
      echo "ERROR: Username does not exist";
   else {
      $_SESSION['userID'] = $value;
      $qIDHolder = get_security_question();
	  $qID = $qIDHolder['questionID']; 
      echo "<p>Security Question: ";
      
      if ($qID == 1){
         echo "What is your mother's maiden name?</p>";
		 echo "<input id=\"sqAnswer\" type=\"text\" name=\"sqAnswer\"</input>";
		 echo "<input class=\"submitButton\" type=\"submit\" value=\"Submit Answer\" id=\"signUp\" />";
      }
      else if($qID == 2){
         echo "Who is your favorite grade school teacher?</p>";
		 echo "<input id=\"sqAnswer\" type=\"text\" name=\"sqAnswer\"</input>";
		 echo "<input class=\"submitButton\" type=\"submit\" value=\"Submit Answer\" id=\"signUp\" />";
      }
      else if($qID == 3){
         echo "What is your dream car?</p>";	
		 echo "<input id=\"sqAnswer\" type=\"text\" name=\"sqAnswer\"</input>";
 		 echo "<input class=\"submitButton\" type=\"submit\" value=\"Submit Answer\" id=\"signUp\" />";
      }
      else {
         echo "ERROR: Security question not found!</p>";
      }
      
   }
?>
