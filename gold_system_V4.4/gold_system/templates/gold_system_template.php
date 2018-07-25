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
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}
global $gold_shortcodes;
// *********************************************************************************************************
// *
// *		Template for History.php History of transactions
// *		Traditional (not PDF)
// *
// *********************************************************************************************************
if (!isset($GOLD_HISTORY_THEADER))
{
    $GOLD_HISTORY_THEADER = "
	<table class='fborder' style='" . USER_WIDTH . "' id='gold_history'>
		<thead>
		<tr>
			<td class='fcaption' colspan='5'>{GOLD_HIST_TITLE}</td>
		</tr>
		<tr>
			<td class='forumheader' colspan='5'>{GOLD_HIST_PREVRECS}</td>
		</tr>
		<tr>
			<td class='forumheader' colspan='5'>" . LAN_GS_H017 . " {GOLD_HIST_CURRENTBAL} : " . LAN_GS_H004 . " {GOLD_MONTH_SEL} {GOLD_YEAR_SEL}  {GOLD_SEL_FILTER}</td>
		</tr>
		<tr>
			<td class='forumheader' style='width:25%;' ><b>" . LAN_GS_H005 . "</b></td>
			<td class='forumheader' style='width:20%;' ><b>" . LAN_GS_H006 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;' ><b>" . LAN_GS_H007 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;' ><b>" . LAN_GS_H016 . "</b></td>
			<td class='forumheader' style='width:35%;' ><b>" . LAN_GS_H009 . "</b></td>
		</tr>
		</thead>
		<tbody>	";
}
if (!isset($GOLD_HISTORY_TDETAIL))
{
    $GOLD_HISTORY_TDETAIL = "
		<tr>
			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_DATE}</span></td>
			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_TYPE}</span></td>
			<td class='forumheader3' style='text-align:right;white-space: nowrap'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_AMOUNT}</span></td>
			<td class='forumheader3' style='text-align:right;'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_BALANCE}</span></td>
			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_COMMENT}</span></td>
		</tr>	";
}
if (!isset($GOLD_HISTORY_TNODETAIL))
{
    $GOLD_HISTORY_TNODETAIL = "
		<tr>
			<td class='forumheader3' colspan='5'>" . LAN_GS_H002 . "</td>
		</tr>";
}

if (!isset($GOLD_HISTORY_TFOOTER))
{
    $GOLD_HISTORY_TFOOTER = "
    </tbody>
		<tr>
			<td class='forumheader'>" . LAN_GS_H012 . " <b>{GOLD_HIST_TRANS}</b></td>
			<td class='forumheader' colspan='2' >{GOLD_CURRENCY_NAME} " . LAN_GS_H013 . " <b>{GOLD_HIST_GOLDIN}</b></td>
			<td class='forumheader' >{GOLD_CURRENCY_NAME} " . LAN_GS_H014 . " <b>{GOLD_HIST_GOLDOUT}</b></td>
			<td class='forumheader' >&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='6'>{GOLD_HIST_NEXTREV}&nbsp;</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5'>&nbsp;</td>
		</tr>
	</table>";
}
// *********************************************************************************************************
// *
// *		Template for History.php History of transactions
// *
// *********************************************************************************************************
if (!isset($GOLD_HISTORY_HEADER))
{
    $GOLD_HISTORY_HEADER = "
	<table class='fborder' style='" . USER_WIDTH . "' id='gold_history'>
		<thead>
		<tr>
			<td class='fcaption' colspan='5'>{GOLD_HIST_TITLE}</td>
		</tr>
		<tr>
			<td class='forumheader' colspan='5'>{GOLD_HIST_PREVRECS}</td>
		</tr>
		<tr>
			<td class='forumheader' colspan='5'>" . LAN_GS_H017 . " {GOLD_HIST_CURRENTBAL} : " . LAN_GS_H004 . " {GOLD_MONTH_SEL} {GOLD_YEAR_SEL}</td>
		</tr>
		<tr>
			<td class='forumheader' style='width:25%;' ><b>" . LAN_GS_H005 . "</b></td>
			<td class='forumheader' style='width:20%;' ><b>" . LAN_GS_H006 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;' ><b>" . LAN_GS_H007 . "</b></td>
			<td class='forumheader' style='width:10%;text-align:right;' ><b>" . LAN_GS_H016 . "</b></td>
			<td class='forumheader' style='width:35%;' ><b>" . LAN_GS_H009 . "</b></td>
		</tr>
		</thead>
		<tbody>	";
}
if (!isset($GOLD_HISTORY_DETAIL))
{
    $GOLD_HISTORY_DETAIL = "
		<tr>
			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_DATE}</span></td>
			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_TYPE}</span></td>
			<td class='forumheader3' style='text-align:right;white-space: nowrap'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_AMOUNT}</span></td>
			<td class='forumheader3' style='text-align:right;'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_BALANCE}</span></td>
			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_COMMENT}</span></td>
		</tr>	";
}
if (!isset($GOLD_HISTORY_NODETAIL))
{
    $GOLD_HISTORY_NODETAIL = "
		<tr>
			<td class='forumheader3' colspan='5'>" . LAN_GS_H002 . "</td>
		</tr>";
}

if (!isset($GOLD_HISTORY_FOOTER))
{
    $GOLD_HISTORY_FOOTER = "
    </tbody>
		<tr>
			<td class='forumheader'>" . LAN_GS_H012 . " <b>{GOLD_HIST_TRANS}</b></td>
			<td class='forumheader' colspan='2' >{GOLD_CURRENCY_NAME} " . LAN_GS_H013 . " <b>{GOLD_HIST_GOLDIN}</b></td>
			<td class='forumheader' >{GOLD_CURRENCY_NAME} " . LAN_GS_H014 . " <b>{GOLD_HIST_GOLDOUT}</b></td>
			<td class='forumheader' >&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='6'>{GOLD_HIST_NEXTREV}&nbsp;</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5'>&nbsp;</td>
		</tr>
	</table>";
}
// *********************************************************************************************************
// *
// *		Template for donate.php Donate page
// *
// *********************************************************************************************************
if (!isset($GOLD_DONATE))
{
    $GOLD_DONATE = '
<table class="fborder" style="' . USER_WIDTH . '">
	<tr>
		<td colspan="2" class="fcaption">' . LAN_GS_6 . ' {GOLD_CURRENCY_NAME}</td>
	</tr>
	<tr>
		<td colspan="2" class="forumheader2"><b>{GOLD_MESSAGE}</b>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="forumheader2">' . LAN_GS_DG006 . ' {GOLD_CURRENCY_NAME} ' . LAN_GS_DG007 . ' {GOLD_DONATE_MAXIMUM}</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%" >' . LAN_GS_DG005 . '</td>
		<td class="forumheader3" style="width:70%" ><b>{GOLD_DONATE_BALANCE}</b></td>
	</tr>
	<tr>
		<td class="forumheader3">' . LAN_GS_DG003 . '</td>
		<td class="forumheader3">{GOLD_GETUSERNAME=user}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . LAN_GS_DG002 . '</td>
		<td class="forumheader3">{GOLD_DONATE_AMOUNT}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . LAN_GS_DG004 . '</td>
		<td class="forumheader3">{GOLD_DONATE_COMMENT}</td>
	</tr>
	<tr>
		<td class="forumheader" colspan="2" style="text-align:center">{GOLD_DONATE_SUBMIT}</td>
	</tr>
	<tr>
		<td colspan="2" class="fcaption">&nbsp;</td>
	</tr>
</table>
';
}
// *********************************************************************************************************
// *
// *		Template for buy_gold.php Buy Gold page
// *
// *********************************************************************************************************
if (!isset($GOLD_BUYGOLD_HEADER))
{
    $GOLD_BUYGOLD_HEADER = "
<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' style='width:100%;'>" . $title . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='text-align:center;width:100%;'><img src='".e_PLUGIN."gold_system/images/buy_gold.png' style='border:0px;' alt='buy_gold' /></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:100%;'>{GOLD_BUY_MESSAGE}&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:100%;'>";
}
if (!isset($GOLD_BUYGOLD_DETAIL))
{
    $GOLD_BUYGOLD_DETAIL .= LAN_GS_BG002 . " {GOLD_CURRENCY_NAME} " . LAN_GS_BG003 . " {GOLD_BUY_CURRENCY}
	<br /><br />" . LAN_GS_BG004 . ": <b>{GOLD_BUY_COST}</b> {GOLD_BUY_CURRENCY} " . LAN_GS_BG005 . " <b>{GOLD_BUY_UNITCOST}</b>
	<br /><br />" . LAN_GS_BG006 . " {GOLD_CURRENCY_NAME} " . LAN_GS_BG007 . "
	<br /><br />" . LAN_GS_BG010 . " <b>{GOLD_BUY_MYBALANCE}</b><br /><br />
	<div style='text-align:center;'>{GOLD_BUY_PAYPAL}</div>";
}
if (!isset($GOLD_BUYGOLD_NODETAIL))
{
    $GOLD_BUYGOLD_NODETAIL .= LAN_GS_BG008 . " {GOLD_CURRENCY_NAME} " . LAN_GS_BG009;
}
if (!isset($GOLD_BUYGOLD_FOOTER))
{
    $GOLD_BUYGOLD_FOOTER .= "
    	</td>
    </tr>
</table>";
}
// *********************************************************************************************************
// *
// *		Template for shop.php Shop page
// *
// *********************************************************************************************************
if (!isset($GOLD_SHOP_HEADER))
{
    $GOLD_SHOP_HEADER .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption">' . LAN_GS_ORB_104 . '</td>
	<tr>
	<tr>
		<td class="forumheader2"><b>{GOLD_SHOP_MESSAGE}</b>&nbsp;</td>
	<tr>
	<tr>
		<td class="forumheader3">' . LAN_GS_ORB_105 . ' {GOLD_SHOP_BALANCE}</td>
	<tr>
</table>		';
}
if (!isset($GOLD_SHOP_TITLE))
{
    $GOLD_SHOP_TITLE .= '
<table class="fborder" style="' . USER_WIDTH . '">
	<tr>
		<td rowspan="4" class="fcaption" style="width:33%;text-align:center;" >
			<img src="' . e_PLUGIN . 'gold_system/images/merchant.gif" border="0">
		</td>
		<td class="forumheader2" style="width:46%">
			' . LAN_GS_58 . '<br /><span class="smalltext">' . LAN_GS_59 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_CUSTOMTITLE} {GOLD_BUY_TITLE_BUTTON}</td>
	</tr>

	<tr>
		<td class="forumheader2" style="width:33%;">
			' . LAN_GS_33 . '<br /><span class="smalltext">' . LAN_GS_34 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_DISPLAY} {GOLD_BUY_NAME_BUTTON}</td>
	</tr>

	<tr>
		<td class="forumheader2" style="width:33%;">
			' . LAN_GS_35 . '<br /><span class="smalltext">' . LAN_GS_36 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_SIGNATURE} {GOLD_BUY_SIGNATURE_BUTTON}</td>
	</tr>

	<tr>
		<td class="forumheader2" style="width:33%;">
			' . LAN_GS_37 . '<br /><span class="smalltext">' . LAN_GS_38 . '</span>
		</td>
		<td class="forumheader" style="width:21%;text-align:right;font-weight: bold" >{GOLD_SHOP_AVATAR} {GOLD_BUY_AVATAR_BUTTON}</td>
	</tr>
</table>';
}

if (!isset($GOLD_SHOP_CUSTOMTITLE))
{
    $GOLD_SHOP_CUSTOMTITLE .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . LAN_GS_ORB_110 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%;" >' . LAN_GS_58 . '<br /><span class="smalltext">' . LAN_GS_59 . '</span></td>
		<td class="forumheader3">{GOLD_BUY_TITLE}</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:center">{GOLD_BUY_SUBMIT}</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2">&nbsp;</td>
	</tr>
</table>';
}
if (!isset($GOLD_SHOP_DISPLAYNAME))
{
    $GOLD_SHOP_DISPLAYNAME .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . LAN_GS_ORB_111 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%;" >' . LAN_GS_33 . '<br /><span class="smalltext">' . LAN_GS_34 . '</span></td>
		<td class="forumheader3">{GOLD_BUY_DISPLAYNAME}</td>
	</tr>
	<tr>
		<td class="forumheader" colspan="2" style="text-align:center">{GOLD_BUY_SUBMIT}</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2">&nbsp;</td>
	</tr>
</table>';
}

if (!isset($GOLD_SHOP_SIGNATURE))
{
    $GOLD_SHOP_SIGNATURE .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . LAN_GS_ORB_112 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2">' . LAN_GS_ORB_113 . '</td>
	</tr>

	<tr>
		<td class="forumheader3" colspan="2">{GOLD_BUY_SIGPREVIEW}&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader3" style="vertical-align:top;" >' . LAN_GS_35 . '<br /><span class="smalltext">' . LAN_GS_36 . '</span></td>
		<td class="forumheader2">{GOLD_BUY_SIGNATURE}
		</td>
	</tr>
	<tr>
		<td class="forumheader" colspan="2" style="text-align:center">
		{GOLD_BUY_PREVIEW}&nbsp;&nbsp;{GOLD_BUY_SUBMIT}
		</td>
	</tr>
</table>
';
}

if (!isset($GOLD_SHOP_AVATAR))
{
    $GOLD_SHOP_AVATAR .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . LAN_GS_ORB_114 . '</td>
	</tr>
	<tr>
		<td class="forumheader3">' . LAN_GS_ORB_131 . '<br /><span class="smalltext">' . LAN_GS_ORB_132 . '</span></td>
		<td class="forumheader3">{GOLD_BUY_AVATAR_IMAGE}</td>
	</tr>
	<tr>
		<td class="forumheader3">' . LAN_GS_ORB_116 . '<br /><span class="smalltext">{GOLD_BUY_AVATAR_STATUS}</span></td>
		<td class="forumheader3">{GOLD_BUY_AVATAR_UPLOAD}</td>
	</tr>
	<tr>
		<td class="forumheader3" style="vertical-align:top;" >' . LAN_GS_53 . '<br /><span class="smalltext">' . LAN_GS_54 . '</span></td>
		<td class="forumheader3" style="vertical-align:top;" >{GOLD_BUY_SITEAVATAR}</td>
	</tr>
	<tr>
		<td class="forumheader" colspan="2" style="text-align:center">{GOLD_BUY_SUBMIT}&nbsp;&nbsp;{GOLD_BUY_RESET}</td>
	</tr>
</table>';
}
if (!isset($GOLD_SHOP_NOTUSER))
{
    $GOLD_SHOP_NOTUSER .= '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2">' . LAN_GS_42 . '</td>
	</tr>
	<tr>
		<td class="forumheader3" colspan="2">' . LAN_GS_ORB_125 . '</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2">&nbsp;</td>
	</tr>
</table>';
}
// *********************************************************************************************************
// *
// *		Template for History.php History of transactions
// *
// *********************************************************************************************************
#if (!isset($GOLD_ADMIN_HISTORY_HEADER))
#{
#    $GOLD_ADMIN_HISTORY_HEADER = "
#	<table class='fborder' style='" . ADMIN_WIDTH . "' >
#		<tr>
#			<td class='fcaption' colspan='5'>" . LAN_GS_H015 . "</td>
#		</tr>
#		<tr>
#			<td class='forumheader2' colspan='5'><a href='" . e_SELF . "'><img src='" . e_PLUGIN . "gold_system/images/updir.png' title='back' alt=back' /></a></td>
#		</tr>
#
#		<tr>
#			<td class='forumheader2' colspan='5'>" . LAN_GS_H017 . " {GOLD_HIST_CURRENTBAL}</td>
#		</tr>
#		<tr>
#			<td class='forumheader' colspan='5'>" . LAN_GS_H004 . " {GOLD_HIST_PREVRECS}</td>
#		</tr>
#		<tr>
#			<td class='forumheader' colspan='5'>" . LAN_GS_H004 . " {GOLD_MONTH_SEL} {GOLD_YEAR_SEL}</td>
#		</tr>
#		<tr>
#			<td class='forumheader' style='width:25%;' ><b>" . LAN_GS_H005 . "</b></td>
#			<td class='forumheader' style='width:20%;' ><b>" . LAN_GS_H006 . "</b></td>
#			<td class='forumheader' style='width:10%;text-align:right;' ><b>" . LAN_GS_H007 . "</b></td>
#			<td class='forumheader' style='width:10%;text-align:right;' ><b>" . LAN_GS_H016 . "</b></td>
#			<td class='forumheader' style='width:35%;' ><b>" . LAN_GS_H009 . "</b></td>
#		</tr>	";
#}
#if (!isset($GOLD_ADMIN_HISTORY_DETAIL))
#{
#    $GOLD_ADMIN_HISTORY_DETAIL = "
#		<tr>
#			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_DATE}</span></td>
#			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_TYPE}</span></td>
#			<td class='forumheader3' style='text-align:right;white-space: nowrap'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_AMOUNT}</span></td>
#			<td class='forumheader3' style='text-align:right;white-space: nowrap'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_BALANCE}</span></td>
#
#			<td class='forumheader3'><span class='{GOLD_HIST_CLASS}'>{GOLD_HIST_COMMENT}</span></td>
#		</tr>	";
#}
#if (!isset($GOLD_ADMIN_HISTORY_NODETAIL))
#{
#    $GOLD_ADMIN_HISTORY_NODETAIL = "
#		<tr>
#			<td class='forumheader3' colspan='5'>" . LAN_GS_H002 . "</td>
#		</tr>";
#}
#
#if (!isset($GOLD_ADMIN_HISTORY_FOOTER))
#{
#    $GOLD_ADMIN_HISTORY_FOOTER = "
#		<tr>
#			<td class='forumheader'>" . LAN_GS_H012 . " <b>{GOLD_HIST_TRANS}</b></td>
#			<td class='forumheader' colspan='2' >{GOLD_CURRENCY_NAME} " . LAN_GS_H013 . " <b>{GOLD_HIST_GOLDIN}</b></td>
#			<td class='forumheader' >{GOLD_CURRENCY_NAME} " . LAN_GS_H014 . " <b>{GOLD_HIST_GOLDOUT}</b></td>
#			<td class='forumheader' >&nbsp;</td>
#		</tr>
#		<tr>
#			<td class='fcaption' colspan='5'>&nbsp;</td>
#		</tr>
#	</table>";
#}
// if (!isset($GOLD_INV_DETAIL))
// {
// $GOLD_INV_DETAIL = "
// <td style='width:33%;vertical-align:top;'>
// <table  style='width:100%'>
// <tr>
// <td class='fcaption' ><div class='{GOLD_INV_ORBCLASS}' id='{GOLD_INV_ORBID}'>{GOLD_INV_ORBTITLE}</div></td>
// </tr>
// <tr>
// <td class='forumheader' >{GOLD_INV_ORBIMG}</td>
// </tr>
// <tr>
// <td class='forumheader3' >{GOLD_INV_ORBWORDS}</td>
// </tr>
// <tr>
// <td class='forumheader' >{GOLD_INV_WIELD}</td>
// </tr>
// </table>
// </td>";
// }
// if (!isset($GOLD_INV_NOT))
// {
// $GOLD_INV_NOT = "
// <td style='width:33%;vertical-align:top;'>
// <table style='width:100%'>
// <tr>
// <td class='fcaption'><div class='{GOLD_INV_ORBCLASS}' id='{GOLD_INV_ORBID}'>{GOLD_INV_ORBTITLE}</div></td>
// <tr>
// <tr>
// <td class='forumheader' >{GOLD_INV_ORBIMG}</td>
// </tr>
// <tr>
// <td class='forumheader3' >You do not posess an {GOLD_INV_ORBTITLE}</td>
// <tr>
// <tr>
// <td class='forumheader3' >Why not visit the shop?</td>
// <tr>
// </table>
// </td>";
// }
// if (!isset($GOLD_INV_HEADER))
// {
// $GOLD_INV_HEADER = "
// <table class='fborder' style='" . USER_WIDTH . "'>
// <tr>
// <td class='fcaption' colspan='3'>" . LAN_GS_INV001 . "</td>
// </tr>
// <tr>
// <td colspan='3'><b>{GOLD_INV_MESSAGE}</b>&nbsp;</td>
// </tr>
// <tr>";
// }
// if (!isset($GOLD_INV_FOOTER))
// {
// $GOLD_INV_FOOTER = "
// </tr>
// <tr>
// <td class='fcaption' colspan='3'>&nbsp;</td>
// </tr>
// </table>";
// }
if (!isset($GOLD_CONFIRM_DL))
{
    $GOLD_CONFIRM_DL = '
	<table class="fborder" style="' . USER_WIDTH . '" >
		<tr>
			<td class="fcaption" style="width:100%" >' . LAN_GS_DLC01 . '</td>
		</tr>
		<tr>
			<td class="forumheader3" ><br />' . LAN_GS_DLC02 . ' <b>{GOLD_DLC_DOWNLOAD}</b><br /><br />' . LAN_GS_DLC03 . ' <b>{GOLD_DLC_COST}</b>. ' . LAN_GS_DLC05 . ' <b>{GOLD_DLC_BALANCE}</b>
				<br /><br />' . LAN_GS_DLC04 . '<br /><br />
				{GOLD_DLC_PROCEED}&nbsp;&nbsp;{GOLD_DLC_CANCEL}
			</td>
		</tr>
		<tr>
			<td class="fcaption" style="width:100%" >&nbsp;</td>
		</tr>
	</table>';
}
if (!isset($GOLD_CONFIRM_NODL))
{
    $GOLD_CONFIRM_NODL = '
	<table class="fborder" style="' . USER_WIDTH . '" >
		<tr>
			<td class="fcaption" style="width:100%" >' . LAN_GS_DLC01 . '</td>
		</tr>
		<tr>
			<td class="forumheader3" ><br />' . LAN_GS_DLC02 . ' <b>{GOLD_DLC_DOWNLOAD}</b><br /><br />' . LAN_GS_DLC03 . ' <b>{GOLD_DLC_COST}</b>. ' . LAN_GS_DLC05 . ' <b>{GOLD_DLC_BALANCE}</b>
				<br /><br />' . LAN_GS_DLC08 . '<br /><br />
				{GOLD_DLC_CANCEL}
			</td>
		</tr>
		<tr>
			<td class="fcaption" style="width:100%" >&nbsp;</td>
		</tr>
	</table>';
}
if (!isset($GOLD_MAIN_HEADER))
{
    $GOLD_MAIN_HEADER = '
<table class="fborder" style="' . USER_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="2" >' . LAN_GS_MAIN004 . '</td>
	</tr>
	';
}
if (!isset($GOLD_MAIN_BLOCK1))
{
    $GOLD_MAIN_BLOCK1 = '
	<tr>
		<td style="width:50%;vertical-align:top;">
			<table style="width:100%">
				<tr>
					<td class="fcaption"  >' . LAN_GS_MAIN002 . '</td>
				</tr>
				<tr>
					<td class="forumheader3"><b>' . LAN_GS_MAIN007 . '</b><br />&nbsp;<br />
					{GOLD_MYHISTORY}
					{GOLD_MYDONATE}
					{GOLD_MYPLUGINS}
					</td>
				</tr>
			</table>
		</td>
	';
}
if (!isset($GOLD_MAIN_BLOCK2))
{
    $GOLD_MAIN_BLOCK2 = '
		<td style="width:50%;vertical-align:top;">
			<table style="width:100%">
				<tr>
					<td class="fcaption"  >' . LAN_GS_MAIN003 . '</td>
				</tr>
				<tr>
					<td class="forumheader3"><b>' . LAN_GS_MAIN008 . '</b><br />&nbsp;<br />
					{GOLD_MYDOWNLOAD}
					{GOLD_MYPROFILE}
					{GOLD_MYLINKS}
					{GOLD_MYVISITS}
					{GOLD_MYFORUM}
					{GOLD_MYCOMMENTS}
					{GOLD_MYNEWS}
					{GOLD_MYCHATS}
					{GOLD_MYPLUGCHARGE}
					</td>
				</tr>
			</table>
		</td>
	</tr>';
}
if (!isset($GOLD_MAIN_BLOCK3))
{
    $GOLD_MAIN_BLOCK3 = '
	<tr>
		<td style="width:50%;vertical-align:top;">
			<table style="width:100%">
				<tr>
					<td class="fcaption"  >' . LAN_GS_MAIN005 . '</td>
				</tr>
				<tr>
					<td class="forumheader3">&nbsp;</td>
				</tr>
			</table>
		</td>
	';
}
if (!isset($GOLD_MAIN_BLOCK4))
{
    $GOLD_MAIN_BLOCK4 = '
		<td style="width:50%;vertical-align:top;">
			<table style="width:100%">
				<tr>
					<td class="fcaption"  >' . LAN_GS_MAIN006 . '</td>
				</tr>
				<tr>
					<td class="forumheader3">
					{GOLD_MYDATA}
					{GOLD_MYCLASSES}
					{GOLD_MYTOP}
					{GOLD_MYBOTTOM}
					</td>
				</tr>
			</table>
		</td>
	</tr>';
}
if (!isset($GOLD_MAIN_FOOTER))
{
    $GOLD_MAIN_FOOTER = '
	<tr>
		<td class="fcaption" colspan="2" >&nbsp;</td>
	</tr>
</table>';
}

if (!isset($GOLD_CONFIRM_USER))
{
    $GOLD_CONFIRM_USER = '
	<table class="fborder" style="' . USER_WIDTH . '" >
		<tr>
			<td class="fcaption" style="width:100%" >' . LAN_GS_USR01 . '</td>
		</tr>
		<tr>
			<td class="forumheader3" ><br />' . LAN_GS_USR02 . ' <b>{GOLD_USR_MEMBER}</b> ' . LAN_GS_USR03 . ' {GOLD_USR_CHARGE}<br /><br />' . LAN_GS_USR04 . ' <b>{GOLD_USR_BALANCE}</b>
				<br /><br />' . LAN_GS_USR07 . '<br /><br />
				{GOLD_USR_PROCEED}&nbsp;&nbsp;{GOLD_USR_CANCEL}
			</td>
		</tr>
		<tr>
			<td class="fcaption" style="width:100%" >&nbsp;</td>
		</tr>
	</table>';
}
if (!isset($GOLD_CONFIRM_NOUSER))
{
    $GOLD_CONFIRM_NOUSER = '
	<table class="fborder" style="' . USER_WIDTH . '" >
		<tr>
			<td class="fcaption" style="width:100%" >' . LAN_GS_USR01 . '</td>
		</tr>
		<tr>
			<td class="forumheader3" ><br />' . LAN_GS_USR02 . ' <b>{GOLD_USR_MEMBER}</b>' . LAN_GS_USR03 . ' <b>{GOLD_USR_CHARGE}</b>. ' . LAN_GS_USR04 . ' <b>{GOLD_USR_BALANCE}</b>
				<br /><br />' . LAN_GS_USR08 . '<br /><br />
				{GOLD_USR_CANCEL}
			</td>
		</tr>
		<tr>
			<td class="fcaption" style="width:100%" >&nbsp;</td>
		</tr>
	</table>';
}
