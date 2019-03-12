<?php
/*
+---------------------------------------------------------------+
|	Job Search Plugin for e107
|
|	Copyright (C) Fathr Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php");
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = JOBSCH_A2;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_cat']['text'] = JOBSCH_A3;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_sub']['text'] = JOBSCH_A4;
$var['admin_sub']['link'] = "admin_sub.php";

$var['admin_order']['text'] = JOBSCH_A54;
$var['admin_order']['link'] = "admin_order.php";

$var['admin_local']['text'] = JOBSCH_A130;
$var['admin_local']['link'] = "admin_local.php";

$var['admin_submit']['text'] = JOBSCH_A5;
$var['admin_submit']['link'] = "admin_submit.php";

$var['admin_purge']['text'] = JOBSCH_A101;
$var['admin_purge']['link'] = "admin_purge.php";

$var['admin_docs']['text'] = JOBSCH_A103;
$var['admin_docs']['link'] = "admin_docs.php";

$var['admin_news']['text'] = JOBSCH_A132;
$var['admin_news']['link'] = "admin_news.php";

$var['admin_subs']['text'] = JOBSCH_A178;
$var['admin_subs']['link'] = "admin_subs.php";

$var['admin_readme']['text'] = JOBSCH_A174;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = JOBSCH_A121;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(JOBSCH_A1, $action, $var);

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

