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
| $Source: e:\_repository\e107_plugins/yellowpages/e_search.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2007/02/07 00:22:10 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include yellowpages handlers
include(e_PLUGIN."yellowpages/handlers/yellowpages_class.php");
$search_info[] = array(
   'sfile'     => e_PLUGIN.'yellowpages/search/yellowpages_search.php',
   'qtype'     => YELP_LAN_YELLOWPAGES,
   'refpage'   => 'yellowpages.php',
	'id'        => 'yellowpages',
   'advanced'  => e_PLUGIN.'yellowpages/search/yellowpages_advanced_search.php',
);
?>
