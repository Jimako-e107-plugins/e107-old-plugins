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

$query_ytm_submit  = "SELECT * FROM ".MPREFIX."er_ytm_gallery_movies WHERE input_status = '0' AND input_way = '2'";

$result_ytm_submit     = mysql_query($query_ytm_submit);
$count_ytm_submit      = mysql_num_rows($result_ytm_submit);

$text .= "
<div style='padding-bottom: 2px;'>
   <img src='".e_PLUGIN."ytm_gallery/images/icon_16.gif'
        style='width:16px; height:16px; vertical-align:bottom' />";

      if ($count_ytm_submit < 1 ) {

$text .= " " . LAN_YTM_SUBM_PREFS_27 . ": $count_ytm_submit";

      }else{

$text .= " <a href='".e_PLUGIN."ytm_gallery/admin_config_submit.php'>" . LAN_YTM_SUBM_PREFS_27 . ":</a> $count_ytm_submit";}

$text .= "</div>";
?>
