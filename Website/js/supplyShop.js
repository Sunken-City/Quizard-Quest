//JS for supply shop

$(document).ready(function () {

	displaygold();
	loadavatars();

});

var gold;

function displaygold() {

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
		"name": "Blue Quizard",
		"location": "../Resources/Avatars/Greg.png",
		"price": "0"
	},
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
		"name": "Old Quizard",
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
		"name": "Old Grey Quizard",
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
	},
	{
		"name": "Royal Quizardess",
		"location": "../Resources/Avatars/RoyalGregina.png",
		"price": "10000"
	},
	{
		"name": "Elven Quizardess",
		"location": "../Resources/Avatars/RoyalJordina.png",
		"price": "13000"
	},
	{
		"name": "Flag Quizard",
		"location": "../Resources/Avatars/HispanicGreg.png",
		"price": "5000"
	},
	{
		"name": "Quizard Prince",
		"location": "../Resources/Avatars/FrogGreg.png",
		"price": "15000"
	},
	{
		"name": "Ghostly Quizard",
		"location": "../Resources/Avatars/GhostlyGreg.png",
		"price": "15000"
	},
	{
		"name": "Invisible Quizard",
		"location": "../Resources/Avatars/InvisiGreg.png",
		"price": "20000"
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

		var td1 = document.createElement("div");
		td1.setAttribute("class","name");
		var p1 = document.createElement("p");
		var td2 = document.createElement("div");
		td2.setAttribute("class","img");
		var td3 = document.createElement("div");
		td3.setAttribute("class","price");
		var p2 = document.createElement("p");
		var realtd = document.createElement("button");
		realtd.setAttribute("class", "spanner");
		realtd.setAttribute("type","button");

		p1.innerHTML = Avatars[i].name;
		p2.innerHTML = Avatars[i].price;

		td1.appendChild(p1);
		realtd.appendChild(td1);
		td2.appendChild(Avatars[i].img);
		realtd.appendChild(td2);
		td3.appendChild(p2);
		realtd.appendChild(td3);
		document.getElementById("row").appendChild(realtd);
	}

	// var heightChild = $(".spanner").height()*1.5;
	// $("#avatars").css({
	// 	"height":heightChild + "px",
	// });

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

	$(".spanner").click(function (e) {

		$(".clicked").toggleClass("clicked");
		$(this).toggleClass("clicked");

		var priceS = $(".clicked .price p")[0].innerHTML;
		var priceN = parseInt(priceS);
		var goldN = parseInt(gold);

		if (priceN > goldN) {
			var diff = priceN - goldN;
			alert ("You need " + diff + " more gold.");
		} else {

			var newGold =  goldN - priceN;
			var avName = $(".clicked .name p")[0].innerHTML;
			var newPath;

			for (var i = 0, len = Avatars.length; i < len; i++) {

				if (Avatars[i].name === avName) {
					newPath = Avatars[i].location;
					break;
				}

			}
			//alert(newPath);

			//send new data to update the DB
			var sendData = {path:newPath,gold:newGold};

			$.post("../API_Server/updateDBfromShop.php",sendData,function() {
				alert("You have just purchased a new Avatar!");
				window.location.href = "mainMenu.php";
			});			

		}

	});

});

