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
include_lan(e_PLUGIN . "gold_system/languages/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . 'gold_system/includes/gold_class.php');
if (!is_object($gold_obj))
{
    $gold_obj = new gold;
}
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value)
{
    $value = urlencode(stripslashes($value));
    $req .= "&{$key}={$value}";
}

$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$payment_amount = $_POST['mc_gross'];
$payment_status = $_POST['payment_status'];
$item_name = $_POST['item_name'];
$user_id = intval($_POST['custom']);
$business = $_POST['business'];
$currency_code = $_POST['mc_currency'];
$pending_reason = $_POST['pending_reason'];
if ($fp)
{
    fputs ($fp, $header . $req);
    while (!feof($fp))
    {
        $res = fgets ($fp, 1024);
        if (strcmp ($res, "VERIFIED") == 0)
        {
            if ($item_name == $GOLD_PREF['buy_gold_item_name'] && $business == $GOLD_PREF['buy_gold_account'] && $currency_code == $GOLD_PREF['buy_gold_currency'] && $payment_status == "Completed")
            {
                // get user ID
                $gold_param['gold_user_id'] = $user_id;
                $gold_param['gold_who_id'] = 0;
                $gold_param['gold_amount'] = ($payment_amount * $GOLD_PREF['buy_gold_cost'] );
                $gold_param['gold_type'] = LAN_GS_BG012;
                $gold_param['gold_action'] = 'credit';
                $gold_param['gold_plugin'] = 'gold_system';
                $gold_param['gold_log'] = LAN_GS_BG013 . ' : ' . $payment_amount . ' ' . $payment_status . ' ' . $pending_reason;
                $gold_param['gold_forum'] = 0;
                $gold_obj->gold_modify($gold_param);
            }
        }
    }
    fclose ($fp);
}

?>