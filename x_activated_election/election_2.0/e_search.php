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
| $Source: e:\_repository\e107_plugins/election/e_search.php,v $
| $Revision: 1.2 $
| $Date: 2006/12/31 18:41:25 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Include election handlers
require_once(e_PLUGIN."election/handlers/election_constants.php");
$search_info[] = array(
   'sfile'     => e_PLUGIN.'election/handlers/election_search.php',
   'qtype'     => ELEC_LAN_ELECTION,
   'refpage'   => 'election.php',
	'id'        => 'election',
   'advanced'  => e_PLUGIN.'election/handlers/election_advanced_search.php',
);

