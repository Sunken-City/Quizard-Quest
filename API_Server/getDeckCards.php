<?php
   $q=$_GET["q"];

	include "API.php";
	session_start();
	
	$test =  get_deck_cards($q);
	$row = count($test);
	for ($count =0; $count < $row; $count++){
		echo "<div class=\"semiCard\">
				<input type=\"checkbox\" value=".$test[$count]->{'cardID'}." name=\"cardRemove[]\"</input>
				<p> Q: ".$test[$count]->{'question'}."<br>";
		echo "A: " . $test[$count]->{'answer'} . "</p>";
		echo "</div>";
	}
?>
