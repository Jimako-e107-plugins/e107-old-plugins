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
require_once(e_HANDLER . "userclass_class.php");
session_start();
if (isset($_POST['gold_usrok']))
{
    // proceed
    $url = $_POST['gold_usrurl'];
    // we have got the OK
    $gold_tmp=explode('?',$url,2);
    $gold_query=$gold_tmp[1];
        if ($pref['plug_installed']['alternate_profiles'])
    {
        $gold_tmp = explode('=', $gold_query);
        $gold_view=$gold_tmp[1];
    }
    else
    {
        $gold_tmp = explode('.', $gold_query);
        $gold_view=$gold_tmp[1];
    }
    $gold_balance = $gold_obj->gold_balance(USERID);
    if ($gold_balance >= $GOLD_PREF['gold_usrcost'])
    {
        $gold_amount = $GOLD_PREF['gold_usrcost'];
        $gold_name=$gold_obj->gold_username($gold_view);
        $gold_param = array('gold_user_id' => USERID,
            'gold_who_id' => 0,
            'gold_amount' => $gold_amount,
            'gold_plugin' => 'gold_system',
            'gold_type' => LAN_GS_ACTION07,
            'gold_action' => 'debit',
            'gold_log' => LAN_GS_USR09.' - '.$gold_name.' -');
        $gold_obj->gold_modify($gold_param);
        $_SESSION['gold_ulastid'] = $gold_view;
        header("Location:{$url}");
    }
    else
    {
        // insufficient funds
        $site = SITEURL . "index.php";
        $alert = LAN_GS_3 . ' ' . $GOLD_PREF['gold_currency_name'] . ' ' . LAN_GS_2;
        echo "<script>alert('{$alert}'); document.location = '{$site}';</script>";
        exit;
    }

    exit;
} elseif (isset($_POST['goldusrcancel']))
{
    $url = SITEURL . '/index.php';
    header("Location:{$url}");
    exit;
}
else
{
    include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_gold_system.php');
    require_once(e_PLUGIN . 'gold_system/includes/gold_system_shortcodes.php');

    global $GOLD_PREF, $gold_obj;
    require_once(HEADERF);
    require_once(GOLD_THEME);
    $gold_request = e_QUERY;
    $gold_tmp = explode('.', e_QUERY);
    $gold_usrid = intval($gold_tmp[1]);
    $gold_usrbalance = $gold_obj->gold_balance(USERID);
    $gold_charge = $GOLD_PREF['gold_usrcost'];

    if ($pref['plug_installed']['alternate_profiles'])
    {
        $gold_equery = str_replace('.', '=' , e_QUERY);
        $gold_tourl = SITEURL . $PLUGINS_DIRECTORY . 'alternate_profiles/newuser.php?' . $gold_equery;
    }
    else
    {
        $gold_tourl = SITEURL . 'user.php?' . e_QUERY;
    }
    $gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_usr">
	<div>
		<input type="hidden" name="gold_usrurl" value="' . $gold_tourl . '" />
		<input type="hidden" name="gold_usrid" value="' . $gold_usrid . '" />
	</div>';
    if ($gold_charge < $gold_usrbalance)
    {
        $gold_text .= $tp->parsetemplate($GOLD_CONFIRM_USER, true, $gold_shortcodes);
    }
    else
    {
        $gold_text .= $tp->parsetemplate($GOLD_CONFIRM_NOUSER, true, $gold_shortcodes);
    }
    $gold_text .= '
</form>
 ';
}
$ns->tablerender($title, $gold_text);
require_once(FOOTERF);

?>