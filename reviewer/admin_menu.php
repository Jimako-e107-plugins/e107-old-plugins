<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
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
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
e107_require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = REVIEWER_M003;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_cat']['text'] = REVIEWER_M004;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_items']['text'] = REVIEWER_M005;
$var['admin_items']['link'] = "admin_items.php";

$var['admin_submit']['text'] = REVIEWER_M009;
$var['admin_submit']['link'] = "admin_submit.php";

$var['admin_recalc']['text'] = REVIEWER_M008;
$var['admin_recalc']['link'] = "admin_recalc.php";


$var['admin_readme']['text'] = REVIEWER_M006;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = REVIEWER_M007;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(REVIEWER_M002, $action, $var);

$fb_donate="
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
".FB_D02."
		<div style='padding-top:5px'>
    		<input type='image' name='submit'  src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' alt='' title='Make a Donation with PayPal' style='border:none' />
    	</div>

    </div>
</form>";

$ns -> tablerender(FB_D01, $fb_donate, 'fb_donate');
