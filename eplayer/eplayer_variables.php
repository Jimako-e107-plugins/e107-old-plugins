<?php
/*
+---------------------------------------------------------------+
| ePlayer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/eplayer_variables.php,v $
| $Revision: 1.19 $
| $Date: 2007/01/24 00:11:25 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
   define("EPLAYER_LAN_NAME", "ePlayer");
   define("EPLAYER_LAN_VER",  "1.91_rc4");

// Include the e107 Helper classes
if (file_exists(e_PLUGIN."e107helpers/e107Helper.php")) {
   $e107HelperIncludeJS = false;
   $incDHTMLCalendarJS = true;
   require_once(e_PLUGIN."e107helpers/e107Helper.php");
} else {
   print "<h1>Fatal error, cannot find e107Helper class.</h1>";
   print "<p>This plugin requires <b>The e107 Helper Project</b> plugin to be installed.</p>";
   print "<p>Please download it from <a href='http://e107coders.org'>http://e107coders.org</a> and try this plugin again.</p>";
   exit;
}

include_lan(e_PLUGIN."eplayer/language/".e_LANGUAGE.".php");

// ePlayer constants
define("EPLAYER_TABLE",          "eplayer");
define("EPLAYER_CATEGORY_TABLE", "eplayer_category");
?>