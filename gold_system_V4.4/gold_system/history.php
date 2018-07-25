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
$title = LAN_GS_H021;
define('e_PAGETITLE', $title);

require_once(HEADERF);
global $tp, $gold_trantype;
require_once(GOLD_THEME);
$gold_in = 0;
$gold_out = 0;

$gold_currentmonth = date('n', $gold_obj->gold_time());;
$gold_currentyear = date('Y', $gold_obj->gold_time());;

$gold_months = explode(",", LAN_GS_MONTH);
$gold_currentmonthname = $gold_months[$gold_currentmonth];
if ($GOLD_PREF['gold_pdftrans'] == 1)
{
    // new  display of all history records by pdf
    require_once(e_HANDLER . 'file_class.php');

    $gold_efile = new e_FILE;

    $gold_filelist = $gold_efile->get_files($GOLD_PREF['gold_arcloc'] . '/', '^' . USERID . '_');

    $count = 0;
    foreach($gold_filelist as $gold_arc)
    {
        $gold_temp = explode('_', $gold_arc['fname']);
        $gold_mylist[$count]['fname'] = $gold_arc['fname'];
        $gold_yr = str_replace('.pdf', '', $gold_temp[2]);
        $gold_mylist[$count]['name'] = $gold_months[intval($gold_temp[1])] . ' ' . $gold_yr;

        $gold_tablist[$gold_yr] = "'" . $gold_yr . "'";

        $gold_tabstuff[$gold_yr][$gold_temp[1]] = '<a href="' . e_PLUGIN . 'gold_system/show_trans.php?' . $gold_arc['fname'] . '" >' . $gold_mylist[$count]['name'] . '</a><br />';
        $count ++;
    }

    foreach($gold_tabstuff as $yr => $mth)
    {
        ksort($mth, SORT_NUMERIC);

        foreach($mth as $row)
        {
            $gold_tabdetail[$yr] .= $row;
        }
    }
    ksort($gold_tablist, SORT_NUMERIC);

    $gold_tabs = implode(',', $gold_tablist);

    $gold_text .= "
<form method='post' action='" . e_SELF . "' id='gold_form' >";
    $gold_hist_prevrecs = '
<div id="gold_expand" onclick="expandit(\'gold_history_hide\')">' . LAN_GS_H018 . '</div>
<div id="gold_history_hide" style="display:none" >
<div id="gold_historytabs" style="width:100%">';

    foreach($gold_tabdetail as $row)
    {
        $gold_hist_prevrecs .= '
	<div class="dhtmlgoodies_aTab">' . $row . '</div>';
    }
    $gold_hist_prevrecs .= '
</div>
</div>
';

    $gold_monthsel = $gold_months[$gold_currentmonth];
    $gold_yearsel = $gold_currentyear;
    $gold_start_date = mktime(0, 0, 0, $gold_currentmonth, 1, $gold_currentyear);
    $gold_lastday = date("t", $gold_start_date);
    $gold_end_date = mktime(0, 0, 0, $gold_currentmonth, $gold_lastday, $gold_currentyear) + 86400;
    $gold_hist_cbalance = $gold_obj->gold_balance(USERID);

    $gold_trans = 0;

    $gold_hist_from = intval(e_QUERY);
    $gold_text .= $tp->parsetemplate($GOLD_HISTORY_HEADER, true, $gold_shortcodes);
    $gold_numrecs = $gold_sql->db_Count('gold_system_history', '(*)', 'where gold_hist_user_id = ' . USERID . '  and gold_hist_date between ' . $gold_start_date . '  and ' . $gold_end_date, false);

    $gold_hbalance = $gold_hist_cbalance;
    $gold_prevamount = 0;
    // get the sum of transactions up to the date we are displaying at the top
    // then deduct that from the current balance
    $gold_arg = "select * from #gold_system_history left join #user on gold_hist_who = user_id where gold_hist_user_id = " . USERID . "  and gold_hist_date between {$gold_start_date}  and {$gold_end_date} order by gold_hist_date desc limit $gold_hist_from,30";
    if ($sql->db_Select_gen($gold_arg, false))
    {
        while ($row = $sql->db_Fetch())
        {
            $gold_trans++;
            if (is_odd($gold_trans))
            {
                $class = 'oddrow';
            }
            else
            {
                $class = 'evenrow';
            }
            $date = date("D, M d, Y h:i A", $row['gold_hist_date']);

            $gold_type = $row['gold_hist_type'];

            if ($row['user_id'] > 0)
            {
                $gold_username = "<a href='" . SITEURL . "user.php?{$row['user_id']}'>{$row['user_name']}</a>";
            }
            else
            {
                $gold_username = '';
            }

            $gold_hbalance = $gold_hbalance + ($gold_prevamount * -1);

            $gold_prevamount = $row['gold_hist_amount'];
            if ($row['gold_hist_amount'] < 0)
            {
                // spent
                if (empty($gold_username))
                {
                    $person = '&nbsp;';
                }
                else
                {
                    $person = LAN_GS_H010 . ' ' . $gold_username;
                }
                $type = "{$gold_type}";
                $gold_amount = $row['gold_hist_amount'] ;
                $gold_out += $gold_amount;
            }

            else
            {
                // received
                if (empty($gold_username))
                {
                    $person = '&nbsp;';
                }
                else
                {
                    $person = LAN_GS_H011 . ' ' . $gold_username;
                }
                $type = "{$gold_type}";
                $gold_amount = $row['gold_hist_amount'];
                $gold_in += $gold_amount;
            }
            $gold_text .= $tp->parsetemplate($GOLD_HISTORY_DETAIL, true, $gold_shortcodes);
            // $flag++;
            // $gold_rowcount++;
        }
    }
    else
    {
        $gold_text .= $tp->parsetemplate($GOLD_HISTORY_NODETAIL, true, $gold_shortcodes);
    }
    $action = '';

    $parms = $gold_numrecs . ',30,' . $gold_hist_from . ',' . e_SELF . '?' . '[FROM].' . $action;
    $gold_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}");

    $gold_text .= $tp->parsetemplate($GOLD_HISTORY_FOOTER, true, $gold_shortcodes);
    $gold_text .= '
</form>
<script type="text/javascript">
var tabviewfolder="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/includes/tabview/"
initTabs(\'gold_historytabs\',Array(' . $gold_tabs . '),0,\'100%\',\'\');
</script>';
}
else
{
    // traditional display of all history records
    $gold_text .= "
<form method='post' action='" . e_SELF . "' id='gold_form' >";

    $gold_currentmonth = intval($_POST['gold_currentmonth']);
    if ($gold_currentmonth == 0)
    {
        $gold_currentmonth = date('m');
    }
    $gold_currentmonthname = '<select name="gold_currentmonth" class="tbox">
	<option value="1" ' . ($gold_currentmonth == 1?'selected="selected"':'') . '>' . LAN_GS_H025 . '</option>
	<option value="2" ' . ($gold_currentmonth == 2?'selected="selected"':'') . '>' . LAN_GS_H026 . '</option>
	<option value="3" ' . ($gold_currentmonth == 3?'selected="selected"':'') . '>' . LAN_GS_H027 . '</option>
	<option value="4" ' . ($gold_currentmonth == 4?'selected="selected"':'') . '>' . LAN_GS_H028 . '</option>
	<option value="5" ' . ($gold_currentmonth == 5?'selected="selected"':'') . '>' . LAN_GS_H029 . '</option>
	<option value="6" ' . ($gold_currentmonth == 6?'selected="selected"':'') . '>' . LAN_GS_H030 . '</option>
	<option value="7" ' . ($gold_currentmonth == 7?'selected="selected"':'') . '>' . LAN_GS_H031 . '</option>
	<option value="8" ' . ($gold_currentmonth == 8?'selected="selected"':'') . '>' . LAN_GS_H032 . '</option>
	<option value="9" ' . ($gold_currentmonth == 9?'selected="selected"':'') . '>' . LAN_GS_H033 . '</option>
	<option value="10" ' . ($gold_currentmonth == 10?'selected="selected"':'') . '>' . LAN_GS_H034 . '</option>
	<option value="11" ' . ($gold_currentmonth == 11?'selected="selected"':'') . '>' . LAN_GS_H035 . '</option>
	<option value="12" ' . ($gold_currentmonth == 12?'selected="selected"':'') . '>' . LAN_GS_H036 . '</option>
	</select>';
    $gold_currentyear = intval($_POST['gold_currentyear']);
    if ($gold_currentyear == 0)
    {
        $gold_currentyear = date('Y');
    }
    $gold_yearsel = '<select class="tbox" name="gold_currentyear">';
    for ($i = 2006;$i <= date('Y');$i++)
    {
        $gold_yearsel .= '<option value="' . $i . '" ' . ($gold_currentyear == $i?'selected="selected"':'') . '>' . $i . '</option>';
    }
    $gold_yearsel .= '</select>';
    $gold_start_date = mktime(0, 0, 0, $gold_currentmonth, 1, $gold_currentyear);
    $gold_lastday = date("t", $gold_start_date);
    $gold_end_date = mktime(0, 0, 0, $gold_currentmonth, $gold_lastday, $gold_currentyear) + 86400;
    $gold_hist_cbalance = $gold_obj->gold_balance(USERID);

    $gold_trans = 0;

    $gold_hist_from = intval(e_QUERY);
    $gold_text .= $tp->parsetemplate($GOLD_HISTORY_THEADER, true, $gold_shortcodes);
    $gold_numrecs = $gold_sql->db_Count('gold_system_history', '(*)', 'where gold_hist_user_id = ' . USERID . '  and gold_hist_date between ' . $gold_start_date . '  and ' . $gold_end_date, false);

    $gold_hbalance = $gold_hist_cbalance;
    $gold_prevamount = 0;
    // get the sum of transactions up to the date we are displaying at the top
    // then deduct that from the current balance
    $gold_arg = "select * from #gold_system_history left join #user on gold_hist_who = user_id where gold_hist_user_id = " . USERID . "  and gold_hist_date between {$gold_start_date}  and {$gold_end_date} order by gold_hist_date desc limit $gold_hist_from,30";
    if ($sql->db_Select_gen($gold_arg, false))
    {
        while ($row = $sql->db_Fetch())
        {
            $gold_trans++;
            if (is_odd($gold_trans))
            {
                $class = 'oddrow';
            }
            else
            {
                $class = 'evenrow';
            }
            $date = date("D, M d, Y h:i A", $row['gold_hist_date']);

            $gold_type = $row['gold_hist_type'];

            if ($row['user_id'] > 0)
            {
                $gold_username = "<a href='" . SITEURL . "user.php?{$row['user_id']}'>{$row['user_name']}</a>";
            }
            else
            {
                $gold_username = '';
            }

            $gold_hbalance = $gold_hbalance + ($gold_prevamount * -1);

            $gold_prevamount = $row['gold_hist_amount'];
            if ($row['gold_hist_amount'] < 0)
            {
                // spent
                if (empty($gold_username))
                {
                    $person = '&nbsp;';
                }
                else
                {
                    $person = LAN_GS_H010 . ' ' . $gold_username;
                }
                $type = "{$gold_type}";
                $gold_amount = $row['gold_hist_amount'] ;
                $gold_out += $gold_amount;
            }

            else
            {
                // received
                if (empty($gold_username))
                {
                    $person = '&nbsp;';
                }
                else
                {
                    $person = LAN_GS_H011 . ' ' . $gold_username;
                }
                $type = "{$gold_type}";
                $gold_amount = $row['gold_hist_amount'];
                $gold_in += $gold_amount;
            }
            $gold_text .= $tp->parsetemplate($GOLD_HISTORY_TDETAIL, true, $gold_shortcodes);
        }
    }
    else
    {
        $gold_text .= $tp->parsetemplate($GOLD_HISTORY_TNODETAIL, true, $gold_shortcodes);
    }
    $action = '';

    $parms = $gold_numrecs . ',30,' . $gold_hist_from . ',' . e_SELF . '?' . '[FROM].' . $action;
    $gold_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}");

    $gold_text .= $tp->parsetemplate($GOLD_HISTORY_TFOOTER, true, $gold_shortcodes);
    $gold_text .= '
</form>
';
}
$ns->tablerender($title, $gold_text);
require_once(FOOTERF);
function is_odd($number)
{
    return $number &1;
}

?>