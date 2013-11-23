<?
   include "API.php";
   session_start();
   
   echo json_encode(get_username());
?>
