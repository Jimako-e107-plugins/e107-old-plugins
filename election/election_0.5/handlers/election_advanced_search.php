<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: e:\_repository\e107_plugins/election/handlers/election_advanced_search.php,v $
|     $Revision: 1.1 $
|     $Date: 2006/12/31 18:42:46 $
|     $Author: Neil $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

require_once(e_PLUGIN."election/handlers/election_class.php");

$advanced_caption['id'] = 'election';
$advanced_caption['title']['all'] = ELEC_LAN_ELECTION;

$advanced['election']['type'] = 'dropdown';
$advanced['election']['text'] = ELEC_LAN_SEARCH_ELECTION.':';
$advanced['election']['list'][] = array('id' => 'all', 'title' => ELEC_LAN_SEARCH_ELECTION_ALL);

$elecdao = $elec->getDAO();
$electionlist = $elecdao->getElectionList();
foreach ($electionlist as $elecapp) {
   $advanced['election']['list'][] = array('id' => $elecapp->getId(), 'title' => $elecapp->getName());
	$advanced_caption['title'][$elecapp->getId()] = $elecapp->getName();
}

//$advanced['match']['type'] = 'dropdown';
//$advanced['match']['text'] = BUG_LAN_LABEL_SEARCH_MATCH_IN.':';
//$advanced['match']['list'][] = array('id' => 0, 'title' => BUG_LAN_LABEL_SEARCH_MATCH_IN_ALL);
//$advanced['match']['list'][] = array('id' => 1, 'title' => BUG_LAN_LABEL_SEARCH_MATCH_IN_TITLE);

?>