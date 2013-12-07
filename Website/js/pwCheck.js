var password ="";
var pwCheck = "";
var pwText
function pwMatch(){
	pwText =documemt.getElementById("checkText").innerHTML;

	password = document.getElementById("newPW").innerHTML;
	pwCheck = document.getElementById("checkPW").innerHTML;
	var subButton = document.getElementById("changePW");
	if(password != pwCheck){
		pwText = "Passwords do not match. Please re-enter";
		subButton.disabled = false;
	}
	else{
		pwText = "Passwords match";
		subButton.disabled = true;
	}
}
