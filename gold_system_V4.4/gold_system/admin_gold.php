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
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_gold_system.php');
$gold_from = 0;

if (isset($_POST['gold_filter']) || isset($_POST['gold_update']) || isset($_POST['addgold']) || isset($_POST['deductgold']))
{
    $gold_from = intval($_POST['gold_from']);
    $gold_uid = intval($_POST['gold_uid']);
    $gold_action = $_POST['gold_action'];
}
else
{
    $gold_tmp = explode('.', e_QUERY);
    $gold_from = intval($gold_tmp[0]);
    $gold_action = $gold_tmp[1];
    $gold_uid = intval($gold_tmp[2]);
}
if (isset($_POST['gold_user']))
{
    $gold_user = '%' . $_POST['gold_user'] . '%';
}
else
{
    $gold_user = '%';
}

if (isset($_POST['addgold']))
{
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
    // ***************************************************************************
    if ($_POST['gold_user_gold'] > 0)
    {
        $gold_param['gold_user_id'] = $gold_uid;
        $gold_param['gold_who_id'] = 0;
        $gold_param['gold_amount'] = $_POST['gold_user_gold'];
        $gold_param['gold_type'] = 'Admin';
        $gold_param['gold_action'] = 'credit';
        $gold_param['gold_plugin'] = 'gold_system';
        $gold_param['gold_log'] = $tp->toDB(ADLAN_GS_M015 . ' ' . $GOLD_PREF['gold_currency_name'] . ' : ' . $_POST['gold_comment']);

        $fred = $gold_obj->gold_modify($gold_param);

        $gold_msg = ADLAN_GS_M016 . ' ' . $GOLD_PREF['gold_currency_name'];
        $gold_action = '';
    }
    else
    {
        $gold_msg = ADLAN_GS_M017;
        $gold_action = 'edit';
    }
}
if (isset($_POST['deductgold']))
{
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
    // ***************************************************************************
    if ($_POST['gold_user_gold'] > 0)
    {
        $gold_param['gold_user_id'] = $gold_uid;
        $gold_param['gold_who_id'] = 0;
        $gold_param['gold_amount'] = $_POST['gold_user_gold'];
        $gold_param['gold_type'] = 'Admin';
        $gold_param['gold_action'] = 'debit';
        $gold_param['gold_plugin'] = 'gold_system';
        $gold_param['gold_log'] = $tp->toDB(ADLAN_GS_M018 . ' ' . $GOLD_PREF['gold_currency_name'] . ' : ' . $_POST['gold_comment']);

        $fred = $gold_obj->gold_modify($gold_param);
        $gold_msg = ADLAN_GS_M016 . ' ' . $GOLD_PREF['gold_currency_name'];
        $gold_action = '';
    }
    else
    {
        $gold_msg = ADLAN_GS_M017;
        $gold_action = 'edit';
    }
}

if ($gold_action == 'edit')
{
    $sql->db_Select_gen('select * from #gold_system left join #user on gold_id=user_id where gold_id=' . $gold_uid, false);
    extract($sql->db_Fetch());

    $gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_form" >
	<div>
		<input type="hidden" name="gold_from" value="' . $gold_from . '" />
		<input type="hidden" name="gold_uid" value="' . $gold_uid . '" />
		<input type="hidden" name="gold_action" value="save" />
	</div>
 	<table class="fborder" style="' . ADMIN_WIDTH . '">
 		<tr>
 			<td class="fcaption" colspan="2" style="text-align:left">' . ADLAN_GS_MM01 . '</td>
 		</tr>
 		<tr>
 			<td class="forumheader2" colspan="2" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . ADLAN_GS_M57 . '</td>
 			<td class="forumheader3" style="width:70%">' . $tp->toHTML($user_name) . '</td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . ADLAN_GS_M020 . '</td>
 			<td class="forumheader3" style="width:70%">' . $gold_obj->formation($gold_obj->gold_balance($gold_uid)) . '</td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . $GOLD_PREF['gold_currency_name'] . ' ' . ADLAN_GS_M021 . '</td>
 			<td class="forumheader3" style="width:70%">
 				<input class="tbox" type="text" size="25" maxlength="10" name="gold_user_gold" value="' . $_POST['gold_user_gold'] . '"/>
 			</td>
 		</tr>
 		<tr>
 			<td class="forumheader3" style="width:30%">' . ADLAN_GS_M012 . '</td>
 			<td class="forumheader3" style="width:70%">
 				<textarea class="tbox" rows="4" cols="60" style="width:80%" name="gold_comment" >' . $_POST['gold_comment'] . '</textarea>
 			</td>
 		</tr>
 		<tr>
 			<td class="forumheader2" colspan="2" style="text-align:center">
 				<input type="submit" class="button" name="addgold" onclick=\'return confirm("' . ADLAN_GS_M013 . '")\' value="' . ADLAN_GS_M22 . ' ' . $GOLD_PREF["gold_currency_name"] . '" />
 				<input type="submit" class="button" name="deductgold" onclick=\'return confirm("' . ADLAN_GS_M014 . '")\' value="' . ADLAN_GS_M23 . ' ' . $GOLD_PREF["gold_currency_name"] . '" />
 			</td>
 		</tr>
 	</table>
</form>';
}

if ($gold_action == 'history')
{
    if (!defined('USER_WIDTH'))
    {
        define('USER_WIDTH', ADMIN_WIDTH);
    }
    require_once(GOLD_THEME);
    $title = LAN_GS_H020.' <b>' . $gold_obj->gold_username($gold_uid) . '</b>';
    require_once(e_PLUGIN . 'gold_system/includes/gold_system_shortcodes.php');
    $gold_currentmonth = date('n', $gold_obj->gold_time());;
    $gold_currentyear = date('Y', $gold_obj->gold_time());;
    $currentuser = $gold_uid;
    $gold_months = explode(",", LAN_GS_MONTH);
    $gold_currentmonthname = $gold_months[$gold_currentmonth];
    require_once(e_HANDLER . 'file_class.php');

    $gold_efile = new e_FILE;

    $gold_filelist = $gold_efile->get_files($GOLD_PREF['gold_arcloc'] . '/', '^' . $currentuser . '_');
    // print_a($gold_filelist);
    $count = 0;
    foreach($gold_filelist as $gold_arc)
    {
        // print_a($gold_arc);
        $gold_temp = explode('_', $gold_arc['fname']);
        $gold_mylist[$count]['fname'] = $gold_arc['fname'];
        $gold_yr = str_replace('.pdf', '', $gold_temp[2]);
        $gold_mylist[$count]['name'] = $gold_months[intval($gold_temp[1])] . ' ' . $gold_yr;
        // $gold_mylist[$count]['month'] = $gold_temp[1];
        // $gold_mylist[$count]['year'] = $gold_yr;
        $gold_tablist[$gold_yr] = "'" . $gold_yr . "'";

        $gold_tabstuff[$gold_yr][$gold_temp[1]] = '<a href="' . e_PLUGIN . 'gold_system/show_trans.php?' . $gold_arc['fname'] . '" >' . $gold_mylist[$count]['name'] . '</a><br />';
        $count ++;
    }
    // print_a($gold_mylist);
    // print_a($gold_tabstuff);
    foreach($gold_tabstuff as $yr => $mth)
    {
        ksort($mth, SORT_NUMERIC);
        // print_a($mth);
        foreach($mth as $row)
        {
            $gold_tabdetail[$yr] .= $row;
        }
    }
    ksort($gold_tablist, SORT_NUMERIC);
    // ksort($gold_tabdetail);
    $gold_tabs = implode(',', $gold_tablist);

    $gold_text .= "
<form method='post' action='" . e_SELF . "' id='gold_form' >";
    $gold_hist_prevrecs = '
<div id="gold_expand" onclick="expandit(\'gold_history_hide\')">'.LAN_GS_H018.'</div>
<div id="gold_history_hide" style="display:none" >
<div id="gold_historytabs" style="width:100%">';
    // print_a($gold_tabdetail);
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
    $gold_hist_cbalance = $gold_obj->gold_balance($currentuser);

    $gold_trans = 0;

    $gold_hist_from = intval(e_QUERY);
    $gold_text .= $tp->parsetemplate($GOLD_HISTORY_HEADER, true, $gold_shortcodes);
    $gold_numrecs = $gold_sql->db_Count('gold_system_history', '(*)', 'where gold_hist_user_id = ' . $currentuser . '  and gold_hist_date between ' . $gold_start_date . '  and ' . $gold_end_date, false);
    // $gold_rowcount=0;
    $gold_hbalance = $gold_hist_cbalance;
    $gold_prevamount = 0;
    // get the sum of transactions up to the date we are displaying at the top
    // then deduct that from the current balance
    $gold_arg = "select * from #gold_system_history left join #user on gold_hist_who = user_id where gold_hist_user_id = " . $currentuser . "  and gold_hist_date between {$gold_start_date}  and {$gold_end_date} order by gold_hist_date desc limit $gold_hist_from,30";
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
    $action = 'history.'.$currentuser;

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

if ($gold_action == '' || $gold_action == 'show')
{
    $gold_arg = "select count(gold_id) as gold_count from #gold_system as g left join #user as u on user_id=gold_id where user_name like '{$gold_user}'";
    $sql->db_Select_gen($gold_arg, false);
    extract($sql->db_Fetch());

    $gold_arg = "select g.*,u.user_name from #gold_system as g left join #user as u on user_id=gold_id where user_name like '{$gold_user}' order by gold_id limit $gold_from,25";
    $sql->db_Select_gen($gold_arg, false);
    $gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_form" >
	<div>
		<input type="hidden" name="gold_from" value="' . $gold_from . '" />
	</div>
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td class="fcaption" colspan="6" style="text-align:left">' . ADLAN_GS_M001 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="6" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:10%;text-align:right;" >' . ADLAN_GS_M002 . '</td>
			<td class="forumheader2" style="width:30%;text-align:left;">' . ADLAN_GS_M003 . '</td>
			<td class="forumheader2" style="width:15%;text-align:right;">' . ADLAN_GS_M004 . '</td>
			<td class="forumheader2" style="width:15%;text-align:right;">' . ADLAN_GS_M005 . '</td>
			<td class="forumheader2" style="width:15%;text-align:right;">' . ADLAN_GS_M006 . '</td>
			<td class="forumheader2" style="width:15%;text-align:center;">' . ADLAN_GS_M007 . '</td>
		</tr>	';
    while ($gold_row = $sql->db_Fetch())
    {
        $gold_text .= '
		<tr>
			<td class="forumheader3" style="text-align:right;" >' . $gold_row['gold_id'] . '</td>
			<td class="forumheader3" style="text-align:left;" >' . $gold_row['user_name'] . '</td>
			<td class="forumheader3" style="text-align:right;" >' . $gold_obj->formation($gold_row['gold_balance']) . '</td>
			<td class="forumheader3" style="text-align:right;" >' . $gold_obj->formation($gold_row['gold_spent']) . '</td>
			<td class="forumheader3" style="text-align:right;" >' . $gold_obj->formation($gold_row['gold_credit']) . '</td>
			<td class="forumheader3" style="text-align:center;" >
				<a href="' . e_SELF . '?' . $gold_from . '.edit.' . $gold_row['gold_id'] . '" ><img src="' . e_IMAGE . 'admin_images/edit_16.png" alt="' . ADLAN_GS_M010 . '" title="' . ADLAN_GS_M010 . '" /></a>&nbsp;
				<a href="' . e_SELF . '?' . $gold_from . '.history.' . $gold_row['gold_id'] . '" ><img src="' . e_IMAGE . 'admin_images/prefs_16.png" alt="' . ADLAN_GS_M011 . '" title="' . ADLAN_GS_M011 . '" /></a></td>
		</tr>';
    }
    $action = 'show';
    $parms = $gold_count . ',25,' . $gold_from . ',' . e_SELF . '?' . '[FROM].' . $action;
    $gold_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . '';

    $gold_text .= '
		<tr>
			<td class="forumheader2" colspan="6" style="text-align:center">' . ADLAN_GS_M009 . '&nbsp;
				<input type="text" class="tbox" style="width:140px;" name="gold_user" value="' . $_POST['gold_user'] . '" /> &nbsp;&nbsp;
				<input type="submit" class="button" name="gold_update" value="' . ADLAN_GS_M008 . '" /></td>
		</tr>
	<tr>
		<td class="forumheader2" colspan="6" style="text-align:left">' . $gold_nextprev . '&nbsp;</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="6" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';
}
$ns->tablerender(ADLAN_GS, $gold_text);
require_once(e_ADMIN . 'footer.php');
function is_odd($number)
{
    return $number &1;
}
