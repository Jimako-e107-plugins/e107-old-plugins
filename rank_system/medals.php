<?php
/**
 * $Id: medals.php,v 1.4 2009/10/22 14:59:57 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.4 $
 * Last Modified: $Date: 2009/10/22 14:59:57 $
 *
 * Change Log:
 * $Log: medals.php,v $
 * Revision 1.4  2009/10/22 14:59:57  michiel
 * Ordered overview in tabs and using cache
 *
 * Revision 1.3  2009/07/14 19:29:01  michiel
 * CVS Merge
 *
 * Revision 1.2.2.1  2009/07/13 21:54:08  michiel
 * - using own css style
 * - integrated deprecated rankshow_class into template/shortcode
 *
 * Revision 1.2  2009/06/28 15:05:51  michiel
 * Merged from dev_01_03
 *
 * Revision 1.1.4.1  2009/06/28 02:33:43  michiel
 * Rank System links on rank, medal and recommendation pages
 *
 * Revision 1.1  2009/03/28 13:01:39  michiel
 * Initial CVS revision
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

$title = RANKS_MED_01;
define('e_PAGETITLE', $title);
require_once(HEADERF);
require_once(e_PLUGIN . 'rank_system/includes/medal_class.php');

global $sql, $RANK_PREF, $medal_obj, $e107cache;
if (!$medal_obj) {
	$medal_obj = new medal;
}

if (file_exists(THEME."ranks_template.php"))
{
	require_once(THEME."ranks_template.php");
}
else
{
	require_once(e_PLUGIN."rank_system/templates/ranks_template.php");
}
require_once(e_PLUGIN.'rank_system/includes/rank_system_shortcodes.php');

$medal_tmp = explode('.', e_QUERY);
$medal_action = $medal_tmp[0];
$medal_acValue = intval($medal_tmp[1]);
$content = '';


if ($medal_action == '') {
	if(!$med_cont = $e107cache->retrieve("rank_medribs")) {
		$med_cont = "";
		$catTabs = "";
		$query = "
			SELECT
				med_cat_id, 
				med_cat_name 
			FROM 
				#rank_medal_category 
			WHERE (
			    SELECT count(*) 
			    FROM #rank_medals 
			    WHERE medal_category = med_cat_id
			    ) > 0
			ORDER BY
				med_cat_name		
		";
		$sql->db_Select_gen($query);
		$catList = $sql->db_getList();
	
		foreach ($catList as $cat) {
			extract($cat);
			$catTabs .= "'" . $tp->toHTML($med_cat_name) . " ". RANKS_MED_16."',";
			$catTabs .= "'" . $tp->toHTML($med_cat_name) . " ". RANKS_MED_17."',";
			$catPage[$med_cat_id.'M'] = $med_cat_name.'_M';
			$catPage[$med_cat_id.'R'] = $med_cat_name.'_R';
		}
		$catTabs .= "'" . RANKS_MED_18 . " ". RANKS_MED_16."',";
		$catTabs .= "'" . RANKS_MED_18 . " ". RANKS_MED_17."',";
		$catPage['0M'] = '0_M';
		$catPage['0R'] = '0_R';
		
		$catTabs = substr($catTabs, 0, -1);
		
		$query = "
			select m.*, c.med_cat_name from #rank_medals m, #rank_medal_category c 
			where c.med_cat_id = m.medal_category
			order by medal_type desc, medal_order 
		";
		if ($sql->db_Select_gen($query, false)) {
			$medalList = $sql->db_getList();
			
			$med_cont .= $tp->parsetemplate($MEDAL_HEADER, true, $rank_shortcodes);
			$med_cont .= "<div id='rank_medals' style='width:100%'>";
			
			foreach($medalList as $medal_rec) {
				extract($medal_rec);
				$type = ($medal_type == 0 ? "_R" : "_M");
				$data = $tp->parseTemplate($MEDAL_ROW, true, $rank_shortcodes);
				$tabcont[$med_cat_name.$type] .= $data;
				$tabcont['0'.$type] .= $data;
			}
			
			foreach($catPage as $page) {
				$row = $tabcont[$page];
				if (empty($row)) {
					$row = "";
				}
				$med_cont .= '<div class="dhtmlgoodies_aTab">';
				$med_cont .= $tp->parseTemplate($MEDAL_ROW_HEADER, true, $rank_shortcodes);
				$med_cont .= $row;
				$med_cont .= $tp->parseTemplate($MEDAL_ROW_FOOTER, true, $rank_shortcodes);
				$med_cont .= '</div>';
			}
			
			$med_cont .= '</div>';
			$med_cont .= $tp->parsetemplate($MEDAL_FOOTER, true, $rank_shortcodes);
			$med_cont .= '
				<script type="text/javascript">
					var tabviewfolder="' . SITEURL . $PLUGINS_DIRECTORY . 'rank_system/includes/tabview/"
					initTabs(\'rank_medals\',Array(' . $catTabs . '),0,\'100%\',\'\');
				</script>
			';
		}
		
		$e107cache->set("rank_medribs", $med_cont);
	} 
	
	$content .= $med_cont;
}

if ($medal_action == 'medal') {
	
	if (!check_class($RANK_PREF['rank_viewclass'])) {
		$content = $tp->parsetemplate($RANK_DENIED_PAGE, true, $rank_shortcodes);
		$ns->tablerender(RANKS_01, $content);
		require_once(FOOTERF);
		exit;
	}
	
	if ($medal_acValue) {
		
		$query = "
			select m.*, c.med_cat_name from #rank_medals m, #rank_medal_category c 
			where m.medal_id=$medal_acValue and c.med_cat_id = m.medal_category 
		";
		if ($sql->db_Select_gen($query, false)) {
			$medal_rec = $sql->db_Fetch();
			
			$content .= $tp->parsetemplate($SINGLE_MEDAL, true, $rank_shortcodes);
		}
	}

}

$menu = $tp->parsetemplate($RANK_MENU, true, $rank_shortcodes);
$ns->tablerender($menu, $content);
require_once(FOOTERF);

?>