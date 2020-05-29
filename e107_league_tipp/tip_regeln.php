<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/regeln.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/regeln.php");

// ============= START OF THE BODY ====================================

$text = LAN_LEAGUE_TIP_REGELN;

switch ($pref['league_tipp_user_acc']) {
			case "1":
					$Zeit=LAN_LEAGUE_TIP_REGELN5;
          break;	
	
				case "5":
					$Zeit=LAN_LEAGUE_TIP_REGELN6;
          break;	
          
				case "10":
					$Zeit=LAN_LEAGUE_TIP_REGELN7;
          break;	
          
        case "30":
					$Zeit=LAN_LEAGUE_TIP_REGELN8;
          break;
        
         case "60":
					$Zeit=LAN_LEAGUE_TIP_REGELN9;
          break;
          
         case "120":
					$Zeit=LAN_LEAGUE_TIP_REGELN10;
          break;
			}
$text .=$Zeit;
$text .=LAN_LEAGUE_TIP_REGELN2;

$text .="<div style='width:100%; text-align:center;'><br/><br/><form method='get' action='league_tipp_login.php' id='back'><input class='button' type='submit' name='back' value='".LAN_LEAGUE_TIP_REGELN3."' /></form>";
$text .="<br/><br/>
				<div class='smalltext' style='width:100%; text-align: center;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='besuche mich'>e107 LIGA-TIPP</a> - Version 1.5 ::</div>
				<br/>
				</div>";	
        $title = LAN_LEAGUE_TIP_REGELN4;
        
        $ns -> tablerender($title, $text);


require_once(FOOTERF);
?>