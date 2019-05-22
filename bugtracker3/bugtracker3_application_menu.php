<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/bugtracker3_application_menu.php,v $
| $Revision: 1.1.2.3 $
| $Date: 2006/12/09 19:04:33 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Required files
//require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_class.php");
//require_once(BUGC_HANDLERS_DIR."/bugtracker3_utils.php");

global $bugtracker3;
unset($text);
$text = $bugtracker3->getMenu(BUGC_MENU_APPLICATION);
$text[0] = "<div id='bugtracker3_application_menu_title'>".$text[0]."</div>";
$text[1] = "<div id='bugtracker3_application_menu_content'>".$text[1]."</div>";
$ns->tablerender($text[0], $text[1]);
unset($text);
?>