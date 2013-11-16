<?
   include "API.php";
   session_start();
   
   $username = $_POST['username'];
   $deckID = $_POST['deckID'];
   
   $_SESSION['userID'] = get_userID($username);
   return json_encode(getDeckCards($deckID));
   
?>
