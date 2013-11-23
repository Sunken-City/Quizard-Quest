//JS for supply shop

$(document).ready(function () {

	displaygold();
	loadavatars();

});

function displaygold() {

	var gold;
	var goldDisplay;

	var sendData = {'life':'and death'};

	$.post("../API_Server/supplyShopSetup.php",sendData,function(data) {
		gold = data['gold'];
		goldDisplay = "You have " + gold + " gold";
		$("#displayGold").html(goldDisplay);
	},"json");

	//get avatars from Resources/avatars

}

var avatars = [
	{
		"name": "Blue Quizardess",
		"location": "../Resources/Avatars/Gregina.png",
		"price": "0"
	},
	{
		"name": "Orange Quizardess",
		"location": "../Resources/Avatars/OrangeGregina.png",
		"price": "200"
	},
	{
		"name": "Yellow Quizardess",
		"location": "../Resources/Avatars/YellowGregina.png",
		"price": "500"
	},
	{
		"name": "Green Quizardess",
		"location": "../Resources/Avatars/GreenGregina.png",
		"price": "1000"
	},
	{
		"name": "Red Quizardess",
		"location": "../Resources/Avatars/RedGregina.png",
		"price": "1000"
	},
	{
		"name": "Gray Quizardess",
		"location": "../Resources/Avatars/GrayginaTheGrey.png",
		"price": "1000"
	},
	{
		"name": "White Quizardess",
		"location": "../Resources/Avatars/GrayginaTheWhite.png",
		"price": "1000"
	},
	{
		"name": "Purple Quizardess",
		"location": "../Resources/Avatars/PurpleGregina.png",
		"price": "1000"
	},
	{
		"name": "B+Right Quizardess",
		"location": "../Resources/Avatars/B+Right.png",
		"price": "5000"
	},
	{
		"name": "Green Quizard",
		"location": "../Resources/Avatars/GreenGreg.png",
		"price": "1000"
	},
	{
		"name": "Grey-Haired Quizard",
		"location": "../Resources/Avatars/GregTheGrey.png",
		"price": "500"
	},
	{
		"name": "White Quizard",
		"location": "../Resources/Avatars/GregTheWhite.png",
		"price": "1000"
	},
	{
		"name": "Grey Quizard",
		"location": "../Resources/Avatars/Greyg.png",
		"price": "1000"
	},
	{
		"name": "Grey Grey-Haired Quizard",
		"location": "../Resources/Avatars/GreygTheGrey.png",
		"price": "1000"
	},
	{
		"name": "Beardless Quizard",
		"location": "../Resources/Avatars/Heresy.png",
		"price": "500"
	},
	{
		"name": "Orange Quizard",
		"location": "../Resources/Avatars/OrangeGreg.png",
		"price": "200"
	},
	{
		"name": "Pastel Quizard",
		"location": "../Resources/Avatars/PastelGreg.png",
		"price": "2000"
	},
	{
		"name": "Purple Quizard",
		"location": "../Resources/Avatars/PurpleGreg.png",
		"price": "1000"
	},
	{
		"name": "Red Quizard",
		"location": "../Resources/Avatars/RedGreg.png",
		"price": "1000"
	},
	{
		"name": "Right+B Quizard",
		"location": "../Resources/Avatars/Right+B.png",
		"price": "5000"
	},
	{
		"name": "Royal Quizard",
		"location": "../Resources/Avatars/RoyalGreg.png",
		"price": "10000"
	}
];

function Avatar() {
	var name;
	var location;
	var price;
	var img;
}

var Avatars = [];

function loadavatars() {

	for (var i = 0, len = avatars.length; i < len; i++) {

		var ava = new Avatar();

		ava.name = avatars[i].name;
		ava.location = avatars[i].location;
		ava.price = avatars[i].price;

		ava.img = new Image();
		ava.img.src = ava.location;
		ava.img.onload = makeImageOnloadCallback(ava);
	}
}

function displayavatars() {

	for (var i = 0, len = avatars.length; i < len; i++ ) {

		var td = document.createElement("td");

		td.appendChild(Avatars[i].img);
		$("#theRow").appendChild(td);
	}

}

function makeImageOnloadCallback(ava) {
	return function(e) {
		ava.img = e.target;
		Avatars.push(ava);
	}
}

window.addEventListener('load', function() {
	console.log('window loaded');

	displayavatars();

});