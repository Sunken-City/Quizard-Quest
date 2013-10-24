$(document).ready(function() {

	$("#logOut").click(function(e) {

		$.ajax({
			url: "../API_Server/logOut.php",
			success: function () {
				window.location.href = "http://54.200.66.93/Quizard-Quest/Website/";
				//http://54.200.66.93/Quizard-Quest/Website/
			}
		});

	});

	$("#home").click(function(e) {

		window.location.href = "mainMenu.html";

	});

});