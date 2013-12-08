<?
   include "API.php";
   include "url.php";
   session_start();

   $gold = $_POST['gold'];
   $math = $_POST['math'];
   $sci = $_POST['science'];
   $eng = $_POST['english'];
   $lang = $_POST['lang'];
   $soc = $_POST['social'];
   $tot = $_POST['totXP'];

   $oldStats = get_stats_2();

   $_SESSION['gold'] = intval($gold,10) + intval($oldStats['gold'],10);
   $_SESSION['mathExp'] = intval($math,10) + intval($oldStats['mathExp'],10);
   $_SESSION['sciExp'] = intval($sci,10) + intval($oldStats['sciExp'],10);
   $_SESSION['engExp'] = intval($eng,10) + intval($oldStats['engExp'],10);
   $_SESSION['langExp'] = intval($lang,10) + intval($oldStats['langExp'],10);
   $_SESSION['ssExp'] = intval($soc,10) + intval($oldStats['ssExp'],10);
   $_SESSION['totExp'] = intval($tot,10) + intval($oldStats['totExp'],10);
   
   set_stats();
?>
