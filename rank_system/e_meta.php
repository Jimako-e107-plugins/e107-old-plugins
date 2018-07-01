<?php
/**
 * $Id: e_meta.php,v 1.6 2009/12/25 15:45:15 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.6 $
 * Last Modified: $Date: 2009/12/25 15:45:15 $
 *
 * Change Log:
 * $Log: e_meta.php,v $
 * Revision 1.6  2009/12/25 15:45:15  michiel
 * BugFix: TabView
 *
 * Revision 1.5  2009/10/22 15:05:08  michiel
 * Implemented conditions and using cache
 *
 * Revision 1.4  2009/07/14 19:29:03  michiel
 * CVS Merge
 *
 * Revision 1.3.2.1  2009/07/05 20:30:26  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.1  2009/07/02 21:26:28  michiel
 * Verify that Gold System has been installed, before invoking it...
 *
 * Revision 1.3  2009/06/28 15:05:52  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/28 02:33:08  michiel
 * - Position of rank image in forum is configurable
 * - Medal/Ribbon counts can be shown in forum
 * - forum templates have been separated from user profile templates
 *
 * Revision 1.2  2009/06/26 09:23:05  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/24 19:21:16  michiel
 * Modified forum injection, was giving trouble with some Gold System versions
 *
 * Revision 1.1  2009/03/28 13:01:35  michiel
 * Initial CVS revision
 *
 *  
 */
if (!defined('e107_INIT'))
{
    exit;
}
global $RANK_PREF, $rank, $pref, $PLUGINS_DIRECTORY, $post_info;
if (!isset($pref['plug_installed']['rank_system']))
{
    return ;
}

require_once(e_PLUGIN . 'rank_system/includes/rank_class.php');
require_once(e_PLUGIN . 'rank_system/includes/medal_class.php');
require_once(e_HANDLER . 'userclass_class.php');
if (!is_object($rank))
{
    $rank = new rank;
}
if (!is_object($medal))
{
    $medal = new medal;
}

$lan_file = e_PLUGIN . 'rank_system/languages/' . e_LANGUAGE . '.php';
include_once(is_readable($lan_file) ? $lan_file : e_PLUGIN . 'rank_system/languages/English.php');
require_once(e_PLUGIN . 'rank_system/includes/rank_system_shortcodes.php');

if (e_PAGE == 'user.php') {

	if (file_exists(THEME."rank_user_template.php")) {
		require_once(THEME."rank_user_template.php");
	} else {
		require_once(e_PLUGIN."rank_system/templates/rank_user_template.php");
	}
	
    $uid = intval($qs[1]);

    $detect1 = strpos($USER_FULL_TEMPLATE, "{USER_SIGNATURE}");
    $detect2 = strpos($USER_FULL_TEMPLATE, "{USER_EXTENDED_ALL}") - 1;
    $detect = $detect2 - $detect1;
    $profile_old = substr($USER_FULL_TEMPLATE, $detect1, $detect);
    
    global $sql, $e107cache;
    
    if(!$profile_new = $e107cache->retrieve("rank_up_$uid")) {
	    $usrrank = $rank->getRank($uid);
	    $nextrank = $rank->nextRank($uid, $usrrank['id'], $usrrank['totpoints']);
	    $profile_new = $tp->parsetemplate($RANK_USER_HEADER, true, $rank_shortcodes);
	
	    $sql->db_Select("rank_condition", "*", "condit_enabled = 'T' order by condit_order");
	    $condList = $sql->db_getList();
	    foreach ($condList as $cond) {
	    	extract($cond);
	    	$value = intval($usrrank['values'][$condit_id.'_value']);
	    	$text = $usrrank['values'][$condit_id.'_text'];
	    	$profile_new .= $tp->parsetemplate($RANK_USER_CONDITION, true, $rank_shortcodes);
	    }
	    
	    $profile_new .= $tp->parsetemplate($RANK_USER_FOOTER, true, $rank_shortcodes);
	    
	    $usrmeds = $medal->getMedals($uid);
	    $profile_new .= $tp->parsetemplate($MEDAL_USER_PROFILE, true, $rank_shortcodes);
	    
	    $e107cache->set("rank_up_$uid", $profile_new);
    }
    
    $USER_FULL_TEMPLATE = str_replace($profile_old, $profile_old . $profile_new, $USER_FULL_TEMPLATE);
    }

if (e_PAGE == 'forum_viewtopic.php' 
	&& ($RANK_PREF['rank_forumimg'] != "-" 
		|| $RANK_PREF['rank_forumstat'] != "-")) {
			
	if (file_exists(THEME."rank_forum_template.php")) {
		require_once(THEME."rank_forum_template.php");
	} else {
		require_once(e_PLUGIN."rank_system/templates/rank_forum_template.php");
	}
	
	if (file_exists(THEME."forum_viewtopic_template.php")) {
		require_once(THEME."forum_viewtopic_template.php");
	} else if (file_exists(THEME."forum_template.php"))	{
		require_once(THEME."forum_template.php");
	} else {
		require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	}
	require_once(e_PLUGIN.'forum/forum_shortcodes.php');
	
	$break['pre'] = $RANK_PREF['rank_forumbreak'] == 1 || $RANK_PREF['rank_forumbreak'] == 3  ? "<br/>" : "";
	$break['post'] = $RANK_PREF['rank_forumbreak'] == 2 || $RANK_PREF['rank_forumbreak'] == 3  ? "<br/>" : "";
	$statsDone = false;
	
	// ---------- forum IMAGE ----------
	if ($RANK_PREF['rank_forumimg'] != "-") {
		
		$toInject = $break['pre'] . $RANK_FORUM_PROFILE . $break['post'];
		if ($RANK_PREF['rank_forumstat'] == "{RANK_IMAGE}") {
			$toInject .= $RANK_FORUM_STAT;
			$statsDone = true;
		}
		
		// ---------- threadstyle ----------
	    $detect = strpos($FORUMTHREADSTYLE, $RANK_PREF['rank_forumimg']);
	    if ($detect !== FALSE) {
		    $profile_old = substr($FORUMTHREADSTYLE, $detect, strlen($RANK_PREF['rank_forumimg']));
		    
		    if ($RANK_PREF['rank_frmimgoffset'] == "-") {
		    	$profile_new = $toInject . $profile_old; 
		    } else {
		    	$profile_new = $profile_old . $toInject;
		    }
		    
		    $FORUMTHREADSTYLE = str_replace($profile_old, $profile_new, $FORUMTHREADSTYLE);
	    }
	    
		// ---------- replystyle ----------
	    $detect = strpos($FORUMREPLYSTYLE, $RANK_PREF['rank_forumimg']);
	    if ($detect !== FALSE) {
		    $profile_old = substr($FORUMREPLYSTYLE, $detect, strlen($RANK_PREF['rank_forumimg']));

		    if ($RANK_PREF['rank_frmimgoffset'] == "-") {
		    	$profile_new = $toInject . $profile_old; 
		    } else {
		    	$profile_new = $profile_old . $toInject;
		    }
		    
		    $FORUMREPLYSTYLE = str_replace($profile_old, $profile_new, $FORUMREPLYSTYLE);
	    }

	    // Parse both
	    $tp->parsetemplate($RANK_FORUM_PROFILE, true, $rank_shortcodes);
	}
	
	// ---------- forum IMAGE ----------
	if (!$statsDone && $RANK_PREF['rank_forumstat'] != "-") {
		// ---------- threadstyle ----------
	    $detect = strpos($FORUMTHREADSTYLE, $RANK_PREF['rank_forumstat']);
	    if ($detect !== FALSE) {
		    $profile_old = substr($FORUMTHREADSTYLE, $detect, strlen($RANK_PREF['rank_forumstat']));

		    if ($RANK_PREF['rank_frmstatoffset'] == "-") {
		    	$profile_new = $RANK_FORUM_STAT . $profile_old; 
		    } else {
		    	$profile_new = $profile_old . $RANK_FORUM_STAT;
		    }
		    
		    $FORUMTHREADSTYLE = str_replace($profile_old, $profile_new, $FORUMTHREADSTYLE);
	    }
	    
	    // ---------- replystyle ----------
		if ($RANK_PREF['rank_forumstat'] != "-") {
		    $detect = strpos($FORUMREPLYSTYLE, $RANK_PREF['rank_forumstat']);
		    if ($detect !== FALSE) {
			    $profile_old = substr($FORUMREPLYSTYLE, $detect, strlen($RANK_PREF['rank_forumstat']));

			    if ($RANK_PREF['rank_frmstatoffset'] == "-") {
			    	$profile_new = $RANK_FORUM_STAT . $profile_old; 
			    } else {
			    	$profile_new = $profile_old . $RANK_FORUM_STAT;
			    }
			    
			    $FORUMREPLYSTYLE = str_replace($profile_old, $profile_new, $FORUMREPLYSTYLE);
		    }
		}
		
		// Parse both
	    $tp->parsetemplate($RANK_FORUM_STAT, true, $rank_shortcodes);
	}
}

if (e_PAGE == 'conditions.php' || e_PAGE == 'medals.php') {
	echo '<link rel="stylesheet" href="' . e_PLUGIN_ABS . 'rank_system/includes/tabview/css/dynamic_list.css" type="text/css" />';
	echo '<link rel="stylesheet" href="' . e_PLUGIN_ABS . 'rank_system/includes/tabview/css/tab-view.css" type="text/css" />';
	echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'rank_system/includes/tabview/js/ajax.js"></script>';
	echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'rank_system/includes/tabview/js/ajax-dynamic-list.js"></script>';
	echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'rank_system/includes/tabview/js/tab-view.js"></script>';
}
	


?>