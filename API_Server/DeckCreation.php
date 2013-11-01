<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
	session_start();
	
   	
   if (isset($_POST['Deckname']))
   {
      $deckID = create_deck($_POST['Deckname']);
      if(!empty($_POST['flashCard']))
      {
         foreach($_POST['flashCard'] as $card)
         {
            echo $card;
            add_card_to_deck($deckID, $card);
         }
      }
   }
   header("Location: http://54.200.66.93/Quizard-Quest/Website/mainMenu.php");
?>
