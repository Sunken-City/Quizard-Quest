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
			console.log(xmlhttp.responseText , + str);
	  	}
 	}

	xmlhttp.open("GET","../API_Server/getDeckCardsPP.php?q="+str,true); //make calls to the php
	xmlhttp.send();
	
}	


$(document).ready(function() {


	/*\
	|*|		:: >> Fetch the avatar file path from DB << ::
	\*/

	var path;

	$.post("../API_Server/getAvatar.php",function(data) {

		path = data['avatar'];

	});



	$("#avatar").attr("src","path");

	/*\
	|*|		:: >> This function will display the usename << ::
	|*|
	|*|
	\*/


	$.post("../API_Server/getUsername.php", function(data){
		var uname= $.parseJSON(data);
		var username = uname;
		document.getElementById("userName").innerHTML= username;
			
	});
	/*\
	|*|		:: >> This function will pull all the deck names and display them for the user << ::
	|*|
	|*|
	\*/
	$.post("../API_Server/DeckReview.php", function(data){
		JSON = $.parseJSON(data);
		var deckid = "";
		for( var i = 0, len = JSON.length;  i < len; i++){
			var Deck = document.createElement("button");
			Deck.id = "deck"+i;
			Deck.value = JSON[i].deckID;
			Deck.innerHTML = JSON[i].name;
			document.getElementById('profileDecks').appendChild(Deck);			
		}	
		var deckid;
			for( var i = 0, len = JSON.length;  i < len; i++){
	 		   deckid = document.getElementById("deck"+i);
	   		 if (typeof window.addEventListener === 'function'){
  	   		   (function (_deckid) {
  	     	     deckid.addEventListener('click', function(){
  	              showDeck(_deckid.value);
					console.log(_deckid);
  	     	     });
  	   	   })(deckid);
  	 	 }
		}	
		
	});

		
	
	var sendData = {'life':'and death'};
	$.post("../API_Server/supplyShopSetup.php",sendData,function(data) {
        
		var gold;
		var goldDisplay;
		var mathxp;
		var mathdisplay;
		var sciencexp;
		var sciencedisplay;
		var ssxp;
		var ssdisplay;
		var engxp;
		var engdisplay;
		var totxp;
		var totdisplay;
		
		gold = data['gold'];
		goldDisplay = "Total Gold : " + gold ;
		mathxp = data['mathExp'];
		mathdisplay = "Math XP : " + mathxp ;
		sciencexp = data['sciExp'];
		sciencedisplay = "Science XP : " + sciencexp ;
		ssxp = data['ssExp'];
		ssdisplay = "Social Studies XP : " + ssxp ;
		engxp = data['engExp'];
		engdisplay = "English XP : " + engxp ;
		totxp = data['totExp'];
		totdisplay = "Total XP : " + totxp ;

		document.getElementById('displayStats').innerHTML = goldDisplay +"<br>" + mathdisplay +"<br>" + sciencedisplay +"<br>" + ssdisplay +"<br>" + engdisplay + "<br>" + totdisplay;
	},"json");

	
	/*\
	|*|		:: >> This function will display all the cards in the selected deck << ::
	|*|
	|*|
	\*/

});
