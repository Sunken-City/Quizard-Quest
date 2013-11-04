<?php
   $q=$_GET["q"];

	include "API.php";
	session_start();
	//file_put_contents($file, $category);
        $test =  json_encode(get_deck_cards($q));
	$test = json_decode($deckCards);
	$row = count($test);
	for ($count =0; $count < $row; $count++){
		echo $test[$count]->{'question'};
	}
?>
