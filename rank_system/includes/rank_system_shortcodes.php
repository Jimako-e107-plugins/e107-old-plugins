<?php
/**
 * $Id: rank_system_shortcodes.php,v 1.6 2009/10/22 15:20:27 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.6 $
 * Last Modified: $Date: 2009/10/22 15:20:27 $
 *
 * Change Log:
 * $Log: rank_system_shortcodes.php,v $
 * Revision 1.6  2009/10/22 15:20:27  michiel
 * Show bonus points and reward in Medal Overview
 *
 * Revision 1.5  2009/10/22 15:03:38  michiel
 * Implemented customizable conditions
 *
 * Revision 1.4  2009/07/14 19:29:14  michiel
 * CVS Merge
 *
 * Revision 1.3.2.2  2009/07/13 21:52:05  michiel
 * - using own css style
 * - able to show medals/ribbons on category
 * - integrated deprecated rankshow_class into template/shortcode
 *
 * Revision 1.3.2.1  2009/07/12 12:39:38  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.1  2009/07/12 11:49:21  michiel
 * Added white spaces between medals overview on userprofile
 *
 * Revision 1.3  2009/06/28 15:06:14  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.2  2009/06/28 02:34:44  michiel
 * Medal/Ribbon counts can be shown in forum
 *
 * Revision 1.2.2.1  2009/06/27 15:53:46  michiel
 * - Removed fixed medal size in user's profile
 * - Using 2nd medal image in overview
 *
 * Revision 1.2  2009/06/26 09:23:37  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/19 13:47:22  michiel
 * Made XHTML compliant
 *
 * Revision 1.1  2009/03/28 13:01:48  michiel
 * Initial CVS revision
 *
 *  
 */
if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');
require_once(e_HANDLER . 'userclass_class.php');
$rank_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*

SC_BEGIN RANK_IMAGE
global $usrrank;
return $usrrank['image'];
SC_END

SC_BEGIN RANK_NAME
global $usrrank;
return $usrrank['name'];
SC_END

SC_BEGIN CONDIT_VALUE
global $condit_negative, $value, $condit_maxval, $text, $condit_onbar, $condit_offbar, $RANK_PREF;

$img = "";

if (($parm=="-" && $condit_negative == "F") || ($parm=="+" && $condit_negative == "T")) {
	return "&nbsp;";
}

if ($RANK_PREF['rank_lvlstyle'] == 0) {
	$prc = round(100/$condit_maxval*$value);
	$onwidth = round($RANK_PREF['rank_lvlupwidth']/100*$prc);
	$offwidth = $RANK_PREF['rank_lvlupwidth']-$onwidth;
} else {
	$onwidth = $value;
	$offwidth = $condit_maxval-$value;
}

$popup = "[" . $value . ($condit_negative == "T" ? "-/-" : "/") . $condit_maxval . "]";
if ($text != "") $popup .= " ".$text;

if ($condit_negative == "T") {
	$img .= "<img src='".e_PLUGIN."rank_system/images/".$condit_offbar."' border='0' width='".$offwidth."' height='".$RANK_PREF['rank_barheight']."' alt='".$popup."' title='".$popup."' />";
	$img .= "<img src='".e_PLUGIN."rank_system/images/".$condit_onbar."' border='0' width='".$onwidth."' height='".$RANK_PREF['rank_barheight']."' alt='".$popup."' title='".$popup."' />";
} else {
	$img .= "<img src='".e_PLUGIN."rank_system/images/".$condit_onbar."' border='0' width='".$onwidth."' height='".$RANK_PREF['rank_barheight']."' alt='".$popup."' title='".$popup."' />";
	$img .= "<img src='".e_PLUGIN."rank_system/images/".$condit_offbar."' border='0' width='".$offwidth."' height='".$RANK_PREF['rank_barheight']."' alt='".$popup."' title='".$popup."' />";
}
return $img;
SC_END

SC_BEGIN CONDIT_NAME
global $condit_name, $condit_id, $tp;
$name = $tp->toHTML($condit_name);

if ($parm == 'link') {
	$name = "<a href='".e_PLUGIN."rank_system/conditions.php?$condit_id'>$name</a>";
}

return $name;
SC_END

SC_BEGIN CONDIT_DESCRIPTION
global $condit_descript, $tp;
return $tp->toHTML($condit_descript, true, "constants");
SC_END

SC_BEGIN RANK_POINTS
global $usrrank;
return $usrrank['points'];
SC_END

SC_BEGIN MED_BONUS
global $usrrank;
return $usrrank['medpoints'];
SC_END

SC_BEGIN TOT_POINTS
global $usrrank;
return $usrrank['totpoints'];
SC_END

SC_BEGIN RANK_NEXT
global $nextrank;

if (!$nextrank) return RANKS_UP_06;
if ($nextrank == "AGE") return RANKS_UP_05;
if ($nextrank == "FIXED") return RANKS_UP_07;

return $nextrank['points'] . " (" . $nextrank['prog'] . ")";
SC_END

SC_BEGIN EDIT_RANK
global $RANK_PREF, $usrrank; 
	if (check_class($RANK_PREF['rank_modifyclass']) && (USERID != $usrrank['uid'] || $RANK_PREF['rank_modown'] == "T") ) {
		return "<a class='rs' href='".e_PLUGIN."rank_system/edit_rank.php?edit.".$usrrank['uid']."'><img src='" . e_IMAGE . "admin_images/edit_16.png' alt='" . RANKS_ED_01 . "' title='" . RANKS_ED_01 . "' border='0' /></a>";
	} else {
		return "&nbsp;";
	}
SC_END

SC_BEGIN PROBATE_BUTTON
global $RANK_PREF, $usrrank;
	 
	if ($usrrank['probation'] == 1 && check_class($RANK_PREF['rank_outprobationcls']) && (USERID != $usrrank['uid'] || $RANK_PREF['rank_modown'] == "T") ) {
		return "<a class='rs' href='".e_PLUGIN."rank_system/edit_rank.php?probation.".$usrrank['uid']."'>"
		."<img src='".e_PLUGIN."rank_system/images/offprobation.gif' border='0' alt='".RANKS_ED_09."' title='".RANKS_ED_09."' /></a>";
	} else if ($usrrank['probation'] == 0 && check_class($RANK_PREF['rank_inprobationcls']) && (USERID != $usrrank['uid'] || $RANK_PREF['rank_modown'] == "T") ) {
		return "<a class='rs' href='".e_PLUGIN."rank_system/edit_rank.php?probation.".$usrrank['uid']."'>"
		."<img src='".e_PLUGIN."rank_system/images/onprobation.gif' border='0' alt='".RANKS_ED_08."' title='".RANKS_ED_08."' /></a>";
	} else {
		return "&nbsp;";
	}
SC_END

SC_BEGIN PRISON_BUTTON
global $RANK_PREF, $usrrank;
	 
	if ($usrrank['prison'] == 1 && check_class($RANK_PREF['rank_outprisoncls']) && (USERID != $usrrank['uid'] || $RANK_PREF['rank_modown'] == "T") ) {
		return "<a class='rs' href='".e_PLUGIN."rank_system/edit_rank.php?prison.".$usrrank['uid']."'>"
		."<img src='".e_PLUGIN."rank_system/images/outprison.gif' border='0' alt='".RANKS_ED_07."' title='".RANKS_ED_07."' /></a>";
	} else if ($usrrank['prison'] == 0 && check_class($RANK_PREF['rank_inprisoncls']) && (USERID != $usrrank['uid'] || $RANK_PREF['rank_modown'] == "T") ) {
		return "<a class='rs' href='".e_PLUGIN."rank_system/edit_rank.php?prison.".$usrrank['uid']."'>"
		."<img src='".e_PLUGIN."rank_system/images/inprison.gif' border='0' alt='".RANKS_ED_06."' title='".RANKS_ED_06."' /></a>";
	} else {
		return "&nbsp;";
	}
SC_END

SC_BEGIN KICK_BUTTON
global $RANK_PREF, $usrrank;
	 
	if ($usrrank['kicked'] == 0 && check_class($RANK_PREF['rank_kickcls']) && (USERID != $usrrank['uid'] || $RANK_PREF['rank_modown'] == "T") ) {
		return "<a class='rs' href='".e_PLUGIN."rank_system/edit_rank.php?kick.".$usrrank['uid']."'>"
		."<img src='".e_PLUGIN."rank_system/images/kick.gif' border='0' alt='".RANKS_ED_04."' title='".RANKS_ED_04."' /></a>";
	} else {
		return "&nbsp;";
	}
SC_END

SC_BEGIN RANK_FORUM_IMG
global $RANK_PREF, $rank, $post_info;
	$width = '';
	$height = '';
	if ($RANK_PREF['rank_forumwidth'] > 0) {
		$width = "width='".$RANK_PREF['rank_forumwidth']."' ";
	}
	if ($RANK_PREF['rank_forumheight'] > 0) {
		$height = "height='".$RANK_PREF['rank_forumheight']."' ";
	}

	$usrrank = $rank->getRank($post_info['user_id']);
	return "<img src='".$usrrank['image']."' border='0' ".$width.$height."alt='".$usrrank['name']."' title='".$usrrank['name']."' />";
SC_END

SC_BEGIN RANK_FORUM_MEDCOUNT
global $RANK_PREF, $sql, $post_info;

	$query = "
		SELECT 
			count(med_user_index) count 
		FROM 
			#rank_medal_users,
			#rank_medals
		WHERE 
			med_user_id = " . $post_info['user_id'] . " 
			AND med_user_medal = medal_id 
			AND medal_type = 1	
	";
	if ($sql->db_Select_gen($query)) {
		$row = $sql->db_Fetch();
		return intval($row['count']);
	} else {
		return "-";
	}
SC_END

SC_BEGIN RANK_FORUM_RIBCOUNT
global $RANK_PREF, $sql, $post_info;

	$query = "
		SELECT 
			count(med_user_index) count 
		FROM 
			#rank_medal_users,
			#rank_medals
		WHERE 
			med_user_id = " . $post_info['user_id'] . " 
			AND med_user_medal = medal_id 
			AND medal_type = 0	
	";
	if ($sql->db_Select_gen($query)) {
		$row = $sql->db_Fetch();
		return intval($row['count']);
	} else {
		return "-";
	}
SC_END

SC_BEGIN OVERVIEW_CAT_ID
global $cat;
	return $cat['category_id'];
SC_END

SC_BEGIN OVERVIEW_CAT_COUNT
global $cat_usercount;
	return $cat_usercount;
SC_END

SC_BEGIN OVERVIEW_CAT_BAR
global $RANK_PREF, $cat_userperc;

$width = round($RANK_PREF['rank_lvlovwidth'] / 100 * $cat_userperc);
return "<img src='".e_PLUGIN."rank_system/images/levelbar.gif' border='0' width='$width' height='".$RANK_PREF['rank_barheight']."' />";
SC_END

SC_BEGIN OVERVIEW_CAT_PERCENT
global $cat_userperc;
	return $cat_userperc."%";
SC_END

SC_BEGIN OVERVIEW_CAT_NAME
global $cat;
	return $cat['category_name'];
SC_END

SC_BEGIN OVERVIEW_RANK_IMAGE
global $rank_rec, $rank_obj;
	return $rank_obj->convertImage($rank_rec['rank_img']);
SC_END

SC_BEGIN OVERVIEW_RANK_RANK
global $rank_rec;
	return $rank_rec['rank_name'];
SC_END

SC_BEGIN OVERVIEW_RANK_POINTS
global $rank_rec;
	return ($rank_rec['rank_points'] > 0 ? $rank_rec['rank_points'] : "-");
SC_END

SC_BEGIN OVERVIEW_RANK_AGE
global $rank_rec, $sql;
	$sql->db_Select("rank_category", "category_age", "category_id=".$rank_rec['rank_category']);
	$row = $sql->db_Fetch();
	return ($row['category_age'] > 0 ? $row['category_age'] : "-");
SC_END

SC_BEGIN OVERVIEW_RANK_COUNT
global $rank_rec, $RANK_PREF, $rank_usercount;
	if (!check_class($RANK_PREF['rank_viewclass'])) {
		return "&nbsp;";
	}
	
	return $rank_usercount;
SC_END

SC_BEGIN OVERVIEW_SPECIAL_IMAGE
global $special;
	return $special['image'];
SC_END

SC_BEGIN OVERVIEW_SPECIAL_NAME
global $special;
	return $special['name'];
SC_END

SC_BEGIN OVERVIEW_SPECIAL_COUNT
global $special;
	return $special['count'];
SC_END

SC_BEGIN MEDAL_IMAGES
global $usrmeds, $medal;

    $data = "";

    for ($loop = 1; $loop <= $usrmeds['count']; $loop++) {
		if ($usrmeds[$loop]['type'] == 1) {
			$show = false;
			if (isset($parm) && $parm != "") {
				//parameter is a number -> category id
				//otherwise -> category name
				$cid = intval($parm);
				if ($cid > 0 && $usrmeds[$loop]['cat_id'] == $cid) {
					$show = true;
				} else if ($cid == 0 && $usrmeds[$loop]['cat_name'] == $parm) {
					$show = true;
				}
			} else {
				$show = true;
			}
	
			if ($show) {
		   		$data .= ' <a class="rs" href="'.e_PLUGIN.'rank_system/medals.php?medal.'.$usrmeds[$loop]['id'].'">';
				$data .= $medal->createImage($usrmeds[$loop]['image'], $usrmeds[$loop]['name'], $usrmeds[$loop]['date'], 0, 0);
				$data .= '</a> ';
			}
		}
    }
	return $data;
SC_END

SC_BEGIN RIBBON_IMAGES
global $usrmeds, $medal;

    $data = "";

    for ($loop = 1; $loop <= $usrmeds['count']; $loop++) {
		if ($usrmeds[$loop]['type'] == 0) {
			$show = false;
			if (isset($parm) && $parm != "") {
				//parameter is a number -> category id
				//otherwise -> category name
				$cid = intval($parm);
				if ($cid > 0 && $usrmeds[$loop]['cat_id'] == $cid) {
					$show = true;
				} else if ($cid == 0 && $usrmeds[$loop]['cat_name'] == $parm) {
					$show = true;
				}
			} else {
				$show = true;
			}
	
			if ($show) {
		   		$data .= ' <a class="rs" href="'.e_PLUGIN.'rank_system/medals.php?medal.'.$usrmeds[$loop]['id'].'">';
				$data .= $medal->createImage($usrmeds[$loop]['image'], $usrmeds[$loop]['name'], $usrmeds[$loop]['date'], 0, 0);
				$data .= '</a> ';
			}
		}
    }
	return $data;
SC_END

SC_BEGIN MEDAL_NAME
global $medal_rec;

	return $medal_rec['medal_name'];
SC_END

SC_BEGIN MEDAL_ID
global $medal_rec;

	return $medal_rec['medal_id'];
SC_END

SC_BEGIN MEDAL_CATEGORY
global $medal_rec;

	return $medal_rec['med_cat_name'];
SC_END

SC_BEGIN MEDAL_TYPE
global $medal_rec;

	return ($medal_rec['medal_type'] == 0 ? RANKS_MED_07 : RANKS_MED_06);
SC_END

SC_BEGIN MEDAL_BONUS
global $medal_rec;

	return $medal_rec['medal_bonus'];
SC_END

SC_BEGIN MEDAL_REWARD
global $medal_rec;

$retval = number_format($medal_rec['medal_reward'], 0);
$retval .= " <img src='".e_PLUGIN."gold_system/images/gold.gif' border='0' />";
	return $retval;
SC_END

SC_BEGIN MEDAL_DESCRIPTION
global $medal_rec;

	return $medal_rec['medal_description'];
SC_END

SC_BEGIN MEDAL_USERHEAD
global $medal_rec;

	return ($medal_rec['medal_type'] == 0 ? RANKS_MED_09 : RANKS_MED_08);
SC_END

SC_BEGIN MEDAL_IMAGE
global $medal_rec, $medal_obj;

	return $medal_obj->convertImage($medal_rec['medal_img2']);
SC_END

SC_BEGIN MEDAL_USERLIST
global $medal_rec, $sql, $tp;
	$ret = "";
	$query = "
		select user_id, user_name, med_user_remarks, med_user_date from #user u, #rank_medal_users m 
		where m.med_user_medal = ".$medal_rec['medal_id']." and user_id = med_user_id
		order by user_name
	";

	if ($sql->db_Select_gen($query, false)) {
		if ($medal_rec['medal_type'] == 1) {
			$ret .= "
				<table class='rsborder' style='width:100%'>
		 		<tr>
		 			<td class='rsheader2' style='width:25%;text-align:center'>
		 				".RANKS_MED_13."
		 			</td>
		 			<td class='rsheader2' style='width:60%;text-align:center'>
		 				".RANKS_MED_14."
		 			</td>
		 			<td class='rsheader2' style='width:15%;text-align:center'>
		 				".RANKS_MED_15."
		 			</td>
		 		</tr>
			";
		}
	
		while ($row = $sql->db_Fetch()) {
			if ($medal_rec['medal_type'] == 1) {
				$ret .= "
					<tr>
						<td class='rsheader3' style='text-align:center'>
							<a class='rs' href='/user.php?id.".$row['user_id']."'>".$row['user_name']."</a>
						</td>
						<td class='rsheader3' style='text-align:left'>
							".$tp->toHTML($row['med_user_remarks'])."
						</td>
						<td class='rsheader3' style='text-align:center'>
							".date("d-m-Y",$row['med_user_date'])."
						</td>
				";
			} else {
				$ret .= "<a class='rs' href='/user.php?id.".$row['user_id']."'>".$row['user_name']."</a><br />";
			}
		}
		
		if ($medal_rec['medal_type'] == 1) {
			$ret .= "</table>";
		}

	} else {
		$ret = RANKS_MED_10;
	}

	return $ret;
SC_END

SC_BEGIN EDIT_MEDALS
global $RANK_PREF, $uid; 
	if (check_class($RANK_PREF['medal_modifyclass']) && (USERID != $uid || $RANK_PREF['rank_modown'] == "T") ) {
		return "<a class='rs' href='".e_PLUGIN."rank_system/edit_medals.php?edit.".$uid."'><img src='" . e_IMAGE . "admin_images/edit_16.png' alt='" . RANKS_MED_12 . "' title='" . RANKS_MED_12 . "' border='0' /></a>";
	} else {
		return "";
	}
SC_END

SC_BEGIN LIST_TITLE
global $list_title;
return $list_title;
SC_END

SC_BEGIN LIST_IMG
global $rank_img, $rank_name;
if ($parm == 'probation') {
	$img = 'Probation.png';
	$alt = RANKS_10;
} else if ($parm == 'prison') {
	$img = 'Prison.png';
	$alt = RANKS_09;
} else if ($parm == 'kicked') {
	$img = 'Kicked.png';
	$alt = RANKS_11;
} else if ($parm == 'rank') {
	$img = $rank_img;
	$alt = $rank_name;
}
return "<img src='".e_PLUGIN."rank_system/images/ranks/$img' alt='$alt' title='$title' border='0' />";
SC_END

SC_BEGIN LIST_USERS
global $ranklist;

return $ranklist[$parm];  
SC_END

SC_BEGIN LIST_RANKNAME
global $rank_name;
return $rank_name;
SC_END


*/

?>