<?php
/**
 * $Id: e_module.php,v 1.3 2009/07/14 19:29:01 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.3 $
 * Last Modified: $Date: 2009/07/14 19:29:01 $
 *
 * Change Log:
 * $Log: e_module.php,v $
 * Revision 1.3  2009/07/14 19:29:01  michiel
 * CVS Merge
 *
 * Revision 1.2.6.1  2009/07/05 20:30:25  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.2.8.1  2009/07/02 21:26:30  michiel
 * Verify that Gold System has been installed, before invoking it...
 *
 * Revision 1.2  2009/06/26 09:22:59  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/04/01 19:26:39  michiel
 * Medal goal automated using e_rank.php
 *
 * Revision 1.1  2009/03/28 13:01:38  michiel
 * Initial CVS revision
 *
 *  
 */
if (!defined('e107_INIT'))
{
    exit;
}
if (!isset($pref['plug_installed']['rank_system']))
{
    return;
}

global $RANK_PREF, $rank, $medal;

include_lan(e_PLUGIN . 'rank_system/languages/' . e_LANGUAGE . '.php');
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

if (USER)
{
	if ($rank->needUserCheck(USERID)) {
		$rank->updateRank(USERID, true);
		$medal->validateTarget(USERID, 'goal_visits', false);
	}
	
	
	if ($rank->needVerifyAll()) {
		$RANK_PREF['rank_lastverify']=time();
		$rank->save_prefs();
		$rank->validateAll();
		$medal->validateAll();
	}
}

if ((isset($_POST['chat_submit'])) && ($_POST['cmessage'] != "") ) {
	$medal->validateTarget(USERID, 'goal_chatbox', true);
}

if ((e_PAGE == "forum_post.php") && (isset($_POST['newthread']) || isset($_POST['reply']) )) {
	$medal->validateTarget(USERID, 'goal_forum', true);
}

if (isset($_POST['commentsubmit']) ) {
	$medal->validateTarget(USERID, 'goal_comment', true);
}


session_start();


?>