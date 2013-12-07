<?
   include "API.php";
   session_start();
   
   $result = get_options()['avatar'];
   $avatar = array("avatar" => $result);

   echo json_encode($avatar);

?>
