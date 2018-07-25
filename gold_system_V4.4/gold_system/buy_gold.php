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

include_lan(e_PLUGIN . "gold_system/languages/" . e_LANGUAGE . "_gold_system.php");
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
require_once(e_PLUGIN . "gold_system/includes/gold_system_shortcodes.php");
$title = LAN_GS_BG001 . " {$GOLD_PREF['gold_currency_name']}";
define("e_PAGETITLE", $title);
require_once(HEADERF);
require_once(GOLD_THEME);
if (e_QUERY == "return")
{
    $gold_buy_message = LAN_GS_BG014;
}

if (e_QUERY == "cancel")
{
    $gold_buy_message = LAN_GS_BG015;
}

$gold_text .= $tp->parsetemplate($GOLD_BUYGOLD_HEADER, true, $gold_shortcodes);
if (USER)
{

    $gold_mybalance = $gold_obj->gold_balance(USERID);
#    $gold_text .= '
#<form action="https://sandbox.google.com/checkout/api/checkout/v2/checkoutForm/Merchant/656120108542765" id="BB_BuyButtonForm" method="post" name="BB_BuyButtonForm">
#    <input name="item_name_1" type="hidden" value="Gold"/>
#    <input name="item_description_1" type="hidden" value="Gold"/>
#    <input name="item_quantity_1" type="hidden" value="1"/>
#    <input name="item_price_1" type="hidden" value="1.0"/>
#    <input name="item_currency_1" type="hidden" value="GBP"/>
#    <input name="_charset_" type="hidden" value="utf-8"/>
#    <input alt="" src="https://sandbox.google.com/checkout/buttons/buy.gif?merchant_id=656120108542765&amp;w=117&amp;h=48&amp;style=trans&amp;variant=text&amp;loc=en_US" type="image"/>
#</form>
#';
    $gold_text .= "

<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
	<div >
		<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
		<input type=\"hidden\" name=\"business\" value=\"" . $GOLD_PREF['buy_gold_account'] . "\">
		<input type=\"hidden\" name=\"item_name\" value=\"" . $GOLD_PREF['buy_gold_item_name'] . "\">
		<input type=\"hidden\" name=\"undefined_quantity\" value=\"1\">
		<input type=\"hidden\" name=\"amount\" value=\"" . $GOLD_PREF['buy_gold_cost'] . "\">
		<input type=\"hidden\" name=\"custom\" value=\"" . USERID . "\">
		<input type=\"hidden\" name=\"no_shipping\" value=\"1\">
		<input type=\"hidden\" name=\"notify_url\" value=\"" . $GOLD_PREF['buy_gold_notify_url'] . "\">
		<input type=\"hidden\" name=\"return\" value=\"" . $GOLD_PREF['buy_gold_return_url'] . "\">
		<input type=\"hidden\" name=\"cancel_return\" value=\"" . $GOLD_PREF['buy_gold_cancel_url'] . "\">
		<input type=\"hidden\" name=\"no_note\" value=\"1\">
		<input type=\"hidden\" name=\"currency_code\" value=\"" . $GOLD_PREF['buy_gold_currency'] . "\">
		<input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF\">
	</div>";
    $gold_text .= $tp->parsetemplate($GOLD_BUYGOLD_DETAIL, true, $gold_shortcodes);
}
else
{
    $gold_text .= $tp->parsetemplate($GOLD_BUYGOLD_NODETAIL, true, $gold_shortcodes);
}
$gold_text .= $tp->parsetemplate($GOLD_BUYGOLD_FOOTER, true, $gold_shortcodes);
$gold_text .= "
</form>";

$ns->tablerender($title, $gold_text);
require_once(FOOTERF);

?>