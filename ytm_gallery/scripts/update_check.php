<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

include "parse_xml.php";

      $query18             = "SELECT version from ".MPREFIX."er_ytm_gallery WHERE id = '1'";
      $result18            = mysql_query($query18);
      $row18               = mysql_fetch_array($result18,MYSQL_ASSOC);
      $ytm_current_version = $row18['version'];

// Creating feed
$up_feed       = "http://www.radstake.deds.nl/extern/plugin_dev/versioncheck/ytm_gallery/ytm_gallery.xml";

// Test if feed contains information
$xml = file_get_contents("$up_feed");
$parser = new XMLParser($xml);
$parser->Parse();
$up_check =      ($parser->document->plugin[0]->details[0]->version[0]->tagData);
if ($up_check == "") {
$check = "0";
}else{
$check = "1";
}

$text .= "<br />";

if ($check == "1") {

      $xml = file_get_contents("$up_feed");
      $parser = new XMLParser($xml);
      $parser->Parse();


        $ytm_version  =      ($parser->document->plugin[0]->details[0]->version[0]->tagData);
        $ytm_changes  =      ($parser->document->plugin[0]->details[0]->changes[0]->tagData);
        $ytm_url      =      ($parser->document->plugin[0]->details[0]->url[0]->tagData);

        $ytm_changes  = str_replace ("ERGIVEENTER","<br />",$ytm_changes);
        
        if ($ytm_version <> $ytm_current_version) {
        
             $text .= "" . LAN_YTM_UPDATE_PREFS_3 . "<br /><br />";
             $text .= $ytm_changes;
             $text .= "<br /><br />";
             $text .= "<input type='button' value='" . LAN_YTM_UPDATE_PREFS_2 . "' class='button' onClick=\"parent.location='$ytm_url'\">";

        }else{

        $text .= LAN_YTM_UPDATE_PREFS_1;
        
        }
	    
}else{
$text .= LAN_YTM_UPDATE_PREFS_0;}
?>
