<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/search/search_parser.php,v $
 * $Revision: 1.2 $
 * $Date: 2006/06/27 14:55:36 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

// advanced 
$advanced_where = "glo_approved = '1' AND";
if (isset($_GET['time']) && is_numeric($_GET['time']))
	$advanced_where .= " glo_datestamp ".($_GET['on'] == 'new' ? '>=' : '<=')." '".(time() - $_GET['time'])."' AND";

if (isset($_GET['author']) && $_GET['author'] != '')
	$advanced_where .= " glo_author LIKE '%".$tp -> toDB($_GET['author'])."%' AND";

if (isset($_GET['match']) && $_GET['match'])
	$search_fields	= array('glo_name');
else
	$search_fields	= array('glo_name', 'glo_description');

// basic
$return_fields	= 'glo_id, glo_name, glo_description, glo_author, glo_datestamp';
$weights				= array('1', '0.5');
$no_results			= LAN_198;
$where					= $advanced_where;
$order					= array('glo_name' => DESC);

$ps = $sch -> parsesearch('glossary', $return_fields, $search_fields, $weights, 'search_glossary', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_glossary($row)
{
	global $con;

	$datestamp = $con -> convert_date($row['glo_datestamp'], "long");
	list($uid, $user) = explode(".", $row['glo_author'], 2);
	$userlink = "<a href='".e_BASE."user.php?id.".$uid."'>".$user."</a>";

	$res['link']			= e_PLUGIN."glossary/glossaire.php#word_id_".$row['glo_id'];
	$res['pre_title']	= "";
	$res['title']			= $row['glo_name'];
	$res['summary']		= $row['glo_description'];
	$res['detail']		= LAN_SEARCH_7.$userlink." | ".LAN_SEARCH_8.$datestamp;
	
	return $res;
}

?>