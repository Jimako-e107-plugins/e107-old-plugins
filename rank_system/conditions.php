<?php
/**
 * $Id: conditions.php,v 1.1 2009/10/22 15:03:36 michiel Exp $
 * 
 * xxx for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 22 okt 2009 - 02:23:53
 * 
 * Revision: $Revision: 1.1 $
 * Last Modified: $Date: 2009/10/22 15:03:36 $
 *
 * Change Log:
 * $Log: conditions.php,v $
 * Revision 1.1  2009/10/22 15:03:36  michiel
 * Implemented customizable conditions
 *
 *  
 */
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . 'rank_system/languages/' . e_LANGUAGE . '.php');

$title = RANKS_01 . ' - ' . RANKS_20;
define('e_PAGETITLE', $title);
require_once(HEADERF);
require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');

global $sql, $tp;
//if (!$rank_obj) {
//	$rank_obj = new rank;
//}

if (file_exists(THEME."ranks_template.php")) {
	require_once(THEME."ranks_template.php");
} else {
	require_once(e_PLUGIN."rank_system/templates/ranks_template.php");
}
require_once(e_PLUGIN.'rank_system/includes/rank_system_shortcodes.php');

$rank_tmp = explode('.', e_QUERY);
$show_id = intval($rank_tmp[0]);
//$rank_acValue = intval($rank_tmp[1]);
$content = '';


if ($rank_action == '') {
	$content .= $tp->parsetemplate($RANK_CONDITIONS_HEADER, true, $rank_shortcodes);
	$content .= "<div id='rank_condit' style='width:100%'>";
	
	$condTabs = "";
	$sql->db_Select("rank_condition", "condit_id, condit_name, condit_descript", "condit_enabled = 'T' order by condit_order");
	$condList = $sql->db_getList();

	$tid = 0;
	foreach ($condList as $cond) {
		extract($cond);
		$condTabs .= "'" . $tp->toHTML($condit_name) . "',";
		$condinx[$condit_id] = $tid++;
		$condPage[$condit_id] = $condit_name;
		$tabcont[$condit_name] = $tp->parseTemplate($RANK_CONDITIONS_PAGE, true, $rank_shortcodes);
	}
	$condTabs = substr($condTabs, 0, -1);
	
	foreach($condPage as $page) {
		$row = $tabcont[$page];
		if (empty($row)) {
			$row = "";
		}
		$content .= '<div class="dhtmlgoodies_aTab">' . $row . '</div>';
	}
	
	$content .= "</div>";
	$content .= $tp->parsetemplate($RANK_CONDITIONS_FOOTER, true, $rank_shortcodes);
	
	$content .= '
		<script type="text/javascript">
			var tabviewfolder="' . SITEURL . $PLUGINS_DIRECTORY . 'rank_system/includes/tabview/"
			initTabs(\'rank_condit\',Array(' . $condTabs . '),0,\'100%\',\'\');
	';
	if ($show_id > 0) {
		$content .= 'showTab(\'rank_condit\',\''. $condinx[$show_id].'\');';
	}
	$content .= '
		</script>';
}


$menu = $tp->parsetemplate($RANK_MENU, true, $rank_shortcodes);
$ns->tablerender($menu, $content);

require_once(FOOTERF);

?>