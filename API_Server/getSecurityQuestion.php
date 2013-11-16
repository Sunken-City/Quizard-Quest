<?
   include "API.php";
   session_start();
   $_SESSION['userID'] = get_userID($_POST['username']);
   return get_security_question();
?>
