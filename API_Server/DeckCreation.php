<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
	session_start();
   $deckID = create_deck($name);
   if (isset($_POST['deckSubmit']))
   {
      if(!empty($_POST['flashCard']))
      {
         foreach($_POST['flashCard'] as $card)
         {
            add_card_to_deck($deckID, $card);
         }
      }
   }
?>
