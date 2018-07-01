/**
 * $Id: rank_score.sc,v 1.1 2009/10/22 19:10:00 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Initial Creation Date: 17 okt 2009 - 17:07:50
 * 
 * Revision: $Revision: 1.1 $
 * Last Modified: $Date: 2009/10/22 19:10:00 $
 *
 * Change Log:
 * $Log: rank_score.sc,v $
 * Revision 1.1  2009/10/22 19:10:00  michiel
 * General short codes for rank name and rank score
 *
 *  
 */

global $RANK_PREF, $rank, $sql, $post_info, $user_id;
require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');

if (!is_object($rank)) {
    $rank = new rank;
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
	return $stat['totpoints'];
}

/*
 * Forum Post
 */
if (e_PAGE == 'forum_viewtopic.php') {
	$uid = intval($post_info['user_id']);
	
	if ($uid == 0) return "";
	
	$stat = $rank->getRank($uid);
	return $stat['totpoints'];
}

/*
 * Other.. just return current user's image
 */

if (!isset($user_id)) $user_id = USERID;
if ($user_id == 0) return "";
$stat = $rank->getRank($user_id);
return $stat['totpoints'];

