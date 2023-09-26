<?php


/*
##########################
# Donation Listing       #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
*/



require_once("../../class2.php");
if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

if (e_QUERY == "update")
{
    $pref['donation_pagetitle'] = $_POST['donation_pagetitle'];
    $pref['donation_pagefyears'] = $_POST['donation_pagefyears'];
    $pref['donation_pagefyearc'] = $_POST['donation_pagefyearc'];
    $pref['donation_pagefmonths'] = $_POST['donation_pagefmonths'];
    $pref['donation_pagefmonthc'] = $_POST['donation_pagefmonthc'];
    $pref['latestdmenu_count'] = $_POST['latestdmenu_count'];
    $pref['latestdmenu_height'] = $_POST['latestdmenu_height'];
    $pref['latestdmenu_speed'] = $_POST['latestdmenu_speed'];
    $pref['latestdmenu_mouseoverspeed'] = $_POST['latestdmenu_mouseoverspeed'];
    $pref['latestdmenu_mouseoutspeed'] = $_POST['latestdmenu_mouseoutspeed'];
    $pref['currentdmenu_height'] = $_POST['currentdmenu_height'];
    $pref['currentdmenu_speed'] = $_POST['currentdmenu_speed'];
    $pref['currentdmenu_mouseoverspeed'] = $_POST['currentdmenu_mouseoverspeed'];
    $pref['currentdmenu_mouseoutspeed'] = $_POST['currentdmenu_mouseoutspeed'];
    $pref['currentdmenu_fcolor'] = $_POST['currentdmenu_fcolor'];
    $pref['currentdmenu_fsize'] = $_POST['currentdmenu_fsize'];


if (isset($_POST['donation_enable_gold'])) 
{$pref['donation_enable_gold'] = 1;}
else
{$pref['donation_enable_gold'] = 0;}


if (isset($_POST['latestdmenu_enable_scroll'])) 
{$pref['latestdmenu_enable_scroll'] = 1;}
else
{$pref['latestdmenu_enable_scroll'] = 0;}

if (isset($_POST['latestdmenu_enable_ammount'])) 
{$pref['latestdmenu_enable_ammount'] = 1;}
else
{$pref['latestdmenu_enable_ammount'] = 0;}


if (isset($_POST['currentdmenu_enable_scroll'])) 
{$pref['currentdmenu_enable_scroll'] = 1;}
else
{$pref['currentdmenu_enable_scroll'] = 0;}

if (isset($_POST['currentdmenu_enable_ammount'])) 
{$pref['currentdmenu_enable_ammount'] = 1;}
else
{$pref['currentdmenu_enable_ammount'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Donation Listing (Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>

		<tr>
			<td colspan='3' class='fcaption'><b>Main Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Gold System Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['donation_enable_gold'] == 1 ? "<input type='checkbox' name='donation_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='donation_enable_gold' value='0' />")."(shows orbs, must have gold sytem 4.x and gold orbs 1.x installed)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Donation Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='donation_pagetitle' value='".$tp->toFORM($pref['donation_pagetitle'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Year Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='donation_pagefyears' value='".$tp->toFORM($pref['donation_pagefyears'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Year Font Color:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='donation_pagefyearc' value='".$tp->toFORM($pref['donation_pagefyearc'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Month Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='donation_pagefmonths' value='".$tp->toFORM($pref['donation_pagefmonths'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Month Font Color:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='donation_pagefmonthc' value='".$tp->toFORM($pref['donation_pagefmonthc'])."' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>Latest Donations Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Scrolling:</td>
		        <td colspan=2 class='forumheader3'>".($pref['latestdmenu_enable_scroll'] == 1 ? "<input type='checkbox' name='latestdmenu_enable_scroll' value='1' checked='checked' />" : "<input type='checkbox' name='latestdmenu_enable_scroll' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scrolling Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='latestdmenu_height' value='".$tp->toFORM($pref['latestdmenu_height'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of Donators To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='latestdmenu_count' value='".$tp->toFORM($pref['latestdmenu_count'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Start:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='latestdmenu_speed' value='".$tp->toFORM($pref['latestdmenu_speed'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Mouse-over:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='latestdmenu_mouseoverspeed' value='".$tp->toFORM($pref['latestdmenu_mouseoverspeed'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Mouse-out:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='latestdmenu_mouseoutspeed' value='".$tp->toFORM($pref['latestdmenu_mouseoutspeed'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Amount Donated:</td>
		        <td colspan=2 class='forumheader3'>".($pref['latestdmenu_enable_ammount'] == 1 ? "<input type='checkbox' name='latestdmenu_enable_ammount' value='1' checked='checked' />" : "<input type='checkbox' name='latestdmenu_enable_ammount' value='0' />")."</td>
	        </tr>







		<tr>
			<td colspan='3' class='fcaption'><b>Current Month Donations Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Month Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='currentdmenu_fsize' value='".$tp->toFORM($pref['currentdmenu_fsize'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Month Font Color:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='currentdmenu_fcolor' value='".$tp->toFORM($pref['currentdmenu_fcolor'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Scrolling:</td>
		        <td colspan=2 class='forumheader3'>".($pref['currentdmenu_enable_scroll'] == 1 ? "<input type='checkbox' name='currentdmenu_enable_scroll' value='1' checked='checked' />" : "<input type='checkbox' name='currentdmenu_enable_scroll' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Scrolling Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='currentdmenu_height' value='".$tp->toFORM($pref['currentdmenu_height'])."' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Start:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='currentdmenu_speed' value='".$tp->toFORM($pref['currentdmenu_speed'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Mouse-over:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='currentdmenu_mouseoverspeed' value='".$tp->toFORM($pref['currentdmenu_mouseoverspeed'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Mouse-out:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='currentdmenu_mouseoutspeed' value='".$tp->toFORM($pref['currentdmenu_mouseoutspeed'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Amount Donated:</td>
		        <td colspan=2 class='forumheader3'>".($pref['currentdmenu_enable_ammount'] == 1 ? "<input type='checkbox' name='currentdmenu_enable_ammount' value='1' checked='checked' />" : "<input type='checkbox' name='currentdmenu_enable_ammount' value='0' />")."</td>
	        </tr>








                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
