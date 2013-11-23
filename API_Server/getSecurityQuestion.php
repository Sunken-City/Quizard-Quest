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
      $qID = get_security_question(); 
      echo "<p> Security Question: ";
      
      if ($qID == 1)
         echo "What is your mother's maiden name?</p>";
      
      else if($qID == 2)
         echo "Who is your favorite grade school teacher?</p>";
      
      else if($qID == 3)
         echo "What is your dream car?</p>";
      
      else
         echo "ERROR: Security question not found!</p>";
      
      echo "<input id=\"sqAnswer\" type=\"text\" name=\"sqAnswer\"</input>";
   }
?>
