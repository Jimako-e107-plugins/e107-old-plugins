<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/e107helpers_developer.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:06 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}


// Required files
require_once(e_PLUGIN."e107helpers_developer/handlers/e107helpers_developer_class.php");
require_once(EHDC_HANDLERS_DIR."/e107helpers_developer_utils.php");

// Generate the page
$page = $helperdev->getMainPage();
require_once(HEADERF);
echo "<div id='helperdev_main_content'>";
$ns->tablerender($page[0], $page[1]);
echo "</div>";
$footer_js[] = EHDC_PLUGIN_DIR."/e107helpers_developer.js";
require_once(FOOTERF);
?>