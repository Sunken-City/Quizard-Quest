/* This is the Javascript for displaying the decks a user has created along with the cards*/
var JSON;

$.post("../API_Server/DeckReview.php", function(data){
	JSON = $.parseJSON(data);
	for( var i = 0, len = JSON.length;  i < len; i++){
		var Deck = document.createElement("option");
		Deck.value = JSON[i].name;
		Deck.innerHTML = JSON[i].name;
		document.getElementById('Decks').appendChild(Deck);
	}		
});

function showDeck(str)
{
	if (str=="")
	  {
		  document.getElementById("Decks").innerHTML="";
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
   	 document.getElementById("cardRemove").innerHTML=xmlhttp.responseText;
  	  }
 	 }
	xmlhttp.open("GET","../API_Server/getDeckCards.php?q="+str,true);
	xmlhttp.send();
}	


