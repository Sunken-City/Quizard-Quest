<?
   include "API.php";
   session_start();
   $username = $_GET["u"];
   $value = get_userID($username);
   if ($value == false)
      echo "ERROR: Username does not exist";
   else {
      $_SESSION['userID'] = $value;
      echo "<p> Security Question: ";
      echo get_security_question()."</p>";
      echo "<input id=\"sqAnswer\" type=\"text\" name=\"sqAnswer\"</input>";
   }
?>
