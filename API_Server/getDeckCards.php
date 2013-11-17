<?php
	$q=$_GET["q"];

	include "API.php";
	session_start();

	$deckCards =  json_encode(get_deck_cards($q));
	$test = json_decode($deckCards);
	$row = count($test);
	for ($count =0; $count < $row; $count++){
		echo "<div class=\"semiCard\">
				<input type=\"checkbox\" value=".$test[$count]->{'cardID'}." name=\"cardRemove[]\"</input>
				<p> Q: ".$test[$count]->{'question'}."<br>";
		echo "A: " . $test[$count]->{'answer'} . "</p>";
		echo "</div>";
	}
?>
