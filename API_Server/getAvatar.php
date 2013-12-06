<?
   include "API.php";
   session_start();
   
   $result = get_options();
   $avatar = array("avatar" => $result['avatar']);

   echo json_encode($avatar);

?>
