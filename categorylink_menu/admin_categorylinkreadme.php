<?php
/*
+---------------------------------------------------------------+
|        Category Links Menu Plugin by acidfire
|        e107 website system
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_HTTP."index.php"); exit; }
require_once(e_ADMIN."auth.php");
$eLX_dir = e_PLUGIN."categorylink_menu/";
$lan_file = $eLX_dir."language/".e_LANGUAGE.".php";
include(file_exists($lan_file) ? $lan_file : $eLX_dir."language/English.php");
$pageid = "categorylinkreadme";  // unique name that matches the one used in admin_menu.php.
$caption = categorylink_READ_1;
$text = "
".categorylink_READ_2."
<br /><br />
".categorylink_READ_3."
<br /><br />
".categorylink_READ_4."
<br /><br />
".categorylink_READ_5."
<br /><br />
".categorylink_READ_6."
<br /><br />
".categorylink_READ_7."
<br /><br />
".categorylink_READ_8."
<br /><br />
";
$ns->tablerender($caption,$text);
require_once(e_ADMIN."footer.php");
?>
