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
|     $Source: e107_plugins/quick_news/admin_readme.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");

// Check current user is an admin, redirect to main site if not
if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}

require_once(e_ADMIN."auth.php");

$ns->tablerender(QUICKNEWS_HLP01, QUICKNEWS_HLP02);

require_once(e_ADMIN."footer.php");
?>
