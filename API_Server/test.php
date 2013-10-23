<?php
  include 'API.php';
  create_user('Pico', 'Riley', 'a@a.a', 'picoriley', '12341234', NULL, NULL, 0);
  $deckID = create_deck('Pico', 'PicoDeck');
  echo "<h1> $deckID </h1>";
?>