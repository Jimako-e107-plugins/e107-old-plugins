<?php
/*
+---------------------------------------------------------------+
|	Auto Promote Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2009
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN . "auto_promote/languages/admin/" . e_LANGUAGE . ".php");


$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = APROM_A13;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_criteria']['text'] = APROM_A28;
$var['admin_criteria']['link'] = "admin_criteria.php";

$var['admin_promote']['text'] = APROM_A15;
$var['admin_promote']['link'] = "admin_promote.php";

$var['admin_readme']['text'] = APROM_A36;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = APROM_A10;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

$aprom_donate="
<form method='post' action='https://www.paypal.com/cgi-bin/webscr' id='paypal_donate_form'>
	<div style='text-align:center;'>
		<input type='hidden' name='cmd' value='_xclick' />
    	<input type='hidden' name='business' value='bazpaypal@keal.me.uk' id='paypal_donate_email' />
		<input type='hidden' name='item_name' value='Donation for e107plugins' />
		<input type='hidden' name='currency_code' value='GBP' />
		<input type='hidden' name='no_shipping' value='1' />
		<input type='hidden' name='no_note' value='1' />
		<input type='hidden' name='cn' value='Comments' />
		<input type='hidden' name='return' value='http://www.keal.me.uk/plugins/custompages/paypal_donation.php' />
		<input type='hidden' name='cancel_return' value='http://www.keal.me.uk/plugins/custompages/paypal_cancel.php' />
".APROM_D02."
		<div style='padding-top:5px'>
    		<input type='image' name='submit'  src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' alt='' title='Make a Donation with PayPal' style='border:none' />
    	</div>

    </div>
</form>";

show_admin_menu(APROM_A1, $action, $var);
$ns -> tablerender(APROM_D01, $aprom_donate, 'aprom_donate');
