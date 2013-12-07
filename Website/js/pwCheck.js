var password ="";
var pwCheck = "";
var pwText
function pwMatch(){

	pwText = document.getElementById("checkText");
	password = document.getElementById("newPW");
	pwCheck = document.getElementById("checkPW");
	var subButton = document.getElementById("changePW");
	if(password.value != pwCheck.value){
		pwText.innerHTML = "Passwords do not match. Please re-enter";
		subButton.disabled = false;
	}
	else{
		pwText.innerHTML = "Passwords match";
		subButton.disabled = true;
	}
}
