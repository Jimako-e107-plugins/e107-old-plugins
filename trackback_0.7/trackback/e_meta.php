<?php
/*
+ ----------------------------------------------------------------------------------------------+
|     e107 website system  : http://e107.org
|     Steve Dunstan 2001-2002 : jalist@e107.org
|     Released under the terms and conditions of the GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/trackback/e_meta.php $
|     $Revision: 11678 $
|     $Id: e_meta.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+-----------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

if(isset($pref['trackbackEnabled'])){
	echo "<link rel='pingback' href='".SITEURLBASE.e_PLUGIN_ABS."trackback/trackback.php' />";
}

?>