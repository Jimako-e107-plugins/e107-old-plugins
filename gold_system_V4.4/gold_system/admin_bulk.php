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
$gold_from = 0;

unset($gold_msg);
if (isset($_POST['gold_bulk_submit']))
{
    // form submitted
    $gold_classtodo = intval($_POST['gold_bulk_class']);
    if (!isset($_POST['gold_crdr']))
    {
        // credit debit buttons not selected
        $gold_msg .= LAN_GS_BULK012 . '<br />';
    }
    if (intval($_POST['gold_bulk_amount']) == 0)
    {
        // no amount specified
        $gold_msg .= LAN_GS_BULK014 . '<br />';
    }
    if ($gold_classtodo == 255)
    {
        // can not do every one
        $gold_msg .= LAN_GS_BULK015 . '<br />';
    }
    if ($gold_classtodo == 253)
    {
        // do all members
        $gold_arg = 'select user_id,user_name from #user ';
    }
    if ($gold_classtodo == 254)
    {
        // do all admins
        $gold_arg = 'select user_id,user_name from #user where user_admin=1';
    }
    if ($gold_classtodo == 250)
    {
        // do all main admins
        $gold_arg = 'select user_id,user_name from #user where user_admin=1 and left(user_perms,1)="0"';
    }
    if ($gold_classtodo > 0 && $gold_classtodo < 250)
    {
        // Do just classes
        $gold_arg = 'select user_id,user_name from #user where find_in_set(\'' . intval($_POST['gold_bulk_class']) . '\',user_class)';
    }
    $gbulk_num = $sql->db_Select_gen($gold_arg, false);
    if ($gbulk_num && !isset($gold_msg))
    {
        if (intval($_POST['gold_crdr']) == 1)
        {
            // we are crediting
            while ($gbulk_row = $sql->db_Fetch())
            {
                // for each selected person do a credit
                $gold_param['gold_user_id'] = $gbulk_row['user_id'];
                $gold_param['gold_who_id'] = 0;
                $gold_param['gold_amount'] = $_POST['gold_bulk_amount'];
                $gold_param['gold_type'] = LAN_GS_BULK013;
                $gold_param['gold_action'] = 'credit';
                $gold_param['gold_plugin'] = 'gold_system';
                $gold_param['gold_log'] = LAN_GS_BULK009 . ' ' . $_POST['gold_bulk_amount'] . ' ' . LAN_GS_BULK010 . ' : ' . $tp->toDB($_POST['gold_comment']);
                $fred = $gold_obj->gold_modify($gold_param);
                $gold_msg = ADLAN_GS_M016 ;
                $gold_result .= $tp->toFORM($gbulk_row['user_name']) . '<br />';
                $gold_action = '';
            }
        }
        if (intval($_POST['gold_crdr']) == 2)
        {
            // we are debiting
            while ($gbulk_row = $sql->db_Fetch())
            {
                // for each selected person do a debit.
                $gold_param['gold_user_id'] = $gbulk_row['user_id'];
                $gold_param['gold_who_id'] = 0;
                $gold_param['gold_amount'] = $_POST['gold_bulk_amount'];
                $gold_param['gold_type'] = LAN_GS_BULK013;
                $gold_param['gold_action'] = 'debit';
                $gold_param['gold_plugin'] = 'gold_system';
                $gold_param['gold_log'] = LAN_GS_BULK017 . ' ' . $_POST['gold_bulk_amount'] . ' ' . LAN_GS_BULK018 . ' : ' . $tp->toDB($_POST['gold_comment']);
                $fred = $gold_obj->gold_modify($gold_param);
                $gold_msg = ADLAN_GS_M016 ;
                $gold_result .= $tp->toFORM($gbulk_row['user_name']) . '<br />';
                $gold_action = '';
            }
        }
    }
}

if ($gold_action == '')
{
    $gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_form" >
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
			<td class="fcaption" colspan="4" style="text-align:left">' . ADLAN_GS_M001 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="4" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
		</tr>
				<tr>
			<td class="forumheader2" colspan="4" style="text-align:left"><b>' . LAN_GS_BULK016 . '</b><br />' . $gold_result . '&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:20%;text-align:left;" ><b>' . LAN_GS_BULK005 . '</b></td>
			<td class="forumheader2" style="width:20%;text-align:left;" ><b>' . LAN_GS_BULK006 . '</b></td>
			<td class="forumheader2" style="width:20%;text-align:left;" ><b>' . LAN_GS_BULK007 . '</b></td>
			<td class="forumheader2" style="width:40%;text-align:left;" ><b>' . LAN_GS_BULK011 . '</b></td>
		</tr>
		<tr>
			<td class="forumheader3" style="text-align:left;" >' . r_userclass('gold_bulk_class', 0, 'off', 'members,admin,main,nobody,classes') . '</td>
			<td class="forumheader3" style="text-align:left;" >
				<input type="text" class="tbox" name="gold_bulk_amount" value="0" />
			</td>

			<td class="forumheader3" style="text-align:left;" >
				<input type="radio" class="tbox" name="gold_crdr" value="1" />' . LAN_GS_BULK002 . '
				<input type="radio" class="tbox" name="gold_crdr" value="2" />' . LAN_GS_BULK003 . '
			</td>
			<td class="forumheader3" style="text-align:left;" >
				<textarea class="tbox" rows="4" cols="60" style="width:80%" name="gold_comment" ></textarea>
			</td>
		</tr>
	<tr>
		<td class="forumheader2" colspan="4" style="text-align:left">
			<input type="submit" class="button" name="gold_bulk_submit"  onclick=\'return confirm("' . LAN_GS_BULK008 . '")\' value="' . LAN_GS_BULK004 . '" />
			</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="4" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';
}
$ns->tablerender(LAN_GS_BULK001, $gold_text);
require_once(e_ADMIN . 'footer.php');
function is_odd($number)
{
    return $number &1;
}
