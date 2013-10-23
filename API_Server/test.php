<?php
  include 'API.php';
  //create_user('Pico', 'Riley', 'a@a.a', 'picoriley', '12341234', NULL, NULL, 0);
  $deckID = create_deck('picoriley', 'PicoDeck3');
  echo "<h1> $deckID </h1>";
?>