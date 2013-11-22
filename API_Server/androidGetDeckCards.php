<?
   include "androidAPI.php";
   session_start();
   
   $username = $_POST['username'];
   $deckID = $_POST['deckID'];
   
   $userID = get_userID($username);
   echo json_encode(getDeckCards($userID, $deckID));
   
?>
