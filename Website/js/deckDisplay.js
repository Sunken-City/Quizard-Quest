/* This is the Javascript for displaying the decks a user has created along with the cards*/

var JSON;

/*\
|*|		:: >> Display the Names of the User's decks << ::
\*/

$.post("../API_Server/DeckReview.php", function(data){
	JSON = $.parseJSON(data);
	for( var i = 0, len = JSON.length;  i < len; i++){
		var Deck = document.createElement("option");
		Deck.value = JSON[i].deckID;
		Deck.innerHTML = JSON[i].name;
		document.getElementById('Decks').appendChild(Deck);
	}		
});

/*\
|*|		:: >> Retrieve cards in selected deck << ::
\*/`

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

	xmlhttp.open("GET","../API_Server/getDeckCards.php?q="+str,true); //make calls to the php
	xmlhttp.send();

	getNonDeckCards(str);
	
}	

/*\
|*|		:: >> Retrieve all the user's cards << ::
\*/

function getNonDeckCards(str) {

    if (window.XMLHttpRequest) {
    	// code for IE7+, Firefox, Chrome, Opera, Safari
 	   	var xmlhttp2=new XMLHttpRequest();
	}
	
	xmlhttp2.onreadystatechange=function() {

		if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
   	            document.getElementById("userCards").innerHTML=xmlhttp2.responseText;
  	    }
 	}

	xmlhttp2.open("GET","../API_Server/getNondeckCards.php?q="+str,false);
	xmlhttp2.send();
}

