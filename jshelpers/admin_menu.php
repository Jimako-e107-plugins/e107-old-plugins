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
| $Source: e:\_repository\e107_plugins/jshelpers/admin_menu.php,v $
| $Revision: 1.2 $
| $Date: 2008/03/26 22:41:36 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
global $pageid;

$butname[] = JSHELPER_LAN_ADMIN_PAGE_01;
$butid[]   = JSHELPER_ADMIN_PAGE_01_ID;

$butname[] = JSHELPER_LAN_ADMIN_PAGE_98;
$butid[]   = JSHELPER_ADMIN_PAGE_98_ID;

$butname[] = JSHELPER_LAN_ADMIN_PAGE_99;
$butid[]   = JSHELPER_ADMIN_PAGE_99_ID;

for ($i=0; $i<count($butname); $i++) {
   $var[$butid[$i]]['text'] = $butname[$i];
};

show_admin_menu(JSHELPER_LAN_ADMIN_PAGE_01, $pageid, $var, true);

echo "<br/><div style='text-align:center;'>";
echo "<button class='button' id='jshelper_save_prefs'>".JSHELPER_LAN_ADMIN_05."</button>";
echo "</div>";
?>