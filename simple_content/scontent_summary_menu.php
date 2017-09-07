<?php
/*
+---------------------------------------------------------------+
| SimpleContent by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:/_repository/e107_plugins/simple_content/scontent_summary_menu.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:52 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Required files
require_once(e_PLUGIN."simple_content/handlers/simple_content_class.php");
require_once(SCONTENTC_HANDLERS_DIR."/simple_content_utils.php");

global $SimpleContent, $e107Helper;
unset($text);
$text = $SimpleContent->getMenu();
$text[1] = "<div id='simple_content_summary_menu_content'>".$text[1]."</div>";
$text[1] .= $e107Helper->getHeaderFiles();
$ns->tablerender($text[0], $text[1]);
unset($text);
?>