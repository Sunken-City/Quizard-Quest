/*\
|*|		Javascript for the mainMenu.php
\*/
function showDeck(str) {

	if (str=="") {
		  return;
	} 

	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
 		 var xmlhttp=new XMLHttpRequest();
	}

	xmlhttp.onreadystatechange=function() {

	  	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	   		document.getElementById("deckCards").innerHTML=xmlhttp.responseText;//directly puts the code that is generated in the php as html for deckcards
	  	}
 	}

	xmlhttp.open("GET","../API_Server/getDeckCardsPP.php?q="+str,true); //make calls to the php
	xmlhttp.send();
	
}	

$(document).ready(function() {
	

	/*\
	|*|		:: >> This function will pull all the deck names and display them for the user << ::
	|*|
	|*|
	\*/
	$.post("../API_Server/DeckReview.php", function(data){
	JSON = $.parseJSON(data);
		for( var i = 0, len = JSON.length;  i < len; i++){
			var Deck = document.createElement("button");
			Deck.id = "deck"+i;
			Deck.value = JSON[i].deckID;
			Deck.innerHTML = JSON[i].name;
			document.getElementById('profileDecks').appendChild(Deck);
			$["deck"+i].click(function(e){
					showDeck(Deck.value);
			});
		}		
	});

	/*\
	|*|		:: >> This function will display all the cards in the selected deck << ::
	|*|
	|*|
	\*/

});
