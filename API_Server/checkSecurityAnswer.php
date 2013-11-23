<?
   include "API.php"

   session_start();
   
   $result = check_security_answer($_POST['sqAnswer']);
	
	if( $result ){
	echo "Answer is correct";
	}
	else{
		echo "Answer is incorrect";
	}
?>
