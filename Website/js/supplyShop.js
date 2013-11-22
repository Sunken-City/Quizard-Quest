//JS for supply shop

$(document).ready(function () {

	display();

});

function display() {

	var gold;

	var sendData = {'life':'and death'};

	$.post("../API_Server/supplyShopSetup.php",sendData,function(data) {
		gold = data['gold'];
	},"json");

	var goldDisplay = "You have " + gold + " gold";

	$("#displayGold").html(goldDisplay);

}