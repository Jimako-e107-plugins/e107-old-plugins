/**
 * $Id: rank_img.sc,v 1.2 2009/06/28 15:05:51 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 27 jun 2009 - 00:25:50
 * 
 * Revision: $Revision: 1.2 $
 * Last Modified: $Date: 2009/06/28 15:05:51 $
 *
 * Change Log:
 * $Log: rank_img.sc,v $
 * Revision 1.2  2009/06/28 15:05:51  michiel
 * Merged from dev_01_03
 *
 * Revision 1.1.2.2  2009/06/27 17:14:11  michiel
 * In undefined pages, looking for $user_id, otherwise using USERID
 *
 * Revision 1.1.2.1  2009/06/27 15:48:50  michiel
 * Shortcode for manually insert a user's rank image
 *
 *  
 */

global $RANK_PREF, $rank, $sql, $post_info, $user_id;
require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');

if (!is_object($rank)) {
    $rank = new rank;
}

$width = '';
$height = '';
if ($RANK_PREF['rank_forumwidth'] > 0) {
	$width = "width='".$RANK_PREF['rank_forumwidth']."' ";
}
if ($RANK_PREF['rank_forumheight'] > 0) {
	$height = "height='".$RANK_PREF['rank_forumheight']."' ";
}

/*
 * User Profile  
 */
if (e_PAGE == 'user.php') {
	if (e_QUERY) {
	    $tmp = explode(".", e_QUERY);
	    $uid = intval($tmp[1]);
	} else {
		$uid = 0;
	}
	
	if ($uid == 0) {
		if (USERID == 0) return "";
		$uid = USERID;
	}

	$stat = $rank->getRank($uid);
	return "<img src='".$stat['image']."' border='0' $width $height alt='".$stat['name']."' title='".$stat['name']."' />";
}

/*
 * Forum Post
 */
if (e_PAGE == 'forum_viewtopic.php') {
	$uid = intval($post_info['user_id']);
	
	if ($uid == 0) return "";
	
	$stat = $rank->getRank($uid);
	return "<img src='".$stat['image']."' border='0' $width $height alt='".$stat['name']."' title='".$stat['name']."' />";
}

/*
 * Other.. just return current user's image
 */

if (!isset($user_id)) $user_id = USERID;
if ($user_id == 0) return "";
$stat = $rank->getRank($user_id);
return "<img src='".$stat['image']."' border='0' $width $height alt='".$stat['name']."' title='".$stat['name']."' />";

