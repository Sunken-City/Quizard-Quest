<?
   include "API.php";
   session_start();
   $value = get_userID($_GET['u']);
   if ($value == false)
      echo "ERROR: Username does not exist";
   else {
      $_SESSION['userID'] = $value;
      echo "<p> Security Question: ";
      echo get_security_question()."</p>";
      echo "<input id=\"sqAnswer\" type=\"text\" name=\"sqAnswer\"</input>"
   }
?>
