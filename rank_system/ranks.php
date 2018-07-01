<?php
/**
 * $Id: ranks.php,v 1.4 2009/10/22 15:03:36 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.4 $
 * Last Modified: $Date: 2009/10/22 15:03:36 $
 *
 * Change Log:
 * $Log: ranks.php,v $
 * Revision 1.4  2009/10/22 15:03:36  michiel
 * Implemented customizable conditions
 *
 * Revision 1.3  2009/07/14 19:29:03  michiel
 * CVS Merge
 *
 * Revision 1.2.2.1  2009/07/13 21:54:07  michiel
 * - using own css style
 * - integrated deprecated rankshow_class into template/shortcode
 *
 * Revision 1.2  2009/06/28 15:05:52  michiel
 * Merged from dev_01_03
 *
 * Revision 1.1.4.1  2009/06/28 02:33:49  michiel
 * Rank System links on rank, medal and recommendation pages
 *
 * Revision 1.1  2009/03/28 13:01:44  michiel
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

$title = RANKS_01;
define('e_PAGETITLE', $title);
require_once(HEADERF);
require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');

global $sql, $RANK_PREF, $rank_obj, $show;
if (!$rank_obj) {
	$rank_obj = new rank;
}

if (file_exists(THEME."ranks_template.php")) {
	require_once(THEME."ranks_template.php");
} else {
	require_once(e_PLUGIN."rank_system/templates/ranks_template.php");
}
require_once(e_PLUGIN.'rank_system/includes/rank_system_shortcodes.php');

$rank_tmp = explode('.', e_QUERY);
$rank_action = $rank_tmp[0];
$rank_acValue = intval($rank_tmp[1]);
$content = '';


if ($rank_action == '') {
	global $rank_obj;
	
	if (check_class($RANK_PREF['rank_viewclass'])) {
		//Categories
		$ucount = $sql->db_Count("rank_users");
		
		$content .= $tp->parsetemplate($RANK_CATOVERVIEW_HEADER, true, $rank_shortcodes);
		
		$sql->db_Select("rank_category", "*", "1=1 order by category_id");
	    $catList = $sql->db_getList();
		foreach($catList as $cat) {
			$query = "
				SELECT 
					count(user_userid) count 
				FROM
					#rank_users
				WHERE
					user_probation = 'F'
					AND user_prison = 'F'
					AND user_kicked = 'F'
					AND user_rankid in ( 
						SELECT 
							rank_id 
						FROM
							#rank_ranks
						WHERE
							rank_category = ".$cat['category_id']."
					)
			";
			$sql->db_Select_gen($query, false);
			$row = $sql->db_Fetch();
			$cat_usercount = intval($row['count']);
			$cat_userperc = round(100/$ucount * $cat_usercount);

			$content .= $tp->parsetemplate($RANK_CATOVERVIEW_ROW, true, $rank_shortcodes);
		}
		
		$cat['category_id']=255;
		$cat['category_name']=RANKS_13;
		$cat_usercount = $sql->db_Count("rank_users", "(user_userid)", "where user_probation='T' or user_prison='T' or user_kicked='T'");
		$cat_userperc = round(100/$ucount * $cat_usercount);
		$content .= $tp->parsetemplate($RANK_CATOVERVIEW_ROW, true, $rank_shortcodes);
		
		$content .= $tp->parsetemplate($RANK_CATOVERVIEW_FOOTER, true, $rank_shortcodes);
	}
	
	
	//Ranks
	$content .= $tp->parsetemplate($RANK_RANKOVERVIEW_HEADER, true, $rank_shortcodes);
	
	$sql->db_Select("rank_ranks", "*", "1=1 order by rank_order");
    $rankList = $sql->db_getList();
	foreach($rankList as $rank_rec) {
		$rank_usercount = $sql->db_count("rank_users", "(user_userid)", "where user_probation='F' and user_prison='F' and user_kicked='F' and user_rankid = ".$rank_rec['rank_id']);
		$content .= $tp->parsetemplate($RANK_RANKOVERVIEW_ROW, true, $rank_shortcodes);
	}
	
	$content .= $tp->parsetemplate($RANK_RANKOVERVIEW_FOOTER, true, $rank_shortcodes);

	if (check_class($RANK_PREF['rank_viewclass'])) {
		//Specials
		$content .= $tp->parsetemplate($RANK_SPECIALOVERVIEW_HEADER, true, $rank_shortcodes);
		
		$sql->db_Select("rank_users", "count(user_userid) count", "user_probation='T'");
	    $row = $sql->db_Fetch();
	    $special['name']=RANKS_10;
	    $special['image']=$rank_obj->convertImage("Probation.png");
	    $special['count']=$row['count'];
		$content .= $tp->parsetemplate($RANK_SPECIALOVERVIEW_ROW, true, $rank_shortcodes);
	
		$sql->db_Select("rank_users", "count(user_userid) count", "user_prison='T'");
	    $row = $sql->db_Fetch();
	    $special['name']=RANKS_09;
	    $special['image']=$rank_obj->convertImage("Prison.png");
	    $special['count']=$row['count'];
		$content .= $tp->parsetemplate($RANK_SPECIALOVERVIEW_ROW, true, $rank_shortcodes);
		
		$sql->db_Select("rank_users", "count(user_userid) count", "user_kicked='T'");
	    $row = $sql->db_Fetch();
	    $special['name']=RANKS_11;
	    $special['image']=$rank_obj->convertImage("Kicked.png");
	    $special['count']=$row['count'];
		$content .= $tp->parsetemplate($RANK_SPECIALOVERVIEW_ROW, true, $rank_shortcodes);
		
		$content .= $tp->parsetemplate($RANK_RANKOVERVIEW_FOOTER, true, $rank_shortcodes);
	}
	
}

if ($rank_action == 'cat') {

	if (!check_class($RANK_PREF['rank_viewclass'])) {
		$content .= $tp->parsetemplate($RANK_DENIED_PAGE, true, $rank_shortcodes);
		$ns->tablerender(RANKS_01, $content);
		require_once(FOOTERF);
		exit;
	}
	
	if ($rank_acValue) {
		
		if ($rank_acValue == 255) {
			$list_title = RANKS_13;
			$content .= $tp->parsetemplate($LIST_SPECIALHEADER, true, $rank_shortcodes);
			
			$ranklist['probation'] = getSpecial('user_probation');
			$ranklist['prison'] = getSpecial('user_prison');
			$ranklist['kicked'] = getSpecial('user_kicked');
			$content .= $tp->parsetemplate($LIST_SPECIALROW, true, $rank_shortcodes);
			
			$content .= $tp->parsetemplate($LIST_SPECIALFOOTER, true, $rank_shortcodes);
		} 
		else 
		if ($sql->db_Select("rank_category", "*", "category_id=$rank_acValue")) {
			$cat_rec = $sql->db_Fetch();
			$list_title = $tp->toHTML($cat_rec['category_name']);
			
			$content .= $tp->parsetemplate($LIST_RANKHEADER, true, $rank_shortcodes);
			
			$sql->db_Select("rank_ranks", "rank_id, rank_name, rank_img", "rank_category=".$cat_rec['category_id']." order by rank_order");
			
		    $rankList = $sql->db_getList();
			foreach($rankList as $rank_rec) {
				extract($rank_rec);
				$rank_name = $tp->toHTML($rank_name);
				
				$ranklist['rank'] = getRank($rank_id);
				$content .= $tp->parsetemplate($LIST_RANKROW, true, $rank_shortcodes);
			}
			
			$content .= $tp->parsetemplate($LIST_RANKFOOTER, true, $rank_shortcodes);
		}
	}

}

$menu = $tp->parsetemplate($RANK_MENU, true, $rank_shortcodes);
$ns->tablerender($menu, $content);

require_once(FOOTERF);

function getSpecial($special) {
	global $sql;
	
	$retval = "";
	
	$query = "
		SELECT
			user_id,
			user_name
		FROM
			#rank_users,
			#user
		WHERE
			user_userid = user_id
			AND $special = 'T'
		ORDER BY
			user_name
	";
	if ($sql->db_Select_gen($query)) {
		while ($row = $sql->db_Fetch()) {
			if ($retval != "") $retval .= "<br/>";
			$retval .= "<a href='/user.php?id.".$row['user_id']."' class='rslistuser'>".$row['user_name']."</a>";
		}
	} else {
		$retval = "&nbsp;";
	}

	return $retval;
}

function getRank($rank_id) {
	global $sql;
	
	$retval = "";
	
	$query = "
		SELECT
			user_id,
			user_name
		FROM
			#rank_users,
			#user
		WHERE
			user_userid = user_id
			AND user_rankid = $rank_id
			AND user_probation='F'
			AND	user_prison='F'
			AND user_kicked='F' 
		ORDER BY
			user_name
	";
	if ($sql->db_Select_gen($query)) {
		while ($row = $sql->db_Fetch()) {
			if ($retval != "") $retval .= "<br/>";
			$retval .= "<a href='/user.php?id.".$row['user_id']."' class='rslistuser'>".$row['user_name']."</a>";
		}
	} else {
		$retval = "&nbsp;";
	}

	return $retval;
}


?>