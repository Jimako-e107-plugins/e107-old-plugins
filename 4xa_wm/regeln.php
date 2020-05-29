<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v0.9 - by ***RuSsE*** (www.e107.4xA.de)
|	released 28.06.2011
|	sorce: ../../4xa_wm/regeln.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
require_once("languages/".e_LANGUAGE.".php");
$Wtext="<div style='width:100%;text-align:center;'>";
	
$Wtext.="<br/><br/>";	
$Wtext.=$tp->toHTML($pref['4xa_wm_regeln'], TRUE);
	
$Wtext.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>".LAN_4xA_SPORTTIPPS_NAME."</a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";
$title=LAN_4xA_SPORTTIPPS_195;
$ns -> tablerender($title, $Wtext);
require_once(FOOTERF);
//////////////////////   Functionen   /////////////////////////////

?>
