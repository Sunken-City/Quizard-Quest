<?
   include "API.php";
   session_start();
   
   $result = check_security_answer($_POST['password']);	
   reset_password($result) ;
   session_destroy();
   header('Location:http://'.$url.'/Quizard-Quest/Website/passwordChanged.php');
   

?>
