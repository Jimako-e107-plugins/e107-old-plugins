<?
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Ricardo Uceda 2007
|     http://www.ion-labs.com
|     ionlabs@gmail.com
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: e107_plugins/quick_news/admin_menu.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

$menutitle = QUICKNEWS_CFG01;

$butname[] = QUICKNEWS_CFG02;
$butlink[] = "admin_config.php";
$butid[]   = "viewnews";

$butname[] = QUICKNEWS_CFG03;
$butlink[] = "admin_addqnews.php";
$butid[]   = "addnews";

$butname[] = QUICKNEWS_CFG04;
$butlink[] = "admin_prefs.php";
$butid[]   = "config";

$butname[] = QUICKNEWS_CFG05;
$butlink[] = "admin_readme.php";
$butid[]   = "readme";

global $pageid;
for ($i=0; $i<count($butname); $i++) {
	$var[$butid[$i]]['text'] = $butname[$i];
	$var[$butid[$i]]['link'] = $butlink[$i];
};

show_admin_menu($menutitle, $pageid, $var);
?>
