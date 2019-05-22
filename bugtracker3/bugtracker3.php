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
| $Source: e:\_repository\e107_plugins/bugtracker3/bugtracker3.php,v $
| $Revision: 1.1.2.3 $
| $Date: 2006/11/27 13:00:13 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

// Check global permissions before doing anything
if (!((ADMIN && $pref["bugtracker3_adminedit"] == 1) || check_class($pref["bugtracker3_globalclass"]))) {
   // No permissions set, redirect to site front page
   header("location:".e_BASE."index.php");
   exit;
}

// Required files
require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_class.php");
require_once(BUGC_HANDLERS_DIR."/bugtracker3_utils.php");

// Generate the page
$page = $bugtracker3->generatePage();
require_once(HEADERF);
echo "<div id='bugtracker3_main_content'>";
$ns->tablerender($page[0], $page[1]);
echo "</div>";
$footer_js[] = e_PLUGIN_ABS."bugtracker3/bugtracker3.js";
require_once(FOOTERF);
?>