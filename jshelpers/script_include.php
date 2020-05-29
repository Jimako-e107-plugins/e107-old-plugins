<?php
/*
+---------------------------------------------------------------+
| JSHelper by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/jshelpers/script_include.php,v $
| $Revision: 1.1 $
| $Date: 2007/10/21 12:43:08 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
if (!defined("e107_INIT")) {
   exit;
}

$jshelper_path = e_PLUGIN."jshelpers/";

echo '<!-- JSHelper -->
		<script src='".$jshelper_path."prototype/prototype.js' type='text/javascript'></script>
		<script src='".$jshelper_path."scriptaculous-js/src/scriptaculous.js' type='text/javascript'></script>
';
?>