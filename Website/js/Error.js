/*\
|*|		Javascript for the Error.php
\*/

$(document).ready(function() {
	$("#redirect").click(function (e) {
		$.post("../API_Server/ajaxurl.php",function (url) {
			window.location.href = "http://" + url + "/Quizard-Quest/Website/";
		},"json");
	});
});
