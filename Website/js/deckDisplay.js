/* This is the Javascript for displaying the decks a user has created along with the cards*/
var JSON;

$.post("../API_Server/DeckReview.php", function(data){
	JSON = $.parseJSON(data);
	for( var i = 0, len = JSON.length;  i < len; i++){
		var Deck = document.createElement("option");
		Deck.value = JSON[i].deckID;
		Deck.innerHTML = JSON[i].name;
		document.getElementById('Decks').appendChild(Deck);
	}		
});

function showDeck(str)
{
	if (str=="")
	  {
		  return;
	  } 
	if (window.XMLHttpRequest)
 	 {// code for IE7+, Firefox, Chrome, Opera, Safari
 		 xmlhttp=new XMLHttpRequest();
	  }
	xmlhttp.onreadystatechange=function()
  	{
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
   	 {
   	 document.getElementById("deckCards").innerHTML=xmlhttp.responseText;
  	  }
 	 }
	xmlhttp.open("GET","../API_Server/getDeckCards.php?q="+str,true);
	xmlhttp.send();

	getNonDeckCards();
	
}	
function getNonDeckCards(str)
{

    if (window.XMLHttpRequest)
 	    {// code for IE7+, Firefox, Chrome, Opera, Safari
 	    	 xmlhttp2=new XMLHttpRequest();
	    }
	    xmlhttp2.onreadystatechange=function()
  	    {
  	        if (xmlhttp2.readyState==4 && xmlhttp.status==200)
   	        {
   	            document.getElementById("userCards").innerHTML=xmlhttp2.responseText;
  	        }
 	    }
	xmlhttp2.open("GET","../API_Server/getNondeckCards.php?q="+str,true);
	xmlhttp2.send();
}

