<?
   include "API.php"
   session_start();
   
   return check_security_answer($_GET['a']);
?>
