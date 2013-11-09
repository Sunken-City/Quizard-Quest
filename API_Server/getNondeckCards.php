<?php
   $q=$_GET["q"];

	include "API.php";
	session_start();
	//file_put_contents($file, $category);
        $deckCards =  json_encode(get_non_deck_cards($q));
	$test = json_decode($deckCards);
	$row = count($test);
	for ($count =0; $count < $row; $count++){
		echo "<div class=\"semiCard\">Q: ".$test[$count]->{'question'}."<br>";
		echo "A: " . $test[$count]->{'answer'};
		echo "<input type=\"checkbox\" value=".$test[$count]->{'cardID'}." name=\"cardAdd[]\"</input></div>";
	}
?>
