<?
   include "API.php"
   session_start();
   
   return check_security_answer($_POST['answer']);
?>
