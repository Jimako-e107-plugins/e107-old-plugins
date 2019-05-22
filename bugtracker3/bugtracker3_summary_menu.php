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
| $Source: e:\_repository\e107_plugins/bugtracker3/bugtracker3_summary_menu.php,v $
| $Revision: 1.1.2.2 $
| $Date: 2006/11/27 18:00:52 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Required files
require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_class.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_utils.php");

global $bugtracker3;
unset($text);
$text = $bugtracker3->getMenu();
$text[1] = "<div id='bugtracker3_summary_menu_content'>".$text[1]."</div>";
$ns->tablerender($text[0], $text[1]);
unset($text);
?>