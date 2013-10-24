$(document).ready(function() {

	$("#logOut").click(function(e) {

		$.ajax({
			url: "../API_Server/logOut.php"
		});

	});

	$("#home").click(function(e) {

		window.location.href = "mainMenu.html";

	});

});