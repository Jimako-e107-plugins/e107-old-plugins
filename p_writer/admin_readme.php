<?php
/*
+------------------------------------------------------------------------------+
|  P_Writer - a plugin by Paul Kater
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
require_once('../../class2.php');
require_once(e_ADMIN."auth.php");
if (!defined('e107_INIT')) { exit(); }

// Check to see if the current user has admin permissions for this plugin
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

include_lan(e_PLUGIN.'/p_writer/languages/'.e_LANGUAGE.'.php');

$eplug_admin = true;
$pageid = 'admin_menu_99';

$filename = PGEN_02;
$text = file_get_contents(strtolower($filename));
$text = $tp->toHTML($text, TRUE);


$title = PADMENU_99;
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");

?>

