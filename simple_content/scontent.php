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
| $Source: e:/_repository/e107_plugins/simple_content/scontent.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:51 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}
      

$pref = e107::pref('simple_content'); // returns an array.
                    
// Check global permissions before doing anything
if (!(check_class($pref["simple_content_view_class"]))) {
   // No permissions set, redirect to site front page
   header("location:".e_BASE."index.php");
   exit;
}

// Required files
require_once(e_PLUGIN."simple_content/handlers/scontent_class.php");
require_once(SCONTENTC_HANDLERS_DIR."/scontent_utils.php");

// Generate the page
$page = $SimpleContent->generatePage();
require_once(HEADERF);
echo "<div id='simple_content_main_content'>";
$ns->tablerender($page[0], $page[1]);
echo "</div>";
$footer_js[] = e_PLUGIN_ABS."simple_content/scontent.js";
require_once(FOOTERF);
?>