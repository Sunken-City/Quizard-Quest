<?
   include "API.php";
   include "url.php";
   session_start();
   
   set_stats();
   header('Location:http://'.$url.'/Quizard-Quest/Website/mainMenu.php');
?>
