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
| $Source: e:/_repository/e107_plugins/simple_content/e_search.php,v $
| $Revision: 1.1 $
| $Date: 2008/05/26 23:14:51 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include simple_content handlers
require_once(e_PLUGIN."simple_content/handlers/scontent_constants.php");
global $pref;
$search_info[] = array(
   'sfile'     => e_PLUGIN.'simple_content/search/search.php',
   'qtype'     => $pref['simple_content_pagetitle'],
   'refpage'   => 'scontent.php',
	'id'        => 'scontent',
   'advanced'  => e_PLUGIN.'simple_content/search/advanced.php',
);
?>