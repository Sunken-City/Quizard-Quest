
$(document).ready(function(){

	$("#getSecurity").click(function(e){
      
		var str = $("#user").val();
		console.Log(str);
			if (str=="") {
			  return;
	    	} 

		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
 			 var xmlhttp=new XMLHttpRequest();
		}
	
		xmlhttp.onreadystatechange=function() {

	 	 	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	 	  		document.getElementById("securityQuestion").innerHTML=xmlhttp.responseText;//directly puts the code that is generated in the php as html for deckcards
	  		}
 		}

		xmlhttp.open("GET","../API_Server/getSecurityQuestion.php?q="+str,true); //make calls to the php
		xmlhttp.send();
		e.preventDefault();
		
	});

});
