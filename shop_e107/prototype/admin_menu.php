<?php
/*
   +---------------------------------------------------------------+
   |	Prototype Plugin for e107
   |
   |	Copyright (C) Fathr Barry Keal 2003 - 2010
   |	http://www.keal.me.uk
   |
   |	Released under the terms and conditions of the
   |	GNU General Public License (http://gnu.org).
   +---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) {
    exit;
}

include_lan(e_PLUGIN . "prototype/languages/" . e_LANGUAGE . "_prototype.php");
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = PROTOTYPE_M02;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_newsticker']['text'] = PROTOTYPE_M05;
$var['admin_newsticker']['link'] = "admin_newsticker.php";

$var['admin_readme']['text'] = PROTOTYPE_M03;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = PROTOTYPE_M04;
$var['admin_vupdate']['link'] = "admin_vupdate.php";
#print $_SERVER['HTTP_HOST'];
show_admin_menu(PROTOTYPE_M01, $action, $var);
if (strpos($_SERVER['HTTP_HOST'], 'pssportal') === false) {
    $fb_donate = "
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
" . FB_D02 . "
		<div style='padding-top:5px'>
    		<input type='image' name='submit'  src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' alt='' title='Make a Donation with PayPal' style='border:none' />
    	</div>

    </div>
</form>";

    $ns->tablerender(FB_D01, $fb_donate, 'fb_donate');
}