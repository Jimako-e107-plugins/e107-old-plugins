<?php
/*
+---------------------------------------------------------------+
| yellowpages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/yellowpages.php,v $
| $Revision: 1.6.2.1 $
| $Date: 2007/02/07 00:22:10 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

// Check global permissions before doing anything
if (!(check_class($pref["yellowpages_visibility"]))) {
   // No permissions set, redirect to site front page
   header("location:".e_BASE."index.php");
   exit;
}

// Required files
require_once(e_PLUGIN."yellowpages/handlers/yellowpages_class.php");
require_once(YELP_HANDLERS_DIR."/yellowpages_utils.php");

// Generate the page
$page = $yelp->generatePage();
require_once(HEADERF);
echo "<div id='yellowpages_main_content'>";
$ns->tablerender($page[0], $page[1]);
echo "</div>";
$footer_js[] = e_PLUGIN_ABS."yellowpages/yellowpages.js";
require_once(FOOTERF);
?>