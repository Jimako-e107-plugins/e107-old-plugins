<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
$eplug_admin = true;
require_once('../../class2.php');
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }
require_once(e_ADMIN.'auth.php');
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');
$pageid = 'admin_menu_09';

$filename = EG_ADMIN_HELP_99;
$text = file_get_contents(strtolower($filename));
$text = $tp->toHTML($text, TRUE);

$caption = EG_ADMIN_HELP_07;
$ns->tablerender($caption, $text);
require_once(e_ADMIN.'footer.php');
?>