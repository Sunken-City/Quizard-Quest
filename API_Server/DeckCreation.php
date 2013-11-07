<?php

	/*\
	|*|		#PHP that receives create card data from cardCreation.html
	|*|			and sends it to the API server for submission
	\*/

	include "API.php";
   include "url.php";
	session_start();
	
   $failure;

   if (isset($_POST['checkNameFirst'])) {

      if ($_POST['checkNameFirst']) {

         $deckID = create_deck($_POST['Deckname']);

         if ($deckID === false) {

            $failure = array('success' => false);
            echo json_encode($failure);

         } else {

            $failure = array('success' => true);
            echo json_encode($failure); 
         }

      } else {

         if (isset($_POST['Deckname'])) {

            $deckID = create_deck($_POST['Deckname']);

            if(!empty($_POST['flashCard'])) {

               foreach($_POST['flashCard'] as $card) {

                  echo $card;
                  add_card_to_deck($deckID, $card);
               }
            }
         }

      }
   }
   	
   // if (isset($_POST['Deckname'])) {
   //    $deckID = create_deck($_POST['Deckname']);

   //    if ($deckID === false) {

   //       $failure = array('success' => false);
   //       echo json_encode($failure);
   //       return false;

   //    } else {

   //       if(!empty($_POST['flashCard'])) {

   //          foreach($_POST['flashCard'] as $card) {

   //             echo $card;
   //             add_card_to_deck($deckID, $card);
   //          }
   //       }
   //    }
   // }

?>
