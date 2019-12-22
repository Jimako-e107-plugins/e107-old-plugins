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
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/chatbox2/search/search_parser.php,v $
|     $Revision: 1.3 $
|     $Date: 2006/01/05 09:06:46 $
|     $Author: sweetas $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

$cb_count =  $sql -> db_Count('chatbox');

// advanced
$advanced_where = "";
if (isset($_GET['time']) && is_numeric($_GET['time'])) {
	$advanced_where .= " cb2_datestamp ".($_GET['on'] == 'new' ? '>=' : '<=')." '".(time() - $_GET['time'])."' AND";
}

if (isset($_GET['author']) && $_GET['author'] != '') {
	$advanced_where .= " cb2_nick LIKE '%".$tp -> toDB($_GET['author'])."%' AND";
}

// basic
$return_fields = 'cb2_id, cb2_nick, cb2_message, cb2_datestamp';
$search_fields = array('cb2_nick', 'cb2_message');
$weights = array('1', '1');
$no_results = LAN_198;
$where = $advanced_where;
$order = array('cb2_datestamp' => DESC);

$ps = $sch -> parsesearch('chatbox2', $return_fields, $search_fields, $weights, 'search_chatbox2', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_chatbox2($row) {
	global $con, $cb_count;
	preg_match("/([0-9]+)\.(.*)/", $row['cb2_nick'], $user);
	$res['link'] = e_PLUGIN."chatbox2/chat.php?".$row['cb2_id'].".fs";
	$res['pre_title'] = LAN_SEARCH_7;
	$res['title'] = $user[2];
	$res['summary'] = $row['cb2_message'];
	$res['detail'] = $con -> convert_date($row['cb2_datestamp'], "long");
	return $res;
}

?>