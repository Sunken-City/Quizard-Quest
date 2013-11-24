<?
   include "API.php";
   session_start();
   
   $result = $_POST['password'];	
   reset_password($result) ;
   session_destroy();
   header('Location:http://'.$url.'/Quizard-Quest/Website/passwordChanged.php');
   

?>
