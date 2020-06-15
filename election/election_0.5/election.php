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
| $Source: e:\_repository\e107_plugins/election/election.php,v $
| $Revision: 1.1 $
| $Date: 2006/12/31 16:01:19 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

// Check global permissions before doing anything
if (!(check_class($pref["election_view_class"]))) {
   // No permissions set, redirect to site front page
   header("location:".e_BASE."index.php");
   exit;
}

// Required files
require_once(e_PLUGIN."election/handlers/election_class.php");
require_once(ELECC_HANDLERS_DIR."/election_utils.php");

// Generate the page
$page = $elec->generatePage();
require_once(HEADERF);
echo "<div id='election_main_content'>";
$ns->tablerender($page[0], $page[1]);
echo "</div>";
$footer_js[] = e_PLUGIN_ABS."election/election.js";
require_once(FOOTERF);
?>