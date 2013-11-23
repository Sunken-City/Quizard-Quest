<?
   include "androidAPI.php";
   session_start();
   $deckID = $_POST['deckID'];
   echo json_encode(getDeckCards($deckID));
   
?>
