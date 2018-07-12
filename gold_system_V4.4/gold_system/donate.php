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
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_gold_system.php');
require_once(e_PLUGIN . 'gold_system/includes/gold_system_shortcodes.php');
$title = LAN_GS_6 . ' ' . $GOLD_PREF['gold_currency_name'];
define('e_PAGETITLE', $title);
require_once(HEADERF);
require_once(GOLD_THEME);

if (e_QUERY)
{
    #$_POST['user'] = rawurldecode(e_QUERY);
   $gold_buyfor=intval(e_QUERY);
}
if (USER)
{
    // Only do if a logged in member
    $gold_mygold = $gold_obj->gold_balance(USERID);

    if (IsSet($_POST['submitgold']))
    {
        // user has submitted form
        // get this users additional donate info
        $gold_donatehistory = $gold_obj->gold_additional[USERID]['donate'];
        if (!is_array($gold_donatehistory))
        {
            $gold_obj->gold_additional[USERID]['donate'] = array('recipient' => 0, 'amount' => 0, 'date');
        }
        // get the recipients ID from their username
        $goldrecipient = $gold_obj->get_user_id($_POST['user']);
        if ($gold_obj->gold_additional[USERID]['donate'][$goldrecipient] ['month'] != date('n'))
        {
        // if we are into a new month for this recipient reset their amount to zero and change the date to this month
            $gold_obj->gold_additional[USERID]['donate'][$goldrecipient] ['month'] = date('n');
            $gold_obj->gold_additional[USERID]['donate'][$goldrecipient] ['amount'] = 0;
            $gold_obj->write_additional(USERID);
        }
        // Validate
        if (strtoupper($_POST['user']) == strtoupper(USERNAME))
        {
            // cant send to self
            $gold_message = LAN_GS_9;
        } elseif ($goldrecipient === false || $goldrecipient == 0)
        {
            // invalid recipient
            $gold_message = LAN_GS_DG010;
        } elseif (!is_numeric($_POST['amount']))
        {
            // not a numeric amount
            $gold_message = LAN_GS_10;
        } elseif ($gold_mygold <= 0 || $gold_mygold < $_POST['amount'])
        {
            // insufficient balance
            $gold_message = LAN_GS_11;
        } elseif ($_POST['amount'] < 0)
        {
            // can't send -ve amount
            $gold_message = LAN_GS_12;
        } elseif ($GOLD_PREF['gold_maxdonatepermonth']> 0 && $gold_obj->gold_additional[USERID]['donate'][$goldrecipient] ['amount'] + $_POST['amount'] > $GOLD_PREF['gold_maxdonatepermonth'])
        {
            $gold_message = LAN_GS_DG019 . ' ' . $gold_obj->formation($gold_obj->gold_additional[USERID]['donate'][$goldrecipient] ['amount']) . ' ' . LAN_GS_DG020;
        }
        else
        {
            // *******************************************
            // all ok so do transfer
            // *******************************************
            // sent gold OK
            // now transfer from sender
            // *	Parameters	: 	$gold_param['gold_from_id'] FROM (required)
            // *				:	$gold_param['gold_to_id']  TO (required)
            // *				:	$gold_param['gold_amount'] (required)
            // *				:	$gold_param['gold_type'] (default "donation")
            // *				:	$gold_param['gold_plugin'] (default no plugin)
            // *				:	$gold_param['gold_log'] (default "")
            $gold_log = LAN_GS_DG012 . ' ' . USERNAME . ' ' . LAN_GS_DG013 . ' ' . $_POST['user'] . '<br />' . $_POST['comment'];
            $gold_param = array('gold_to_id' => $goldrecipient ,
                'gold_from_id' => USERID,
                'gold_amount' => $_POST['amount'],
                'gold_type' => LAN_GS_ACTION01,
                'gold_plugin' => "gold_system",
                'gold_log' => $gold_log);

            $gold_result = $gold_obj->gold_transfer($gold_param);
            $gold_mygold = $gold_obj->gold_balance(USERID);
            // now write back the donation, user and date;

            if ($gold_result['gold_error_no'] == 0)
            {
                // Deduction OK
                $gold_message = LAN_GS_13 . ' ' . $gold_obj->formation($_POST['amount']) . ' ' . LAN_GS_28 . ' ' . $_POST['user'] . ' ' . LAN_GS_14;
                $gold_psubject = LAN_GS_DG015 . ' ' . USERNAME;
                $gold_pmessage = LAN_GS_DG018 . ' ' . $_POST['user'] . '<br /><br />' . LAN_GS_DG016 . ' ' . $gold_obj->formation($_POST['amount']) . ' ' . LAN_GS_DG017 . ' ' . USERNAME . '<br /><br />' . $_POST['comment'];

                $gold_obj->gold_notify($goldrecipient, USERID, $gold_psubject, $gold_pmessage);
                $gold_newamount = $gold_obj->gold_additional[USERID]['donate'][$goldrecipient] ['amount'] + $_POST['amount'];
                $gold_obj->gold_additional[USERID]['donate'][$goldrecipient] = array('amount' => $gold_newamount, 'month' => date('n'));
                // print_a($gold_obj->gold_additional[USERID]['donate']);
                $gold_obj->write_additional(USERID);
            }
            else
            {
                // failed to transfer
                $gold_message = LAN_GS_DG011;
            }

            $_POST['user'] = '';
            $_POST['comment'] = '';
            $_POST['amount'] = 0;
            // header("Location:".SITEURL.$PLUGINS_DIRECTORY."gold_system/donate.php?OK");
        }
    }

    $gold_text .= '
<form method="post" action="' . e_SELF . '" id="gold_donate">';
    $gold_text .= $tp->parsetemplate($GOLD_DONATE, true, $gold_shortcodes);
    $gold_text .= '
</form>';
}
else
{
    $gold_text = LAN_GS_7 . " " . $GOLD_PREF['gold_currency_name'] . " " . LAN_GS_8;
}

$ns->tablerender($title, $gold_text);

require_once(FOOTERF);

?>