<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/e_search.php,v $
| $Revision: 1.1.2.1 $
| $Date: 2006/11/11 19:17:40 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include bugtracker handlers
require_once(e_PLUGIN."bugtracker3/handlers/bugtracker3_constants.php");
$search_info[] = array(
   'sfile'     => e_PLUGIN.'bugtracker3/handlers/bugtracker3_search.php',
   'qtype'     => BUG_LAN_BUGTRACKER,
   'refpage'   => 'bugtracker3.php',
	'id'        => 'bugtracker3'
);
?>
