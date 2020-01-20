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

if (!defined('e107_INIT')) { exit; }
$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");

//
$bb['name']	      	= "yt";
$bb['onclick']		= "";
$bb['onclick_var']	= LAN_YTM_BB_02;
$bb['icon']             = e_PLUGIN."ytm_gallery/images/bb.png";
$bb['helptext']		= LAN_YTM_BB_01;
$bb['function']		= "";
$bb['function_var']     = "";

// append the bbcode to the default templates if set in the config:

$query  = "SELECT bb_class FROM ".MPREFIX."er_ytm_gallery WHERE id = '1'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
$showcheck = $row['bb_class'];
}

if(check_class($showcheck)) { //hide button if necessary
    $BBCODE_TEMPLATE .= "{BB=yt}";
    $BBCODE_TEMPLATE_NEWSPOST .= "{BB=yt}";
    $BBCODE_TEMPLATE_ADMIN .= "{BB=yt}";
    $BBCODE_TEMPLATE_CPAGE .= "{BB=yt}";
}

$eplug_bb[] = $bb;
?>
