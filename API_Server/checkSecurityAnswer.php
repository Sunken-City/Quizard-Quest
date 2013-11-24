<?
   include "API.php";
   session_start();
   
   $result = check_security_answer($_POST['sqAnswer']);
   
	
	if( $result ){
	echo "Answer is correct";
	$username = $_POST["user"];
    $userid = get_userID($username)['userID'];
	$_SESSION['userID'] = $userid;
	header('Location:http://'.$url.'/Quizard-Quest/Website/resetPassword.php');
	}
	else{
		header('Location:http://'.$url.'/Quizard-Quest/Website/Error.php?err=202');
	}
?>
