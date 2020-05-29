<?
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/help.php
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
global $helpcapt,$helptext;
        $text2 = "";
    for ($i=0; $i<count($helpcapt); $i++) {
        $text2 .="<b>".$helpcapt[$i]."</b><br />";
        $text2 .=$helptext[$i]."<br /><br />";
    };
$ns -> tablerender($helptitle, $text2);
?>
