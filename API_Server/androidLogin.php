<?
   include "API.php";
   session_start();
   
   $username = $_POST['username'];
   $password = $_POST['password'];
   
   if(validate_password($username, $password)) {
      $userID = get_userID($username);
      return json_encode(get_deck_names($userID));
   }
   else
      return 239;
?>

