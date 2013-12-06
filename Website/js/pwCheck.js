var password ="";
var pwCheck = "";
var pwText =documemt.getElementById("checkText").innerHTML;

while(true){
	password = document.getElementById("newPW").innerHTML;
	pwCheck = document.getElementById("checkPW").innerHTML;
	if(password != pwCheck){
		pwText = "Password does not match. Please re-enter";
	}
	else{
		pwText = "Password does not match. Please re-enter";
	}
}
