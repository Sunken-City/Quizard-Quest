<?
   include "androidAPI.php";
   session_start();
   $SdeckID = $_POST['deckID'];
   $deckID = intval($SdeckID);
   echo json_encode(getDeckCards($deckID));
   
?>
