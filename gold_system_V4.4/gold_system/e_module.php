<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT'))
{
    exit;
}
if (!isset($pref['plug_installed']['gold_system']))
{
    return;
}
$footer_js[] = e_PLUGIN . 'gold_system/includes/gold_footer.js';
global $GOLD_PREF, $gold_obj;
// require_once(e_HANDLER."useclass_class.php");
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_gold_system.php');

require_once(e_HANDLER . 'userclass_class.php');
if (!is_object($gold_obj))
{
require_once(e_PLUGIN . 'gold_system/includes/gold_class.php');
    $gold_obj = new gold;
}

// ////////////////////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////
// START REWARDS
// Credit them for new chatbox posts
if ((isset($_POST['chat_submit'])) && ($_POST['cmessage'] != "") && (!$sql->db_Select('chatbox', '*', 'where cb_message="' . $_POST['cmessage'] . '" AND cb_datestamp+84600>' . time(), 'nowhere' , false)))
{

    // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
    // *				: 	$gold_param['gold_who_id''] (default no user)
    // *				:	$gold_param['gold_amount'] (default no amount)
    // *				:	$gold_param['gold_type'] (default "adjustment")
    // *				:	$gold_param['gold_action'] 	credit - add to account
    // *												debit - subtract from account
    // *				:	$gold_param['gold_plugin'] (default no plugin)
    // *				:	$gold_param['gold_log'] (default "")
    // *				:	$gold_param['gold_forum'] (default 0)
    $gold_param = array('gold_user_id' => USERID,
        'gold_who_id' => 0,
        'gold_amount' => $GOLD_PREF['gold_chatbox'],
        'gold_type' => LAN_GS_ACTION10,
        'gold_action' => "credit",
        'gold_plugin' => 'gold_system',
        'gold_log' => LAN_GS_RW004,
        "gold_forum" => 0);
    $gold_obj->gold_modify($gold_param);
    return;
}
// edit forum post.
if ($GOLD_PREF['forum_addsub'] == 1 && e_PAGE == 'forum_post.php' && (isset($_POST['update_thread']) || isset($_POST['update_reply'])) && strpos(e_QUERY, 'edit.') !== false)
{
    // saving of an edited post

    $gold_forum = explode('.', e_QUERY);
    $gold_forum_action = $gold_forum[0];
    $gold_forum_id = intval($gold_forum[1]);

    $gold_sql->db_Select('forum_t', 'thread_user,thread_thread,thread_parent', 'where thread_id="' . $gold_forum_id . '"', 'nowhere', false);
    $gold_row = $gold_sql->db_Fetch();
    $gold_ftmp = explode('.', $gold_row['thread_user'], 2);
    $gold_fposterid = $gold_ftmp[0];
    // calculate gold value of post
    $gold_prevpost_len = $tp->toFORM(strlen($gold_row['thread_thread']));
    $gold_newpost_len = strlen($tp->toDB($_POST['post']));
    if ($gold_row['thread_parent'] == 0)
    {
        // *
        // * This was a new thread
        // *
        // * Calculate old reward
        // *
        // if the post is longer than the minimum for a reward
        if ($GOLD_PREF['gold_reward_type'] == "post" && $gold_prevpost_len >= $GOLD_PREF['gold_threadmin'])
        {
            // if reward is based on post
            $gold_prevamount = $GOLD_PREF['gold_newthread_post'];
            // $gold_logmsg = LAN_GS_RW005;
        }
        if ($GOLD_PREF['gold_reward_type'] == "length")
        {
            // reward based on post length
            if ($gold_prevpost_len > $GOLD_PREF['gold_threadmin'])
            {
                $gold_prevamount = $GOLD_PREF['gold_newthread_length'];
                // $gold_logmsg .= LAN_GS_RW005;
            }
            if ($GOLD_PREF['gold_threadbonus'] > 0 && $GOLD_PREF['gold_threadrate'] > 0)
            {
                $gold_postprevbonus = intval($gold_prevpost_len / $GOLD_PREF['gold_threadrate']) * $GOLD_PREF['gold_threadbonus'];
            }
            else
            {
                $gold_postprevbonus = 0;
            }
        }
        // *
        // * Calculate new reward
        // *
        // if the post is longer than the minimum for a reward
        if ($GOLD_PREF['gold_reward_type'] == "post" && $gold_newpost_len >= $GOLD_PREF['gold_threadmin'])
        {
            // if reward is based on post
            $gold_newamount = $GOLD_PREF['gold_newthread_post'];
            // $gold_logmsg = LAN_GS_RW005;
        }
        if ($GOLD_PREF['gold_reward_type'] == "length")
        {
            // reward based on post length
            if ($gold_newpost_len > $GOLD_PREF['gold_threadmin'])
            {
                $gold_newamount = $GOLD_PREF['gold_newthread_length'];
                // $gold_logmsg .= LAN_GS_RW005;
            }
            if ($GOLD_PREF['gold_threadbonus'] > 0 && $GOLD_PREF['gold_threadrate'] > 0)
            {
                $gold_postnewbonus = intval($gold_newpost_len / $GOLD_PREF['gold_threadrate']) * $GOLD_PREF['gold_threadbonus'];
            }
            else
            {
                $gold_postnewbonus = 0;
            }
            $gold_prevamount = $gold_prevamount + $gold_postprevbonus;
            $gold_newamount = $gold_newamount + $gold_postnewbonus;
        }
    }
    else
    {
        // *
        // * This was a reply to a thread
        // *
        // * Calculate old reward
        // *
        // if the post is longer than the minimum for a reward
        if ($GOLD_PREF['gold_reward_type'] == "post" && $gold_prevpost_len >= $GOLD_PREF['gold_threadmin'])
        {
            // if reward is based on post
            $gold_prevamount = $GOLD_PREF['gold_reply_post'];
            // $gold_logmsg = LAN_GS_RW005;
        }
        if ($GOLD_PREF['gold_reward_type'] == "length")
        {
            // reward based on post length
            if ($gold_prevpost_len > $GOLD_PREF['gold_threadmin'])
            {
                $gold_prevamount = $GOLD_PREF['gold_reply_length'];
                // $gold_logmsg .= LAN_GS_RW005;
            }
            if ($GOLD_PREF['gold_threadbonus'] > 0 && $GOLD_PREF['gold_threadrate'] > 0)
            {
                $gold_postprevbonus = intval($gold_prevpost_len / $GOLD_PREF['gold_threadrate']) * $GOLD_PREF['gold_threadbonus'];
            }
            else
            {
                $gold_postprevbonus = 0;
            }
        }
        // *
        // * Calculate reply reward
        // *
        // if the post is longer than the minimum for a reward
        if ($GOLD_PREF['gold_reward_type'] == "post" && $gold_newpost_len >= $GOLD_PREF['gold_threadmin'])
        {
            // if reward is based on post
            $gold_newamount = $GOLD_PREF['gold_reply_post'];
            // $gold_logmsg = LAN_GS_RW005;
        }
        if ($GOLD_PREF['gold_reward_type'] == "length")
        {
            // reward based on post length
            if ($gold_newpost_len > $GOLD_PREF['gold_threadmin'])
            {
                $gold_newamount = $GOLD_PREF['gold_reply_length'];
                // $gold_logmsg .= LAN_GS_RW005;
            }
            if ($GOLD_PREF['gold_threadbonus'] > 0 && $GOLD_PREF['gold_threadrate'] > 0)
            {
                $gold_postnewbonus = intval($gold_newpost_len / $GOLD_PREF['gold_threadrate']) * $GOLD_PREF['gold_threadbonus'];
            }
            else
            {
                $gold_postnewbonus = 0;
            }
            $gold_prevamount = $gold_prevamount + $gold_postprevbonus;
            $gold_newamount = $gold_newamount + $gold_postnewbonus;
        }
    }

    if ($gold_prevamount > $gold_newamount)
    {
        // original had higher gold so deduct the difference
        $gold_amount = $gold_prevamount - $gold_newamount;
        // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
        // *				: 	$gold_param['gold_who_id''] (default no user)
        // *				:	$gold_param['gold_amount'] (default no amount)
        // *				:	$gold_param['gold_type'] (default "adjustment")
        // *				:	$gold_param['gold_action'] 	credit - add to account
        // *												debit - subtract from account
        // *				:	$gold_param['gold_plugin'] (default no plugin)
        // *				:	$gold_param['gold_log'] (default "")
        // *				:	$gold_param['gold_forum'] (default 0)
        $gold_param = array('gold_user_id' => $gold_fposterid,
            'gold_who_id' => 0,
            'gold_amount' => $gold_amount,
            'gold_plugin' => 'gold_system',
            'gold_type' => LAN_GS_ACTION03,
            'gold_action' => 'debit',
            'gold_log' => LAN_GS_RW011 . $gold_forum_id . LAN_GS_RW012 . USERNAME . '.' . LAN_GS_RW013 . ' ' . $gold_amount,
            "gold_forum" => 1);
        $gold_obj->gold_modify($gold_param);
    }
    if ($gold_prevamount < $gold_newamount)
    {
        // original had lower gold so add the difference
        $gold_amount = $gold_newamount - $gold_prevamount;
        // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
        // *				: 	$gold_param['gold_who_id''] (default no user)
        // *				:	$gold_param['gold_amount'] (default no amount)
        // *				:	$gold_param['gold_type'] (default "adjustment")
        // *				:	$gold_param['gold_action'] 	credit - add to account
        // *												debit - subtract from account
        // *				:	$gold_param['gold_plugin'] (default no plugin)
        // *				:	$gold_param['gold_log'] (default "")
        // *				:	$gold_param['gold_forum'] (default 0)
        $gold_param = array('gold_user_id' => $gold_fposterid,
            'gold_who_id' => 0,
            'gold_amount' => $gold_amount,
            'gold_plugin' => 'gold_system',
            'gold_type' => LAN_GS_ACTION03,
            'gold_action' => 'credit',
            'gold_log' => LAN_GS_RW014 . $gold_forum_id . LAN_GS_RW015 . USERNAME . '.' . LAN_GS_RW016 . ' ' . $gold_amount,
            "gold_forum" => 1);
        $gold_obj->gold_modify($gold_param);
    }
    // die("W");
}
if ((e_PAGE == "forum_post.php") && (isset($_POST['newthread'])) && (!$sql->db_Select("forum_t", "*", "thread_thread='" . $_POST['post'] . "' AND thread_name='' AND thread_user='" . USERID . "." . USERNAME . "' AND thread_lastpost+84600>" . time())))
{
    // Credit user for a new thread in the forum
    $gold_postlen = $tp->toDB(strlen($_POST['post']));
    // if the post is longer than the minimum for a reward
    if ($GOLD_PREF['gold_reward_type'] == "post" && $gold_postlen >= $GOLD_PREF['gold_threadmin'])
    {
        // if reward is based on post
        $gold_amount = $GOLD_PREF['gold_newthread_post'];
        $gold_logmsg = LAN_GS_RW005;
    }
    if ($GOLD_PREF['gold_reward_type'] == "length")
    {
        // reward based on post length
        if ($gold_postlen > $GOLD_PREF['gold_threadmin'])
        {
            $gold_amount = $GOLD_PREF['gold_newthread_length'];
            $gold_logmsg .= LAN_GS_RW005;
        }
        if ($GOLD_PREF['gold_threadbonus'] > 0 && $GOLD_PREF['gold_threadrate'] > 0)
        {
            $gold_postbonus = intval($gold_postlen / $GOLD_PREF['gold_threadrate']) * $GOLD_PREF['gold_threadbonus'];

            if ($gold_postbonus > 0)
            {
                $gold_logmsg .= ' ' . LAN_GS_RW009 . ' ' . $gold_postbonus;
            }
        }
        else
        {
            $gold_postbonus = 0;
        }
        $gold_amount = $gold_amount + $gold_postbonus;
    }
    if ($gold_amount > 0)
    {
        // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
        // *				: 	$gold_param['gold_who_id''] (default no user)
        // *				:	$gold_param['gold_amount'] (default no amount)
        // *				:	$gold_param['gold_type'] (default "adjustment")
        // *				:	$gold_param['gold_action'] 	credit - add to account
        // *												debit - subtract from account
        // *				:	$gold_param['gold_plugin'] (default no plugin)
        // *				:	$gold_param['gold_log'] (default "")
        // *				:	$gold_param['gold_forum'] (default 0)
        $gold_param = array('gold_user_id' => USERID,
            'gold_who_id' => 0,
            'gold_amount' => $gold_amount,
            'gold_plugin' => 'gold_system',
            'gold_type' => LAN_GS_ACTION03,
            'gold_action' => 'credit',
            'gold_log' => $gold_logmsg,
            "gold_forum" => 1);
        $gold_obj->gold_modify($gold_param);
    }
    return;
}

if ((e_PAGE == 'forum_post.php') && (isset($_POST['reply'])) && (!$sql->db_Select("forum_t", "*", "thread_thread='" . $_POST['post'] . "' AND thread_name='' AND thread_user='" . USERID . "." . USERNAME . "' AND thread_lastpost+84600>" . time())))
{
    // Credit user for a new thread in the forum
    $gold_postlen = $tp->toDB(strlen($_POST['post']));
    // if the post is longer than the minimum for a reward
    if ($GOLD_PREF['gold_reward_type'] == "post" && $gold_postlen >= $GOLD_PREF['gold_threadmin'])
    {
        // if reward is based on post
        $gold_amount = $GOLD_PREF['gold_reply_post'];
        $gold_logmsg = LAN_GS_RW010;
    }
    if ($GOLD_PREF['gold_reward_type'] == "length")
    {
        // reward based on post length
        if ($gold_postlen > $GOLD_PREF['gold_threadmin'])
        {
            $gold_amount = $GOLD_PREF['gold_reply_length'];
            $gold_logmsg .= LAN_GS_RW010;
        }
        if ($GOLD_PREF['gold_threadbonus'] > 0 && $GOLD_PREF['gold_threadrate'] > 0)
        {
            $gold_postbonus = intval($gold_postlen / $GOLD_PREF['gold_threadrate']) * $GOLD_PREF['gold_threadbonus'];

            if ($gold_postbonus > 0)
            {
                $gold_logmsg .= ' ' . LAN_GS_RW009 . ' ' . $gold_postbonus;
            }
        }
        else
        {
            $gold_postbonus = 0;
        }
        $gold_amount = $gold_amount + $gold_postbonus;
    }
    if ($gold_amount > 0)
    {
        // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
        // *				: 	$gold_param['gold_who_id''] (default no user)
        // *				:	$gold_param['gold_amount'] (default no amount)
        // *				:	$gold_param['gold_type'] (default "adjustment")
        // *				:	$gold_param['gold_action'] 	credit - add to account
        // *												debit - subtract from account
        // *				:	$gold_param['gold_plugin'] (default no plugin)
        // *				:	$gold_param['gold_log'] (default "")
        // *				:	$gold_param['gold_forum'] (default 0)
        $gold_param = array('gold_user_id' => USERID,
            'gold_who_id' => 0,
            'gold_amount' => $gold_amount,
            'gold_plugin' => 'gold_system',
            'gold_type' => LAN_GS_ACTION03,
            'gold_action' => 'credit',
            'gold_log' => $gold_logmsg,
            "gold_forum" => 1);
        $gold_obj->gold_modify($gold_param);
    }
    return;
    // // Credit user for a reply in the forum
    // if ($GOLD_PREF['gold_reward_type'] == "post")
    // {
    // // rewarding for the post irrespective of length
    // $gold_amount = $GOLD_PREF['gold_reply_post'];
    // }
    // else
    // {
    // if (strlen($_POST['post']) <= $GOLD_PREF['gold_threadmin'])
    // {
    // $gold_amount = $GOLD_PREF['gold_reply_post'];
    // }
    // else
    // {
    // $gold_amount = $GOLD_PREF['gold_reply_length'] ;
    // }
    // }
    // // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
    // // *				: 	$gold_param['gold_who_id''] (default no user)
    // // *				:	$gold_param['gold_amount'] (default no amount)
    // // *				:	$gold_param['gold_type'] (default "adjustment")
    // // *				:	$gold_param['gold_action'] 	credit - add to account
    // // *												debit - subtract from account
    // // *				:	$gold_param['gold_plugin'] (default no plugin)
    // // *				:	$gold_param['gold_log'] (default "")
    // // *				:	$gold_param['gold_forum'] (default 0)
    // $gold_param = array('gold_user_id' => USERID,
    // 'gold_who_id' => 0,
    // 'gold_amount' => $gold_amount,
    // 'gold_plugin' => 'gold_system',
    // 'gold_type' => LAN_GS_ACTION03,
    // 'gold_action' => "credit",
    // 'gold_log' => LAN_GS_RW006,
    // "gold_forum" => intval($gold_forumid));
    // $gold_obj->gold_modify($gold_param);
    // return;
}
// Old Auto Arcade Integration
$e_event->register('newscore', 'reward_newsscore');
function reward_newsscore ()
{
    global $GOLD_PREF, $gold_obj;
    // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
    // *				: 	$gold_param['gold_who_id''] (default no user)
    // *				:	$gold_param['gold_amount'] (default no amount)
    // *				:	$gold_param['gold_type'] (default "adjustment")
    // *				:	$gold_param['gold_action'] 	credit - add to account
    // *												debit - subtract from account
    // *				:	$gold_param['gold_plugin'] (default no plugin)
    // *				:	$gold_param['gold_log'] (default "")
    // *				:	$gold_param['gold_forum'] (default 0)
    $gold_param = array('gold_user_id' => USERID,
        'gold_amount' => $GOLD_PREF['gold_score'],
        'gold_plugin' => 'gold_system',
        'gold_type' => LAN_GS_ACTION11,
        'gold_action' => "credit",
        'gold_log' => LAN_GS_RW007,
        "gold_forum" => 0);
    $gold_obj->gold_modify($gold_param);
}
// Credit them for posting a new comment
if ((isset($_POST['commentsubmit'])) || (isset($_POST['AutoGal_SumbitComment'])))
{
    global $GOLD_PREF, $gold_obj;
    // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
    // *				: 	$gold_param['gold_who_id''] (default no user)
    // *				:	$gold_param['gold_amount'] (default no amount)
    // *				:	$gold_param['gold_type'] (default "adjustment")
    // *				:	$gold_param['gold_action'] 	credit - add to account
    // *												debit - subtract from account
    // *				:	$gold_param['gold_plugin'] (default no plugin)
    // *				:	$gold_param['gold_log'] (default "")
    // *				:	$gold_param['gold_forum'] (default 0)
    $gold_param = array('gold_user_id' => USERID,
        'gold_who_id' => 0,
        'gold_amount' => $GOLD_PREF['gold_comment'],
        'gold_plugin' => 'gold_system',
        'gold_type' => LAN_GS_ACTION04,
        'gold_action' => "credit",
        'gold_log' => LAN_GS_RW003,
        "gold_forum" => 0);
    $gold_obj->gold_modify($gold_param);

    return;
}
// COPPERMINE: USER ADDS COMMENT
if ((e_PAGE == 'db_input.php') && (isset($_POST['msg_body'])))
{
    // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
    // *				: 	$gold_param['gold_who_id''] (default no user)
    // *				:	$gold_param['gold_amount'] (default no amount)
    // *				:	$gold_param['gold_type'] (default "adjustment")
    // *				:	$gold_param['gold_action'] 	credit - add to account
    // *												debit - subtract from account
    // *				:	$gold_param['gold_plugin'] (default no plugin)
    // *				:	$gold_param['gold_log'] (default "")
    // *				:	$gold_param['gold_forum'] (default 0)
    $gold_param = array('gold_user_id' => USERID,
        'gold_who_id' => 0,
        'gold_amount' => $gold_amount,
        'gold_plugin' => 'gold_system',
        'gold_type' => LAN_GS_ACTION09,
        'gold_action' => "credit",
        'gold_log' => LAN_GS_RW008,
        "gold_forum" => 0);
    $gold_obj->gold_modify($gold_param);

    return;
}
// USER SUBMITS LINK
$e_event->register('linksub', 'reward_linksubmission');
function reward_linksubmission ($glink)
{
    global $GOLD_PREF, $gold_obj;
    $gold_balance = $gold_obj->gold_balance(USERID);

    if (($GOLD_PREF['gold_linkcost'] > 0 && intval($GOLD_PREF['gold_linkaction']) == 0) || ($GOLD_PREF['gold_linkcost'] > 0 && $gold_balance >= $GOLD_PREF['gold_linkcost'] && $GOLD_PREF['gold_linkaction'] == 1))
    {
        // if we reward or if we charge and they have sufficient balance and there is a charge
        if ($GOLD_PREF['gold_linkaction'] == 1)
        {
            // charge for link submission
            $gold_action = 'debit';
            $gold_log = LAN_GS_RW103;
            $gold_amount = $GOLD_PREF['gold_linkcost'] * -1;
        }
        else
        {
            $gold_action = "credit";
            $gold_log = LAN_GS_RW002;
            $gold_amount = $GOLD_PREF['gold_linkcost'];
        }
        // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
        // *				: 	$gold_param['gold_who_id''] (default no user)
        // *				:	$gold_param['gold_amount'] (default no amount)
        // *				:	$gold_param['gold_type'] (default "adjustment")
        // *				:	$gold_param['gold_action'] 	credit - add to account
        // *												debit - subtract from account
        // *				:	$gold_param['gold_plugin'] (default no plugin)
        // *				:	$gold_param['gold_log'] (default "")
        // *				:	$gold_param['gold_forum'] (default 0)
        $gold_param = array('gold_user_id' => USERID,
            'gold_who_id' => 0,
            'gold_amount' => $gold_amount,
            'gold_plugin' => 'gold_system',
            'gold_type' => LAN_GS_ACTION07,
            'gold_action' => $gold_action,
            'gold_log' => $gold_log . ' : ' . $glink['link_name'],
            "gold_forum" => 0);
        $gold_obj->gold_modify($gold_param);
    }
    else
    {
        // insufficient funds
        $site = SITEURL . 'index.php';
        $alert = LAN_GS_RW101 . ' ' . $GOLD_PREF['gold_currency_name'] . ' ' . LAN_GS_RW102;
        echo "<script>alert('{$alert}'); document.location = '{$site}';</script>";
        exit;
    }
    // return;
}
// USER SUBMITS NEWS
$e_event->register('subnews', 'reward_newssubmission');
function reward_newssubmission ()
{
    global $GOLD_PREF, $gold_obj;
    // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
    // *				: 	$gold_param['gold_who_id''] (default no user)
    // *				:	$gold_param['gold_amount'] (default no amount)
    // *				:	$gold_param['gold_type'] (default "adjustment")
    // *				:	$gold_param['gold_action'] 	credit - add to account
    // *												debit - subtract from account
    // *				:	$gold_param['gold_plugin'] (default no plugin)
    // *				:	$gold_param['gold_log'] (default "")
    // *				:	$gold_param['gold_forum'] (default 0)
    $gold_param = array('gold_user_id' => USERID,
        'gold_who_id' => 0,
        'gold_amount' => $GOLD_PREF['gold_news'],
        'gold_plugin' => 'gold_system',
        'gold_type' => LAN_GS_ACTION06,
        'gold_action' => "credit",
        'gold_log' => LAN_GS_RW001,
        "gold_forum" => 0);
    $gold_obj->gold_modify($gold_param);
}
// END REWARDS
// ///////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////
// START CHARGES
// gold reward for visit if it is a user
if (USER)
{
    // get the day number of this time
    $gold_currentvisit = date('z', time() + ($pref['time_offset'] * 3600));
    // $gold_currentvisit = 2;
    if (intval($gold_obj->gold_additional[USERID]['gold_last_visit']) == 0 || intval($gold_obj->gold_additional[USERID]['gold_last_visit']) > 366)
    {
        // if no date set up then don't reward or penalize
        // until they have visited at least once since this was set up
        $gold_lastvisit = $gold_currentvisit;
    }
    else
    {
        $gold_lastvisit = intval($gold_obj->gold_additional[USERID]['gold_last_visit']);
    }
    // $gold_lastvisit=320;
    // check if we get reward for visit
    // and the day number of the last visit is not the same as the day number for today
    // calc the number of days elapsed since last visit
    $gold_difference = $gold_currentvisit - $gold_lastvisit;

    if ($gold_currentvisit < $gold_lastvisit)
    {
        // if the current visit is less than the last visit then we are in to a new year
        // so add 365
        // Never penalize for more than 365 days
        $gold_difference = 365 - abs($gold_difference);
        if ($gold_difference < 0)
        {
            $gold_difference = 365;
        }
    }

    if ($GOLD_PREF['gold_visit'] != 0 && $gold_difference > 0)
    {
        // new day so add gold if any
        require_once(e_HANDLER . 'date_handler.php');
        if (!is_object($gold_conv))
        {
            $gold_conv = new convert;
        }
        $gold_param = array('gold_user_id' => USERID,
            'gold_who_id' => 0,
            'gold_amount' => $GOLD_PREF['gold_visit'],
            'gold_plugin' => 'gold_system',
            'gold_type' => LAN_GS_ACTION12,
            'gold_action' => "credit",
            'gold_log' => LAN_GS_RW104 . ' ' . $gold_conv->convert_date(time(), 'short'),
            "gold_forum" => 0);
        $gold_obj->gold_modify($gold_param);
    }
    if ($GOLD_PREF['gold_tarnish'] != 0 && $gold_difference > 0 && $gold_difference > $GOLD_PREF['gold_tarnishwait'] && $GOLD_PREF['gold_tarnishmax'] > 0)
    {
        // If we have to wait to add tarnish (>0)
        if ($GOLD_PREF['gold_tarnishwait'] > 0 && $gold_difference > $GOLD_PREF['gold_tarnishwait'])
        {
            // the difference is the number of days since last visit - the waiting time
            $gold_difference = $gold_difference - $GOLD_PREF['gold_tarnishwait'];
        }
        if ($gold_difference > $GOLD_PREF['gold_tarnishmax'])
        {
            // Check that it is not more than the maximum tarnish
            // if it is then make it the max tarnish
            $gold_difference = $GOLD_PREF['gold_tarnishmax'];
        }
        if ($gold_difference > 0)
        {
            // this is the amount of tarnish to apply
            require_once(e_HANDLER . 'date_handler.php');
            if (!is_object($gold_conv))
            {
                $gold_conv = new convert;
            }
            $gold_param = array('gold_user_id' => USERID,
                'gold_who_id' => 0,
                'gold_amount' => $GOLD_PREF['gold_tarnish'] * $gold_difference,
                'gold_plugin' => 'gold_system',
                'gold_type' => LAN_GS_ACTION12,
                'gold_action' => 'debit',
                'gold_log' => LAN_GS_RW105 . ' ' . $gold_difference . ' ' . LAN_GS_RW106,
                "gold_forum" => 0);
            $gold_obj->gold_modify($gold_param);
        }
    }
    // Update the gold user with details of the last and current visit details
    $gold_obj->gold_additional[USERID]['gold_last_visit'] = $gold_currentvisit;
    $gold_tmp = $eArrayStorage->WriteArray($gold_obj->gold_additional[USERID]);
    $gold_obj->write_additional(USERID);
}

session_start();

$gold_tmp = explode('.', e_QUERY);
$gold_goview = $gold_tmp[1];
// if the page we are going to is user.php or newuser.php
// and we are not looking at the same user as last time
// and it is not our own profile
// and there is a cost to view profile
if (!check_class($GOLD_PREF['gold_exempt_usersettings']) && ((e_PAGE == 'newuser.php' || e_PAGE == 'user.php') && $gold_goview != $_SESSION['gold_ulastid'] && USERID != $gold_goview && $gold_tmp[0] == 'id' && $GOLD_PREF['gold_usrcost'] > 0))
{
    header('Location:' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/gold_user.php?' . e_QUERY);
    exit;
    return;
}
if (e_PAGE == 'request.php' && $gold_obj->plugin_active['gold_download'])
{
    session_start();
    $gold_tmp = explode('?', $_SESSION['gold_dl']);
    if ($_SESSION['gold_dl'] === 0 || e_QUERY != $gold_tmp[1])
    {
        // not got an OK for download
        // go and display query page
        header('Location:' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/gold_dl.php?' . e_QUERY);
        exit;
    }
    else
    {
        session_start();
        $_SESSION['gold_dl'] = 0;
        // we have got the OK
        $gold_balance = $gold_obj->gold_balance(USERID);
        if ($gold_balance >= $GOLD_PREF['gold_download'])
        {
            $gold_amount = $GOLD_PREF['gold_download'];
            $gold_param = array('gold_user_id' => USERID,
                'gold_who_id' => 0,
                'gold_amount' => $gold_amount,
                'gold_plugin' => 'gold_system',
                'gold_type' => LAN_GS_ACTION05,
                'gold_action' => 'debit',
                'gold_log' => LAN_GS_DL01);
            $gold_obj->gold_modify($gold_param);
        }
        else
        {
            // insufficient funds
            $site = SITEURL . "index.php";
            $alert = LAN_GS_3 . ' ' . $GOLD_PREF['gold_currency_name'] . ' ' . LAN_GS_2;
            echo "<script>alert('{$alert}'); document.location = '{$site}';</script>";
            exit;
        }
    }
    return;
}
// END CHARGES
// ///////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////
// START FUNCTIONS - all are moved to gold class
// and are to be considered deprecated
function check_gold($gold_required, $action)
{
    // should only used by download
    // deprecated
}
function show_orb($uid, $uname)
{
    // deprecated use class
    global $gold_obj;
    return $gold_obj->show_orb($uid, $uname);
}
function buy_orb($item, $uid = USERID)
{
    // deprecated use class
    global $gold_obj;
    $gold_obj->buy_orb($item, $uid = USERID);
}
function orb_exists($item, $uid = USERID)
{
    // deprecated use class
    global $gold_obj;
    return $gold_obj->orb_exists($item, $uid = USERID);
}
function wield_orb($item, $uid = USERID)
{
    // deprecated use class
    global $gold_obj;
    $gold_obj->wield_orb($item, $uid = USERID);
}
function formation($amount)
{
    // deprecated use class
    global $gold_obj;
    return $gold_obj->formation($amount);
}
function donate_gold($amount, $user)
{
    // deprecated use class
    global $gold_obj;
    return $gold_obj->donate_gold($amount, $user);
}
function send_gold($amount, $user_name)
{
    // this is not needed I think
    // deprecated use class
    global $gold_obj;
    return $gold_obj->formation($amount);
}
function gold_history($uid, $type, $amount, $who, $comment)
{
}
function spending($amount, $uid)
{
    // this is not needed I think
    // deprecated
}
function spent($uid)
{
    // deprecated use class
    global $gold_obj;
    return $gold_obj->spent($uid);
}
function set_gold($amount, $uid)
{
    // deprecated use class
    global $gold_obj;
    $gold_obj->gold_set($amount, $uid);
}

function subtract_gold($amount, $uid)
{
    // deprecated use class
    global $gold_obj;
    $gold_obj->subtract_gold($amount, $uid);
}

function add_gold($amount, $uid)
{
    // deprecated use class
    global $gold_obj;
    $gold_obj->add_gold($amount, $uid);
}
function gold($uid)
{
    // deprecated use class
    global $gold_obj;
    return $gold_obj->gold_balance($gold_userid = USERID);
}

function select_user($gs_form_name, $gs_form_value)
{
    // deprecated use class
    global $gold_obj;
    return $gold_obj->select_user($gs_form_name, $gs_form_value);
}
// END FUNCTIONS
// ///////////////////////////////////////////////////////////

?>