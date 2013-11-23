<?
   include "androidAPI.php";
   session_start();
   $SdeckID = $_POST['deckID'];
   $deckID = int inval(mixed $SdeckID, $base = 10);
   echo json_encode(getDeckCards($deckID));
   
?>
