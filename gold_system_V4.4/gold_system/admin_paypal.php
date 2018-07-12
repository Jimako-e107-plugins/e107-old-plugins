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
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');

if (isset($_POST['updatesettings']))
{
    $GOLD_PREF['buy_gold_account'] = $_POST['buy_gold_account'];
    $GOLD_PREF['buy_gold_notify_url'] = $_POST['buy_gold_notify_url'];
    $GOLD_PREF['buy_gold_return_url'] = $_POST['buy_gold_return_url'];
    $GOLD_PREF['buy_gold_cancel_url'] = $_POST['buy_gold_cancel_url'];
    $GOLD_PREF['buy_gold_currency'] = $_POST['buy_gold_currency'];
    $GOLD_PREF['buy_gold_item_name'] = $_POST['buy_gold_item_name'];
    $GOLD_PREF['buy_gold_cost'] = $_POST['buy_gold_cost'];
    $GOLD_PREF['buy_gold_perunit'] = $_POST['buy_gold_perunit'];
    $gold_obj->save_prefs();
    $gold_msg = ADLAN_GS_PP09;
}
$selected = " selected='selected'";
switch ($GOLD_PREF['buy_gold_currency'])
{
    case "AUD":
        $aud = $selected;
        break;
    case "CAD":
        $cad = $selected;
        break;
    case "CHF":
        $chf = $selected;
        break;
    case "CZK":
        $czk = $selected;
        break;
    case "DKK":
        $dkk = $selected;
        break;
    case "EUR":
        $eur = $selected;
        break;
    case "GBP":
        $gbp = $selected;
        break;
    case "HKD":
        $hkd = $selected;
        break;
    case "HUF":
        $huf = $selected;
        break;
    case "JPY":
        $jpy = $selected;
        break;
    case "NOK":
        $nok = $selected;
        break;
    case "NZD":
        $nzd = $selected;
        break;
    case "PLN":
        $pln = $selected;
        break;
    case "SEK":
        $sek = $selected;
        break;
    case "SGD":
        $sgd = $selected;
        break;
    case "USD":
        $usd = $selected;
        break;
    case "ILS":
        $ils = $selected;
        break;
    case "MXN":
        $mxn = $selected;
        break;
}
$gold_text = "
<form method='post' id='gold_paypal' action='" . e_SELF . "' >
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . ADLAN_GS_PP01 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left'><b>" . $gold_msg . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP02 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_account' size='35' value='" . $GOLD_PREF['buy_gold_account'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP03 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_notify_url' size='35' value='" . $GOLD_PREF['buy_gold_notify_url'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP04 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_return_url' size='35' value='" . $GOLD_PREF['buy_gold_return_url'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP05 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_cancel_url' size='35' value='" . $GOLD_PREF['buy_gold_cancel_url'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP06 . "</td>
			<td class='forumheader3' style='width:70%'>
				<select name='buy_gold_currency' class='tbox' >
					<option value='AUD'" . $aud . ">".ADLAN_GS_PP11."</option>
					<option value='CAD'" . $cad . ">".ADLAN_GS_PP12."</option>
					<option value='CHF'" . $chf . ">".ADLAN_GS_PP13."</option>
					<option value='CZK'" . $czk . ">".ADLAN_GS_PP14."</option>
					<option value='DKK'" . $dkk . ">".ADLAN_GS_PP15."</option>
					<option value='EUR'" . $eur . ">".ADLAN_GS_PP16."</option>
					<option value='GBP'" . $gbp . ">".ADLAN_GS_PP17."</option>
					<option value='HKD'" . $hkd . ">".ADLAN_GS_PP18."</option>
					<option value='HUF'" . $huf . ">".ADLAN_GS_PP19."</option>
					<option value='JPY'" . $jpy . ">".ADLAN_GS_PP20."</option>
					<option value='NOK'" . $nok . ">".ADLAN_GS_PP21."</option>
					<option value='NZD'" . $nzd . ">".ADLAN_GS_PP22."</option>
					<option value='PLN'" . $pln . ">".ADLAN_GS_PP23."</option>
					<option value='SEK'" . $sek . ">".ADLAN_GS_PP24."</option>
					<option value='SGD'" . $sgd . ">".ADLAN_GS_PP25."</option>
					<option value='USD'" . $usd . ">".ADLAN_GS_PP26."</option>
					<option value='ILS'" . $ils . ">".ADLAN_GS_PP27."</option>
					<option value='MXN'" . $mxn . ">".ADLAN_GS_PP28."</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP07 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_item_name' value='" . $GOLD_PREF['buy_gold_item_name'] . "' />
			</td>
		</tr>
				<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP08 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_cost' value='" . $GOLD_PREF['buy_gold_cost'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . ADLAN_GS_PP10 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_perunit' value='" . $GOLD_PREF['buy_gold_perunit'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left'>
				<input type='submit' class='button' name='updatesettings' value='" . ADLAN_GS_18 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>
	";

$ns->tablerender(ADLAN_GS, $gold_text);
require_once(e_ADMIN . "footer.php");
