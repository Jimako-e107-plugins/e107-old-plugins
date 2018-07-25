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
class gold
{
    var $squad_adminclass = false; // is user an admin
    var $gold_member = array();
    var $gold_additional = array();
    var $gold_plugins = array(); // installed plugins
    var $gold_nmessage = "";
    function gold()
    {
        global $GOLD_PREF, $pref, $tp, $gold_sql, $gorb_obj;
        // get all the user's details
        $this->load_prefs();
        // create a gold sql object
        if (!is_object($gold_sql))
        {
            $gold_sql = new db;
        }

        if (USER)
        {
            $this->load_gold(USERID);
        }
        $GOLD_PREF['gold_installed']['gold_system'] = 1;
        // print_r($GOLD_PREF['gold_installed']);
        $this->gold_plugins = $GOLD_PREF['gold_installed'];

        if (file_exists(e_THEME . 'gold_system_template.php'))
        {
            define(GOLD_THEME, e_THEME . 'gold_system_template.php');
        }
        else
        {
            define(GOLD_THEME, e_PLUGIN . 'gold_system/templates/gold_system_template.php');
        }
        if (isset($pref['plugin_installed']['gold_orb']) && $this->plugin_active('gold_orb'))
        {
            require_once(e_PLUGIN . 'gold_orb/includes/gold_orb_class.php');
            if (!is_object($gorb_obj))
            {
                $gorb_obj = new gold_orb;
            }
        }
    }
    // ********************************************************************************************
    // *
    // * Gold System Load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $GOLD_PREF;
        if (isset($pref['gold_currency_abrev']))
        {
            // transfer old prefs to new if they exist
            $GOLD_PREF['gold_reward_type'] = $pref['gold_reward_type'];
            unset($pref['gold_reward_type']);
            $GOLD_PREF['gold_currency_name'] = $pref['gold_currency_name'];
            unset($pref['gold_currency_name']);
            $GOLD_PREF['gold_currency_decimal'] = $pref['gold_currency_decimal'];
            unset($pref['gold_currency_decimal']);
            $GOLD_PREF['gold_currency_abrev'] = $pref['gold_currency_abrev'];
            unset($pref['gold_currency_abrev']);
            $GOLD_PREF['gold_currency_formation'] = $pref['gold_currency_formation'];
            unset($pref['gold_currency_formation']);
            $GOLD_PREF['gold_richest_members'] = $pref['gold_richest_members'];
            unset($pref['gold_richest_members']);
            $GOLD_PREF['gold_starting'] = $pref['gold_starting'];
            unset($pref['gold_starting']);
            $GOLD_PREF['gold_chatbox'] = $pref['gold_chatbox'];
            unset($pref['gold_chatbox']);
            $GOLD_PREF['gold_newthread'] = $pref['gold_newthread'];
            unset($pref['gold_newthread']);
            $GOLD_PREF['gold_reply'] = $pref['gold_reply'];
            unset($pref['gold_reply']);
            $GOLD_PREF['gold_comment'] = $pref['gold_comment'];
            unset($pref['gold_comment']);
            $GOLD_PREF['gold_referrer'] = $pref['gold_referrer'];
            unset($pref['gold_referrer']);
            $GOLD_PREF['gold_download'] = $pref['gold_download'];
            unset($pref['gold_download']);
            $GOLD_PREF['gold_link'] = $pref['gold_link'];
            unset($pref['gold_link']);
            $GOLD_PREF['gold_news'] = $pref['gold_news'];
            unset($pref['gold_news']);
            $GOLD_PREF['gold_score'] = $pref['gold_score'];
            unset($pref['gold_score']);
            $GOLD_PREF['forum_layout_1'] = $pref['forum_layout_1'];
            unset($pref['forum_layout_1']);
            $GOLD_PREF['forum_layout_2'] = $pref['forum_layout_2'];
            unset($pref['forum_layout_2']);
            $GOLD_PREF['forum_layout_3'] = $pref['forum_layout_3'];
            unset($pref['forum_layout_3']);
            $GOLD_PREF['forum_layout_4'] = $pref['forum_layout_4'];
            unset($pref['forum_layout_4']);
            $GOLD_PREF['forum_layout_5'] = $pref['forum_layout_5'];
            unset($pref['forum_layout_5']);
            $GOLD_PREF['forum_layout_6'] = $pref['forum_layout_6'];
            unset($pref['forum_layout_6']);
            $GOLD_PREF['forum_layout_7'] = $pref['forum_layout_7'];
            unset($pref['forum_layout_7']);
            $GOLD_PREF['forum_layout_8'] = $pref['forum_layout_8'];
            unset($pref['forum_layout_8']);
            $GOLD_PREF['forum_layout_9'] = $pref['forum_layout_9'];
            unset($pref['forum_layout_9']);
            $GOLD_PREF['forum_layout_10'] = $pref['forum_layout_10'];
            unset($pref['forum_layout_10']);
            $GOLD_PREF['forum_layout_11'] = $pref['forum_layout_11'];
            unset($pref['forum_layout_11']);
            $GOLD_PREF['gold_arcade_type'] = $pref['gold_arcade_type'];
            unset($pref['gold_arcade_type']);
            $GOLD_PREF['buy_gold_account'] = $pref['buy_gold_account'];
            unset($pref['buy_gold_account']);
            $GOLD_PREF['buy_gold_notify_url'] = $pref['buy_gold_notify_url'];
            unset($pref['buy_gold_notify_url']);
            $GOLD_PREF['buy_gold_return_url'] = $pref['buy_gold_return_url'];
            unset($pref['buy_gold_return_url']);
            $GOLD_PREF['buy_gold_cancel_url'] = $pref['buy_gold_cancel_url'];
            unset($pref['buy_gold_cancel_url']);
            $GOLD_PREF['buy_gold_currency'] = $pref['buy_gold_currency'];
            unset($pref['buy_gold_currency']);
            $GOLD_PREF['buy_gold_item_name'] = $pref['buy_gold_item_name'];
            unset($pref['buy_gold_item_name']);
            $GOLD_PREF['buy_gold_cost'] = $pref['buy_gold_cost'];
            unset($pref['buy_gold_cost']);
            save_prefs();
            $this->save_prefs();
        }
        else
        {
            $GOLD_PREF = array('gold_reward_type' => 'post',
                'gold_currency_name' => 'Gold',
                'gold_currency_decimal' => 0,
                'gold_currency_abrev' => 'gold.gif',
                'gold_currency_formation' => 'suffix',
                'gold_richest_members' => 5,
                'gold_starting' => 1000,
                'gold_chatbox' => 15,
                'gold_newthread' => 100,
                'gold_reply' => 50,
                'gold_comment' => 25,
                'gold_referrer' => 1000,
                'gold_download' => 100,
                'gold_link' => 100,
                'gold_news' => 250,
                'gold_score' => 25,
                'gold_currency_point' => '.',
                'gold_currency_thou' => ',',
                'gold_numchar' => 3,
                'gold_usrcost' => 100,
                'gold_maxdonatepermonth' => 2000,
                'gold_linkcost' => 100,
                'gold_visit' => 100,
                'gold_tarnish' => 100,
                'gold_tarnishwait' => 10,
                'gold_tarnishmax' => 30,
                'gold_exempt_usersettings' => 255,
                'forum_layout_1' => 'custom_title',
                'forum_layout_2' => 'avatar',
                'forum_layout_3' => 'stars',
                'forum_layout_4' => 'rank',
                'forum_layout_5' => 'moderator',
                'forum_layout_6' => 'member',
                'forum_layout_7' => 'rpg',
                'forum_layout_8' => 'joined',
                'forum_layout_9' => 'posts',
                'forum_layout_10' => 'gold',
                'forum_layout_11' => 'spent',
                'buy_gold_account' => 'your email',
                'buy_gold_notify_url' => 'http://yoursite.com/plugins/gold_system/paypal.php',
                'buy_gold_return_url' => 'http://yoursite.com/',
                'buy_gold_cancel_url' => 'http://yoursite.com/',
                'buy_gold_currency' => 'GBP',
                'buy_gold_item_name' => 'Buy Gold',
                'buy_gold_cost' => 1,
                'buy_gold_perunit' => 1000,
                'forum_addsub' => 1,
                'gold_reward_type' => 1,
                'gold_threadmin' => 10,
                'gold_threadbonus' => 10,
                'gold_newthread_post' => 100,
                'gold_reply_post' => 100,
                'gold_newthread_length' => 100,
                'gold_reply_length' => 100,
                'gold_threadrate' => 20,);
        }
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($GOLD_PREF);
        $sql->db_Update('core', "e107_value='$tmp' where e107_name='gold'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $GOLD_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select('core', '*', "e107_name='gold' ");
        $row = $sql->db_Fetch();
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($GOLD_PREF);
            $sql->db_Insert('core', "'gold', '$tmp' ");
            $sql->db_Select('core', '*', "e107_name='gold' ");
        }
        else
        {
            $GOLD_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_modify($gold_param)
    // *
    // *				:	Use this method to modify the current balance of a user
    // *					It creates a single history entry of gold_type (default "adjustment")
    // *
    // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
    // *				: 	$gold_param['gold_who_id'] (default no user)
    // *				:	$gold_param['gold_amount'] (default no amount)
    // *				:	$gold_param['gold_type'] (default "adjustment")
    // *				:	$gold_param['gold_action'] 	credit - add to account
    // *												debit - subtract from account
    // *				:	$gold_param['gold_plugin'] (default no plugin)
    // *				:	$gold_param['gold_log'] (default "")
    // *				:	$gold_param['gold_forum'] (default 0)
    // *
    // *	Returns		:	$gold_return (array)
    // *				:	$gold_return['gold_error_no']
    // *						0 = OK
    // *						1 = No amount specified
    // *						2 = No Action specified
    // *						4 = No Plugin specified
    // *						8 = Specified plugin is not installed and active in gold
    // *						16 = No user specified
    // *						32 = Unable to update user record debit/credit
    // *						64 = Unable to update history record
    // *						128 = Invalid or missing parameter
    // *				:	$gold_return['gold_user_id'] user's ID
    // *				:	$gold_return['gold_amount'] amount CR/DR
    // *				:	$gold_return['gold_action'] action taken
    // *				:	$gold_return['gold_plugin'] calling plugin
    // *
    // *	Call this method to modify the balance of a member
    // * 	For example to credit some account do a modify add then a modify deduct
    // * 	Upto caller to determine if balance is OK
    // *
    // *
    // ***************************************************************************
    function gold_modify($gold_param, $gold_debug = false)
    {
        global $gold_sql, $pref, $tp, $GOLD_PREF;
        // set result array all to false
        // these are set to correct valuse if all successful
        if ($gold_debug)
        {
            print'gold_param<br /><pre>';
            print_r($gold_param);
            print '</pre>';
        }
        $gold_return['gold_error_no'] = 0;
        $gold_return['gold_user_id'] = false;
        $gold_return['gold_who_id'] = false;
        $gold_return['gold_recipient'] = false;
        $gold_return['gold_amount'] = false;
        $gold_return['gold_action'] = false;
        $gold_return['gold_plugin'] = false;
        $gold_return['gold_forum'] = false;
        // get the recipients gold details
        // if the recipient does not exist then insert them
        $this->load_gold($gold_param['user_id']);
        // Check parameters passed in OK and valid
        if (!is_array($gold_param))
        {
            // parameter error
            $gold_error = $gold_error | 128;
        }
        // parameters exist
        if (intval($gold_param['gold_user_id']) == 0)
        {
            // check user ID s passed  : cannot proceed if not specified
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 16;
        }
        // If no param passed then defaults to zero
        if (intval($gold_param['gold_who_id']) < 1)
        {
            $gold_param['gold_who_id'] = 0;
        }
        if (empty($gold_param['gold_type']))
        {
            // if no type specified then make it adjustment
            $gold_param['gold_type'] = 'adjustment';
        }
        if ($gold_param['gold_amount'] == 0)
        {
            // no amount specified : cannot proceed if not specified
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 1;
        }

        if ($gold_param['gold_action'] != 'credit' && $gold_param['gold_action'] != 'debit')
        {
            // no action specified : cannot proceed if not specified
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 2;
        }

        if (empty($gold_param['gold_plugin']))
        {
            // no plugin specified : cannot proceed if not specified
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 4;
        }

        if ($this->gold_plugins[$gold_param['gold_plugin']] != 1)
        {
            // add check that plugin is active and gold in use
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 8;
        }
        $gold_param['gold_forum'] = intval($gold_param['gold_forum']);
        // if not allowed to post html convert <br /> to \n
        // if (!check_class($pref['post_html']))
        // {
        // $gold_param['gold_log'] = str_replace('<br />', '\n', $gold_param['gold_log']);
        // }
        // If all ok so we carry out the action of credit or debit - any errors then skip this
        if ($gold_return['gold_error_no'] == 0)
        {
            if ($gold_param['gold_action'] == 'credit')
            {
                // add the amount to the user
                if (!$gold_sql->db_Update('gold_system', "gold_balance = gold_balance + '{$gold_param['gold_amount']}' ,gold_credit=gold_credit + '{$gold_param['gold_amount']}' where gold_id = '{$gold_param['gold_user_id']}'", $gold_debug))
                {
                    // Failed to add so return an error
                    $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 32;
                }
                else
                {
                    // added OK so
                    // insert history record
                    // recipient id - date, log, amount, sender, plugin, action
                    if (!$gold_sql->db_Insert('gold_system_history', "0,{$gold_param['gold_user_id']}," . (($pref['time_offset'] * 3600) + time()) . ",'{$gold_param['gold_type']}','{$gold_param['gold_amount']}','{$gold_param['gold_who_id']}','" . $tp->toDB($gold_param['gold_log']) . "','" . $tp->toDB($gold_param['gold_plugin']) . "',{$gold_param['gold_forum']}", $gold_debug))
                    {
                        // failed to add transaction history record
                        $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 64;
                    }
                }
            }
            if ($gold_param['gold_action'] == 'debit')
            {
                // deduct the amount
                if (!$gold_sql->db_Update('gold_system', "gold_balance = gold_balance - '" . $gold_param['gold_amount'] . "',gold_spent=gold_spent + '{$gold_param['gold_amount']}' where gold_id = '{$gold_param['gold_user_id']}'", $gold_debug))
                {
                    // failed to debit
                    $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 32;
                }
                else
                {
                    // insert history record
                    if (!$gold_sql->db_Insert('gold_system_history', "0,{$gold_param['gold_user_id']}," . (($pref['time_offset'] * 3600) + time()) . ",'{$gold_param['gold_type']}','" . ($gold_param['gold_amount'] * -1) . "','{$gold_param['gold_who_id']}','" . $tp->toDB($gold_param['gold_log']) . "','" . $tp->toDB($gold_param['gold_plugin']) . "',{$gold_param['gold_forum']}", $gold_debug))
                    {
                        // failed to add transaction history record
                        $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 64;
                    }
                }
            } // end deduct
        } // end if ($gold_error == 0)
        if ($gold_return['gold_error_no'] == 0)
        {
            $gold_return['gold_user_id'] = $gold_param['gold_user_id'];
            $gold_return['gold_who_id'] = $gold_param['gold_who_id'];
            $gold_return['gold_amount'] = $gold_param['gold_amount'];
            $gold_return['gold_action'] = $gold_param['gold_action'];
            $gold_return['gold_plugin'] = $gold_param['gold_plugin'];
        }

        $this->load_gold($gold_param['gold_user_id']);
        $this->load_gold($gold_param['gold_who_id']);
        return $gold_return;
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_transfer($gold_param)
    // *
    // *				:	Transfers gold from one member to another
    // *					Deducts from one account and adds to the other
    // *
    // *	Parameters	: 	$gold_param['gold_from_id'] FROM (required)
    // *				:	$gold_param['gold_to_id']  TO (required)
    // *				:	$gold_param['gold_amount'] (required)
    // *				:	$gold_param['gold_type'] (default "Sent")
    // *				:	$gold_param['gold_plugin'] (default no plugin)
    // *				:	$gold_param['gold_log'] (default "")
    // *
    // *	Returns		:	$gold_return (array)
    // *				:	$gold_return['gold_error_no']
    // *						0 = OK
    // *						1 = No amount specified
    // *						2 = Not Used
    // *						4 = No Plugin specified
    // *						8 = Specified plugin is not installed and active in gold
    // *						16 = No user specified
    // *						32 = Unable to update user record
    // *						64 = Unable to update history record
    // *						128 = Invalid or missing parameter
    // *				:	$gold_return['gold_user_id'] user's ID
    // *				:	$gold_return['gold_amount'] amount CR/DR
    // *				:	$gold_return['gold_action'] action taken
    // *				:	$gold_return['gold_plugin'] calling plugin
    // *
    // *	Call this method to modify the balance of a member
    // * 	For example to credit some account do a modify add then a modify deduct
    // * 	Upto caller to determine if balance is OK
    // *
    // *
    // ***************************************************************************
    function gold_transfer($gold_param)
    {
        global $gold_sql, $pref, $tp, $GOLD_PREF;
        // set result array all to false
        // these are set to correct valuse if all successful
        $gold_return['gold_error_no'] = 0;
        $gold_return['gold_user_id'] = false;
        $gold_return['gold_recipient'] = false;
        $gold_return['gold_amount'] = false;
        $gold_return['gold_plugin'] = false;
        // get the recipients gold details
        // if the recipient does not exist then insert them
        $this->load_gold($gold_param['gold_from_id']);
        $this->load_gold($gold_param['gold_to_id']);
        // Check parameters passed in OK and valid
        if (!is_array($gold_param))
        {
            // parameter error
            $gold_error = $gold_error | 128;
        }
        // parameters exist
        if (intval($gold_param['gold_from_id']) == 0 || intval($gold_param['gold_to_id']) == 0)
        {
            // check both sender and recipient ID s passed
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 16;
        }
        if ($gold_param['gold_amount'] == 0)
        {
            // no amount specified
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 1;
        }
        if (empty($gold_param['gold_plugin']))
        {
            // no plugin specified
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 4;
        }
        if ($this->gold_plugins[$gold_param['gold_plugin']] != 1)
        {
            // add check that plugin is active and gold in use
            $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 8;
        }
        // if not allowed to post html convert <br /> to \n
        // if (!check_class($pref['post_html']))
        // {
        // $gold_param['gold_log'] = str_replace('<br />', '\n', $gold_param['gold_log']);
        // }
        if ($gold_return['gold_error_no'] == 0)
        {
            // All ok so we carry out the action
            // add the amount tp the recipient
            if (!$gold_sql->db_Update('gold_system', "gold_balance = gold_balance + '{$gold_param['gold_amount']}' ,gold_credit=gold_credit + '{$gold_param['gold_amount']}' where gold_id =  '{$gold_param['gold_to_id']}'", false))
            {
                // failed to update user
                $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 32;
            }
            else
            {
                // insert history record
                // recipient id - date, log, amount, sender, plugin, action
                if (!$gold_sql->db_Insert('gold_system_history', "0,'{$gold_param['gold_to_id']}'," . (($pref['time_offset'] * 3600) + time()) . ",'{$gold_param['gold_type']}',{$gold_param['gold_amount']},{$gold_param['gold_from_id']},'" . $tp->toDB($gold_param['gold_log']) . "','" . $tp->toDB($gold_param['gold_plugin']) . "',0", false))
                {
                    // failed to update transaction record
                    $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 64;
                }
            }
            // deduct the amount
            if (!$gold_sql->db_Update('gold_system', "gold_balance = gold_balance - '{$gold_param['gold_amount']}',gold_spent=gold_spent + '{$gold_param['gold_amount']}' where gold_id = '{$gold_param['gold_from_id']}'", false))
            {
                // failed to deduct the amount
                $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 32;
            }
            else
            {
                // insert history record
                if (!$gold_sql->db_Insert('gold_system_history', "0,'{$gold_param['gold_from_id']}'," . (($pref['time_offset'] * 3600) + time()) . ",'{$gold_param['gold_type']}'," . $gold_param['gold_amount'] * -1 . ",{$gold_param['gold_to_id']},'" . $tp->toDB($gold_param['gold_log']) . "','" . $tp->toDB($gold_param['gold_plugin']) . "',0", false))
                {
                    // failed to update transaction history
                    $gold_return['gold_error_no'] = $gold_return['gold_error_no'] | 64;
                }
            }
        } // end if ($gold_error == 0)
        if ($gold_return['gold_error_no'] == 0)
        {
            $gold_return['gold_user_id'] = $gold_param['gold_sender_id'];
            $gold_return['gold_amount'] = $gold_param['gold_amount'];
            $gold_return['gold_action'] = $gold_param['gold_action'];
            $gold_return['gold_plugin'] = $gold_param['gold_plugin'];
        }

        $this->load_gold($gold_param['gold_sender_id']);
        $this->load_gold($gold_param['gold_from_id']);
        return $gold_return;
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_balance($gold_userid)
    // *
    // *	Parameters	: 	$gold_userid default USERID
    // *
    // *	Returns		:	$retval balance
    // *
    // ***************************************************************************
    function gold_balance($gold_userid = USERID)
    {
        // if the user already has their data loaded return that
        if (!array_key_exists($gold_userid, $this->gold_member))
        {
            // otherwise load the user data
            $this->load_gold($gold_userid);
        }
        return $this->gold_member[$gold_userid]['gold_balance'];
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_username($gold_userid)
    // *
    // *	Parameters	: 	$gold_userid default USERID
    // *
    // *	Returns		:	member name
    // *
    // ***************************************************************************
    function gold_username($gold_userid = USERID)
    {
        // if the user already has their data loaded return that
        if (!array_key_exists($gold_userid, $this->gold_member))
        {
            // otherwise load the user data
            $this->load_gold($gold_userid);
        }
        return $this->gold_member[$gold_userid]['user_name'];
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_set($amount, $uid)
    // *
    // *				:	Use this method to modify the current balance of a user
    // *					It creates a single history entry of gold_type (default "Manual Adjustment")
    // *
    // *
    // ***************************************************************************
    function gold_set($gold_setamount, $gold_userid)
    {
        $gold_param['gold_user_id'] = $gold_userid;
        $gold_param['gold_who_id'] = 0;
        $gold_param['gold_type'] = LAN_GS_CLS01;
        $gold_param['gold_plugin'] = '';
        $gold_param['gold_log'] = LAN_GS_CLS01;
        $gold_param['gold_forum'] = 0;
        $gold_param['gold_amount'] = $gold_setamount;
        if ($gold_setamount > 0)
        {
            $gold_setamount['gold_action'] = 'credit';
        } elseif ($amount < 0)
        {
            $gold_param['gold_action'] = 'debit';
        }
        $this->gold_modify($gold_param);
        $this->load_gold($gold_userid);
    }
    // ***************************************************************************
    // *
    // *	method 		: 	get_user_id($gold_username)
    // *
    // *	Parameters	: 	$gold_username as string
    // *
    // *	Returns		:	the user name for the user as string
    // *				:	FALSE if error retrieving
    // *
    // ***************************************************************************
    function get_user_id($gold_username)
    {
        global $gold_sql, $tp, $GOLD_PREF;
        $gold_arg = "select user_id,gold_id from #user left join #gold_system on user_id=gold_id where user_name='" . $tp->toDB($gold_username) . "'";
        if ($gold_sql->db_Select_gen($gold_arg, false))
        {
            // user exists in e107 and maybe gold_system
            $gold_row = $gold_sql->db_Fetch();
            if (intval($gold_row['gold_id']) == 0)
            {
                // user exists but not in gold_system
                // so add to gold system
                $this->load_gold($gold_row['user_id']);
            }
            $gold_retval = $gold_row['user_id'];
        }
        else
        {
            // not a user at all
            $gold_retval = false;
        }
        return $gold_retval;
    }
    // ***************************************************************************
    // *
    // *	method 		: 	formation($amount,$decimals=false)
    // *
    // *	Parameters	: 	$amount
    // *				:	$decimals as integer number of dec places default false
    // *					If false then the setting in admin config is used
    // *
    // *	Returns		:	formatted gold amount as string
    // *
    // ***************************************************************************
    function formation($amount, $decimals = false, $show_zero = true)
    {
        global $GOLD_PREF, $PLUGINS_DIRECTORY;
        if ($GOLD_PREF['gold_currency_abrev'] == 'gold.gif' || $GOLD_PREF['gold_currency_abrev'] == 'gold.png' || $GOLD_PREF['gold_currency_abrev'] == 'gold.jpg')
        {
            $abrev = "<img src='" . SITEURL . $PLUGINS_DIRECTORY . "gold_system/images/{$GOLD_PREF['gold_currency_abrev']}' style='border:0;' alt='gold' />";
        }
        else
        {
            $abrev = $GOLD_PREF['gold_currency_abrev'];
        }
        // if decimals not set or less than 0 places or more than 2 places
        // then set to system default
        if ($decimals < 0 || $decimals === false || $decimals > 2)
        {
            $decimals = $GOLD_PREF['gold_currency_decimal'];
        }
        // if no decimal point set set it to . period
        if (empty($GOLD_PREF['gold_currency_point']))
        {
            $GOLD_PREF['gold_currency_point'] = '.';
        }
        // if no thousands sep set then make it ,
        // cause the author is english!
        if (empty($GOLD_PREF['gold_currency_thou']))
        {
            $GOLD_PREF['gold_currency_thou'] = ',';
        }
        // format the number
        $amount = number_format($amount, $decimals, $GOLD_PREF['gold_currency_point'], $GOLD_PREF['gold_currency_thou']);
        // default prefix symbol
        if (!$show_zero && $amount == 0)
        {
            if ($GOLD_PREF[' gold_currency_formation'] == 'suffix')
            {
                return "  {$abrev}";
            }
            else
            {
                return " {$abrev} ";
            }
        }
        if ($GOLD_PREF['gold_currency_formation'] == 'suffix')
        {
            return "{$amount} {$abrev}";
        }
        else
        {
            return "{$abrev} {$amount}";
        }
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_spent($gold_userid = USERID)
    // *
    // *	Parameters	: 	$gold_userid as integer for user
    // *
    // *	Returns		:	gold spent as decimal
    // *				:
    // *
    // ***************************************************************************
    function gold_spent($gold_userid = USERID)
    {
        if (!array_key_exists($gold_userid, $this->gold_member))
        {
            $this->load_gold($gold_userid);
        }
        return $this->gold_member[$gold_userid]['gold_spent'];
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_received($gold_userid = USERID)
    // *
    // *	Parameters	: 	$gold_userid as integer for user
    // *
    // *	Returns		:	gold recieved as decimal
    // *
    // ***************************************************************************
    function gold_received($gold_userid = USERID)
    {
        if (!array_key_exists($gold_userid, $this->gold_member))
        {
            $this->load_gold($gold_userid);
            // retrieve from cached if we are getting the current user
        }
        return $this->gold_member[$gold_userid]['gold_credit'];
    }
    // ***************************************************************************
    // *
    // *	method 		: 	load_gold PRIVATE
    // *
    // *	Parameters	: 	$uid as integer - userid
    // *
    // *	Returns		:	Loads user details create new user if not in gold_system
    // *				:	store data in array $this->gold_member[]
    // *				:	and $this->gold_additional
    // *
    // ***************************************************************************
    function load_gold($gold_userid = USERID)
    {
        global $eArrayStorage, $GOLD_PREF, $gold_sql;
        if ($gold_userid > 0)
        {
            // only do it if they are a user otherwise nothing to get!
            $gold_arg = "select g.*,u.user_name,u.user_email,u.user_customtitle,u.user_join,u.user_lastvisit,user_currentvisit,u.user_chats,u.user_image,u.user_signature from #gold_system as g left join #user as u on user_id=gold_id  where gold_id={$gold_userid}";
            if ($gold_sql->db_Select_gen($gold_arg, false))
            {
                // get the data
                $this->gold_member[$gold_userid] = $gold_sql->db_Fetch();
                $this->gold_additional[$gold_userid] = $eArrayStorage->ReadArray($this->gold_member[$gold_userid]['gold_additional']);
            }
            else
            {
                // doesn't exist so create the user in gold_system then get all the data
                // print $GOLD_PREF['gold_starting'];
                $gold_sql->db_Insert('gold_system', "'" . $gold_userid . "', '{$GOLD_PREF['gold_starting']}', '0','0', '', '',''", false);
                $gold_arg = "select g.*,u.user_name,u.user_email,u.user_customtitle,u.user_join,u.user_lastvisit,user_currentvisit,u.user_forums,u.user_chats,u.user_image,u.user_signature from #gold_system as g left join #user as u on user_id=gold_id  where gold_id={$gold_userid}";
                if ($gold_sql->db_Select_gen($gold_arg, false))
                {
                    $this->gold_member[$gold_userid] = $gold_sql->db_Fetch();
                    $this->gold_additional[$gold_userid] = $eArrayStorage->ReadArray($this->gold_member[$gold_userid]['gold_additional']);
                }
            }
        }
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_notify($gold_pmto, $gold_pmfrom, $gold_pmsubject, $gold_pmmessage)
    // *
    // *	Parameters	:	$gold_pmto 			id of user to pm to
    // *				:	$gold_pmfrom		if of user sending the PM
    // *				:	$gold_pmsubject		subject for PM
    // *				:	$gold_pmmessage		Text of message
    // *
    // *	Returns		:	None
    // *				:	Loads user details creae new user if not in gold_system
    // *
    // ***************************************************************************
    function gold_notify($gold_pmto, $gold_pmfrom, $gold_pmsubject, $gold_pmmessage)
    {
        global $sysprefs, $retrieve_prefs, $pref, $PLUGINS_DIRECTORY;
        $retrieve_prefs[] = 'pm_prefs';
        if (!check_class($pref['post_html']))
        {
            // if the user's class doesn't allow html
            // replace br with newline
            $gold_pmmessage = str_replace('<br />', "\n", $gold_pmmessage);
            $findimg = strpos($gold_pmmessage, 'gold_system/images/gold.gif');
            if ($findimg > 0)
            {
                // replace image location for gold symbol
                $gold_pmmessage = eregi_replace("<img.*/>", '[img]' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/images/gold.gif[/img]', $gold_pmmessage);
            }
        }
        require_once(e_PLUGIN . 'pm/pm_class.php');
        require_once(e_PLUGIN . 'pm/pm_func.php');
        include_lan(e_PLUGIN . 'pm/languages/' . e_LANGUAGE . '.php');
        $pm_prefs = $sysprefs->getArray('pm_prefs');
        $this->load_gold($gold_pmto);
        $gold_pm = new private_message;
        $gold_vars['pm_subject'] = $gold_pmsubject;
        $gold_vars['pm_message'] = $gold_pmmessage;
        $gold_vars['to_info']['user_id'] = $gold_pmto;
        $gold_vars['to_info']['user_email'] = $this->gold_member[$gold_pmto]['user_email'];
        $gold_vars['to_info']['user_name'] = $this->gold_member[$gold_pmto]['user_name'];
        $gold_vars['to_info']['user_class'] = "";
        $gold_vars['from_id'] = $gold_pmfrom;
        $gold_posthtml = $pref['post_html'];
        $pref['post_html'] = 0;
        $res = $gold_pm->add($gold_vars);
        $pref['post_html'] = $gold_posthtml ;
    }
    // ***************************************************************************
    // *
    // *	method 		: 	orb_exists($item, $uid = USERID)
    // *
    // *	Parameters	: 	$item as string for orb
    // *				:	orb_fem orb_flame orb_toxin orb_frost
    // *				:	orb_dark orb_light
    // *				:	$uid as integer for user
    // *
    // *	Returns		:	true if user posesses
    // *				:	FALSE in not
    // *
    // ***************************************************************************
    function orb_exists($item, $gold_userid = USERID)
    {
        function wield_orb($item, $uid = USERID)
        {
            global $gorb_obj;
            return $gorb_obj->orb_exists($item, $gold_userid);
        }
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_time($item, $uid = USERID)
    // *
    // *	Parameters	: 	$$offset as integer - additional offset in seconds
    // *
    // *	Returns		:	integer : time corrected for server offset
    // *
    // ***************************************************************************
    function gold_time($offset = 0)
    {
        global $pref;
        return time() + ($pref['time_offset'] * 3600) + ($offset);
    }
    // ***************************************************************************
    // *
    // *	method 		: 	buy_orb($item, $uid = USERID)
    // *
    // *	Parameters	: 	$item as string for orb
    // *				:	orb_fem orb_flame orb_toxin orb_frost
    // *				:	orb_dark orb_light
    // *				:	$uid as integer for user
    // *
    // *	Returns		:	nothing
    // *				:
    // *				: Function now deprecated handled in gold_orb plugin
    // ***************************************************************************
    function buy_orb($item, $uid = USERID)
    {
        global $gorb_obj;
        $gorb_obj->buy_orb($item, $uid);
    }
    // ***************************************************************************
    // *
    // *	method 		: 	wield_orb($item, $uid = USERID)
    // *
    // *	Parameters	: 	$uid as integer for user
    // *				:	$item as string object to be wielded
    // *
    // *	Returns		:	true if no error
    // *				:	false if failed to wield
    // *				:	Function deprecated now handled in gold orb plugin
    // ***************************************************************************
    function wield_orb($item, $uid = USERID)
    {
        global $gorb_obj;
        return $gorb_obj->wield_orb($item, $uid);
    }
    // depracated
    function donate_gold($amount, $user)
    {
        global $GOLD_PREF;
        if ($GOLD_PREF['gold_currency_formation'] == 'suffix')
        {
            return "{$amount}<a href='javascript:void(0)'  onclick=\"popup_show('popup', 'popup_drag', 'popup_exit', 'mouse-corner', -10, -10); document.gold_form.user.value='{$user}'\">{$abrev}</a>";
        }
        else
        {
            return "<a href='javascript:void(0)' onclick=\"popup_show('popup', 'popup_drag', 'popup_exit', 'mouse-corner', -10, -10); document.gold_form.user.value='{$user}'\">{$abrev}</a>{$amount}";
        }
    }
    // ***************************************************************************
    // *
    // *	method 		: 	show_orb($uid, $uname)
    // *
    // *	Parameters	: 	$uid as integer for user
    // *				:	$uname as string for user name
    // *
    // *	Returns		:	username or the orbed name as a string
    // *				:
    // *				: 	Function deprecated now handled in gold orb plugin
    // ***************************************************************************
    function show_orb($uid, $uname)
    {
        global $gorb_obj;
        if (is_object($gorb_obj))
        {
            return $gorb_obj->show_orb($uid, $uname);
        }
        else
        {
            return $uname;
        }
    }

    /*
    // ***************************************************************************
    // *
    // *	method 		: 	gen_orb($userid, $username, $orb)
    // *
    // *	Parameters	: 	$userid as integer for user
    // *				:	$username as string object for user name
    // *				:	$orb as string the orb to use
    // *				:	orb_fem orb_flame orb_toxin orb_frost
    // *				:	orb_dark orb_light
    // *	Returns		:	nothing
    // *				:
    // *
    // ***************************************************************************
    function gen_orb($userid, $username, $orb)
    {
        $font = e_PLUGIN . 'gold_system/fonts/' . 'arial.ttf';
        $text = $username;
        $s = 9;
        $size = imagettfbbox($s, 0, $font, $text);
        $dx = abs($size[2] - $size[0]);
        $dy = abs($size[5] - $size[3]);
        $xpad = 9;
        $ypad = 9;
        $im = imagecreate($dx + $xpad, $dy + $ypad);
        imagealphablending($im, false);
        $col = imagecolorallocatealpha($im, 0, 0, 0, 127);
        // print $userid . $orb;
        $black = ImageColorAllocate($im, 0, 0, 0);
        // $white = ImageColorAllocate($im, 255, 255, 255);
        switch ($orb)
        {
            case 'orb_fem' :
                $bkgrnd = ImageColorAllocate($im, 0x83, 0x39, 0x9b);
                $white = ImageColorAllocate($im, 0x83, 0x39, 0x9b);
                break;
            case 'orb_flame' :
                $bkgrnd = ImageColorAllocate($im, 0xce, 0x57, 0x19);
                $white = ImageColorAllocate($im, 0xce, 0x57, 0x19);
                break;
            case 'orb_toxin' :
                $bkgrnd = ImageColorAllocate($im, 0x71, 0xd1, 0x00);
                $white = ImageColorAllocate($im, 0x71, 0xd1, 0x00);
                break;
            case 'orb_frost' :
                $bkgrnd = ImageColorAllocate($im, 0x2f, 0xab, 0xe7);
                $white = ImageColorAllocate($im, 0x2f, 0xab, 0xe7);
                break;
            case 'orb_dark' :
                $bkgrnd = ImageColorAllocate($im, 0x3c, 0x3c, 0x3c);
                $white = ImageColorAllocate($im, 0x3c, 0x3c, 0x3c);
                break;
            case 'orb_light' :
                $bkgrnd = ImageColorAllocate($im, 0xdc, 0xe3, 0x7d);
                $white = ImageColorAllocate($im, 0xdc, 0xe3, 0x7d);
                break;
        }

        $fore = ImageColorAllocate($im, 255, 255, 255);
        // ImageRectangle($im, 0, 0, $dx + $xpad-1, $dy + $ypad-1, $black);
        $this->imagefillroundedrect($im, 0, 0, $dx + $xpad-1, $dy + $ypad-1, 10, $col);
        // ImageRectangle($im, 0, 0, $dx + $xpad, $dy + $ypad, $white);
        $this->imagefillroundedrect($im, 0, 0, $dx + $xpad, $dy + $ypad, 10, $white);

        ImageTTFText($im, $s, 0, (int)($xpad / 2) + 1, $dy + (int)($ypad / 2), $black, $font, $text);
        ImageTTFText($im, $s, 0, (int)($xpad / 2), $dy + (int)($ypad / 2)-1, $fore, $font, $text);
        imagealphablending($im, false);
        imagesavealpha($im, true);
        Imagepng($im, e_PLUGIN . 'gold_orb/wield/' . $userid . '.png');
        ImageDestroy($im);
    }
    function imagefillroundedrect(&$im, $x, $y, $cx, $cy, $rad, $col)
    {
        // Draw the middle cross shape of the rectangle
        imagefilledrectangle($im, $x, $y + $rad, $cx, $cy - $rad, $col);
        imagefilledrectangle($im, $x + $rad, $y, $cx - $rad, $cy, $col);

        $dia = $rad * 2;
        // Now fill in the rounded corners
        imagefilledellipse($im, $x + $rad, $y + $rad, $rad * 2, $dia, $col);
        imagefilledellipse($im, $x + $rad, $cy - $rad, $rad * 2, $dia, $col);
        imagefilledellipse($im, $cx - $rad, $cy - $rad, $rad * 2, $dia, $col);
        imagefilledellipse($im, $cx - $rad, $y + $rad, $rad * 2, $dia, $col);
    }
    function gen_orb2($userid, $username, $orb)
    {
        $image = ImageCreateFromPNG(e_PLUGIN . 'gold_system/base.png');
        $color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
        $colorShadow = imagecolorallocate($image, 0x66, 0x66, 0x66);
        // $font = 'arial.ttf';
        $font = e_PLUGIN . 'gold_system/fonts/' . 'arial.ttf';
        $fontSize = "10";
        $fontRotation = "0";
        $str = $username;

        //  Shadow
        ImageTTFText($image, $fontSize, $fontRotation, 7, 22, $colorShadow, $font, $str);

       //   Top Level
        ImageTTFText($image, $fontSize, $fontRotation, 5, 20, $color, $font, $str);
        // header("Content-Type: image/PNG");
        // ImagePng ($image);
        Imagepng($image, e_PLUGIN . 'gold_system/wield/' . $userid . '.png');
        imagedestroy($image);
    }
*/
    function select_user($gold_form_name, $gold_form_value)
    {
        require_once(e_HANDLER . 'user_select_class.php');
        $us = new user_select;
        return $us->select_form('popup', $gold_form_name, $gold_form_value);
    }
    // ***************************************************************************
    // *
    // *	method 		: 	add_gold($amount, $uid=0, $type="Credit",$plugin = "unknown", $log = "unknown credit", $forumid = 0)
    // *
    // *				:	Use this method to modify the current balance of a user
    // *					It creates a single history entry of gold_type (default "Credit")
    // *
    // *	Parameters	: 	$amount (default no amount)
    // *				:	$uid (default no user)
    // *				:	$type (default "adjustment")
    // *				:	$plugin (default unknown)
    // *				:	$log (default unknown credit)
    // *				:	$forumid (default 0)
    // *
    // *	Returns		:	$gold_return (array)
    // *				:	$gold_return['gold_error_no']
    // *						0 = OK
    // *						1 = No amount specified
    // *						2 = No Action specified
    // *						4 = No Plugin specified
    // *						8 = Specified plugin is not installed and active in gold
    // *						16 = No user specified
    // *						32 = Unable to update user record
    // *						64 = Unable to update history record
    // *						128 = Invalid or missing parameter
    // *				:	$gold_return['gold_user_id'] user's ID
    // *				:	$gold_return['gold_amount'] amount CR/DR
    // *				:	$gold_return['gold_action'] action taken
    // *				:	$gold_return['gold_plugin'] calling plugin
    // *
    // *	Call this method toadd gold to a member
    // * 	Upto caller to determine if balance is OK
    // *
    // *
    // ***************************************************************************
    function add_gold($amount, $uid, $type = 'Credit', $plugin = 'unknown', $log = 'unknown credit', $forumid = 0)
    {
        // create array with parameters
        $gold_param['gold_user_id'] = $uid;
        $gold_param['gold_who_id'] = 0;
        $gold_param['gold_amount'] = $amount;
        $gold_param['gold_type'] = $type;
        $gold_param['gold_action'] = 'credit';
        $gold_param['gold_plugin'] = $plugin;
        $gold_param['gold_log'] = $log;
        $gold_param['gold_forum'] = $forumid;
        // do the transaction
        return $this->gold_modify($gold_param);
    }
    // ***************************************************************************
    // *
    // *	method 		: 	add_gold($amount, $uid=0, $type="Credit",$plugin = "unknown", $log = "unknown credit", $forumid = 0)
    // *
    // *				:	Use this method to modify the current balance of a user
    // *					It creates a single history entry of gold_type (default "Credit")
    // *
    // *	Parameters	: 	$amount (default no amount) This should be a positive number
    // *				:	$uid (default no user)
    // *				:	$type (default "adjustment")
    // *				:	$plugin (default unknown)
    // *				:	$log (default unknown credit)
    // *				:	$forumid (default 0)
    // *
    // *	Returns		:	$gold_return (array)
    // *				:	$gold_return['gold_error_no']
    // *						0 = OK
    // *						1 = No amount specified
    // *						2 = No Action specified
    // *						4 = No Plugin specified
    // *						8 = Specified plugin is not installed and active in gold
    // *						16 = No user specified
    // *						32 = Unable to update user record
    // *						64 = Unable to update history record
    // *						128 = Invalid or missing parameter
    // *				:	$gold_return['gold_user_id'] user's ID
    // *				:	$gold_return['gold_amount'] amount CR/DR
    // *				:	$gold_return['gold_action'] action taken
    // *				:	$gold_return['gold_plugin'] calling plugin
    // *
    // *	Call this method toadd gold to a member
    // * 	Upto caller to determine if balance is OK
    // *
    // *
    // ***************************************************************************
    function subtract_gold($amount, $uid, $type = 'Debit', $plugin = 'unknown', $log = 'unknown debit', $forumid = 0)
    {
        // create array with parameters
        $gold_param['gold_user_id'] = $uid;
        $gold_param['gold_who_id'] = 0;
        // ensure the number is negative
        $gold_param['gold_amount'] = abs($amount) ;
        $gold_param['gold_type'] = $type;
        $gold_param['gold_action'] = 'debit';
        $gold_param['gold_plugin'] = $plugin;
        $gold_param['gold_log'] = $log;
        $gold_param['gold_forum'] = $forumid;
        // do the transaction
        return $this->gold_modify($gold_param);
    }
    // ***************************************************************************
    // *
    // *	method 		: 	plugin_active($plug_dir)
    // *
    // *				:	Use this method to determine if a plugin is active in the gold system
    // *
    // *	Parameters	: 	$plug_dir string containing the name of the plugin directory
    // *				:	Also the name used in e_gold.php
    // *
    // *	Returns		:	true if the plugin is active in gold
    // *				:	false if the plugin is not active in gold or not found
    // *
    // ***************************************************************************
    function plugin_active($gold_plug_dir = '')
    {
        // print $gold_plug_dir." -<br>";
        // print_r($this->gold_plugins);
        if ($this->gold_plugins[$gold_plug_dir] == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    // ***************************************************************************
    // *
    // *	method 		: 	current_orb($gold_uid)
    // *
    // *	Parameters	:	$gold_uid id of user to write
    // *
    // *	Returns		:	name of the current orb for selected user
    // *
    // ***************************************************************************
    function current_orb($gold_uid)
    {
        if (!array_key_exists($gold_uid, $this->gold_member))
        {
            // otherwise load the user data
            $this->load_gold($gold_uid);
        }

        return $this->gold_member[$gold_uid]['gold_orb'];
    }
    // ***************************************************************************
    // *
    // *	method 		: 	write_additional($gold_userid)
    // *
    // *	Parameters	:	$gold_userid id of user to write
    // *
    // *	Returns		:	None
    // *				:	Writes users additional info
    // *
    // ***************************************************************************
    function write_additional($gold_userid)
    {
        global $eArrayStorage, $gold_sql;
        $gold_tmp = $eArrayStorage->WriteArray($this->gold_additional[$gold_userid]);
        $gold_sql->db_Update('gold_system', 'gold_additional="' . $gold_tmp . '" where gold_id=' . $gold_userid, false);
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_currency_abbrev()
    // *
    // *	Parameters	:	none
    // *
    // *	Returns		:	image or string
    // *				:	Returns the gold currency symbol or abbreviation
    // *
    // ***************************************************************************
    function gold_currency_abbrev()
    {
        global $tp, $GOLD_PREF;
        if ($GOLD_PREF['gold_currency_abrev'] == 'gold.gif')
        {
            return '<img src="' . e_PLUGIN . 'gold_system/images/gold.gif" alt="' . $tp->toHTML($GOLD_PREF['gold_currency_name']) . '" title="' . $tp->toHTML($GOLD_PREF['gold_currency_name']) . '" />';
        }
        else
        {
            return $tp->toHTML($GOLD_PREF['gold_currency_abrev'], false);
        }
    }
    // ***************************************************************************
    // *
    // *	method 		: 	gold_currency_name()
    // *
    // *	Parameters	:	none
    // *
    // *	Returns		:	string
    // *				:	Returns the currency name
    // *
    // ***************************************************************************
    function gold_currency_name()
    {
        global $tp, $GOLD_PREF;
        return $tp->toHTML($GOLD_PREF['gold_currency_name'], false);
    }
}
