<?
   include "androidAPI.php";
   session_start();
   
   $username = $_POST['username'];
   $password = $_POST['password'];
   
   if(validate_password($username, $password)) {
      $_SESSION['userID'] = get_userID($username);
      echo json_encode(get_deck_names());
   }
   else
      echo "239";
?>

