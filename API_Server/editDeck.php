<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
   include "url.php";
	session_start();
	
   	
   if (isset($_POST['Decks']))
   {
      $deckID = $_POST['Decks'];
      if(!empty($_POST['cardRemove']))
      {
         foreach($_POST['cardRemove'] as $card)
         {
            echo $card;
            delete_card_from_deck($deckID, $card);
         }
      }cardAdd
	  if(!empty($_POST['cardAdd']))
        {
           foreach($_POST['cardAdd'] as $card)
           {
              echo $card;
              add_card_to_deck($deckID, $card);
           }
        }
     }
   header('Location: http://'.$url.'/Quizard-Quest/Website/DeckDisplay.php');

?>
