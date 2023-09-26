<?php


/*
##########################
# AACGC Addons           #
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
    $pref['menu_topftitle'] = $_POST['menu_topftitle'];
    $pref['menu_topfcount'] = $_POST['menu_topfcount'];
    $pref['menu_topvtitle'] = $_POST['menu_topvtitle'];
    $pref['menu_topvcount'] = $_POST['menu_topvcount'];
    $pref['onlineaddon_title'] = $_POST['onlineaddon_title'];
    $pref['onlineaddon_lastseencount'] = $_POST['onlineaddon_lastseencount'];
    $pref['lfpmenu_count'] = $_POST['lfpmenu_count'];
    $pref['lfpmenu_height'] = $_POST['lfpmenu_height'];
    $pref['lfpmenu_speedstart'] = $_POST['lfpmenu_speedstart'];
    $pref['lfpmenu_speedon'] = $_POST['lfpmenu_speedon'];
    $pref['lfpmenu_speedoff'] = $_POST['lfpmenu_speedoff'];
    $pref['addon_avatar_size'] = $_POST['addon_avatar_size'];
    $pref['addon_dlcount'] = $_POST['addon_dlcount'];
    $pref['onlineaddon_newmembercount'] = $_POST['onlineaddon_newmembercount'];
    $pref['onlineaddon_newmembercolcount'] = $_POST['onlineaddon_newmembercolcount'];
    $pref['forumaddon_fdatecolor'] = $_POST['forumaddon_fdatecolor'];
    $pref['forumaddon_fthreadcolor'] = $_POST['forumaddon_fthreadcolor'];
    $pref['forumaddon_fpostcolor'] = $_POST['forumaddon_fpostcolor'];
    $pref['onlineaddon_globesize'] = $_POST['onlineaddon_globesize'];
    $pref['onlineaddon_globecode'] = $_POST['onlineaddon_globecode'];
    $pref['userfacebook_size'] = $_POST['userfacebook_size'];

if (isset($_POST['forumaddon_enable_gold'])) 
{$pref['forumaddon_enable_gold'] = 1;}
else
{$pref['forumaddon_enable_gold'] = 0;}


if (isset($_POST['addon_enable_xfireim'])) 
{$pref['addon_enable_xfireim'] = 1;}
else
{$pref['addon_enable_xfireim'] = 0;}

if (isset($_POST['addon_enable_facebookim'])) 
{$pref['addon_enable_facebookim'] = 1;}
else
{$pref['addon_enable_facebookim'] = 0;}

if (isset($_POST['addon_enable_yahooim'])) 
{$pref['addon_enable_yahooim'] = 1;}
else
{$pref['addon_enable_yahooim'] = 0;}

if (isset($_POST['addon_enable_msnim'])) 
{$pref['addon_enable_msnim'] = 1;}
else
{$pref['addon_enable_msnim'] = 0;}

if (isset($_POST['addon_enable_aimim'])) 
{$pref['addon_enable_aimim'] = 1;}
else
{$pref['addon_enable_aimim'] = 0;}

if (isset($_POST['onlineaddon_enable_avatar'])) 
{$pref['onlineaddon_enable_avatar'] = 1;}
else
{$pref['onlineaddon_enable_avatar'] = 0;}

if (isset($_POST['onlineaddon_enable_location'])) 
{$pref['onlineaddon_enable_location'] = 1;}
else
{$pref['onlineaddon_enable_location'] = 0;}

if (isset($_POST['onlineaddon_enable_wide'])) 
{$pref['onlineaddon_enable_wide'] = 1;}
else
{$pref['onlineaddon_enable_wide'] = 0;}

if (isset($_POST['onlineaddon_enable_lastseen'])) 
{$pref['onlineaddon_enable_lastseen'] = 1;}
else
{$pref['onlineaddon_enable_lastseen'] = 0;}

if (isset($_POST['onlineaddon_enable_newest'])) 
{$pref['onlineaddon_enable_newest'] = 1;}
else
{$pref['onlineaddon_enable_newest'] = 0;}

if (isset($_POST['onlineaddon_totalmembers'])) 
{$pref['onlineaddon_totalmembers'] = 1;}
else
{$pref['onlineaddon_totalmembers'] = 0;}

if (isset($_POST['onlineaddon_enable_globe'])) 
{$pref['onlineaddon_enable_globe'] = 1;}
else
{$pref['onlineaddon_enable_globe'] = 0;}

if (isset($_POST['onlineaddon_memberstoday'])) 
{$pref['onlineaddon_memberstoday'] = 1;}
else
{$pref['onlineaddon_memberstoday'] = 0;}

if (isset($_POST['onlineaddon_memberlist'])) 
{$pref['onlineaddon_memberlist'] = 1;}
else
{$pref['onlineaddon_memberlist'] = 0;}

if (isset($_POST['onlineaddon_enable_guests'])) 
{$pref['onlineaddon_enable_guests'] = 1;}
else
{$pref['onlineaddon_enable_guests'] = 0;}

if (isset($_POST['onlineaddon_enable_webbot'])) 
{$pref['onlineaddon_enable_webbot'] = 1;}
else
{$pref['onlineaddon_enable_webbot'] = 0;}

if (isset($_POST['addon_enable_pmicon'])) 
{$pref['addon_enable_pmicon'] = 1;}
else
{$pref['addon_enable_pmicon'] = 0;}

if (isset($_POST['addon_enable_friendicon'])) 
{$pref['addon_enable_friendicon'] = 1;}
else
{$pref['addon_enable_friendicon'] = 0;}

if (isset($_POST['addon_enable_avatar'])) 
{$pref['addon_enable_avatar'] = 1;}
else
{$pref['addon_enable_avatar'] = 0;}


    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Addons (Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>

		<tr>
			<td colspan='3' class='fcaption'><b>Main Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Gold System Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['forumaddon_enable_gold'] == 1 ? "<input type='checkbox' name='forumaddon_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='forumaddon_enable_gold' value='0' />")."(shows orbs, must have gold sytem 4.x and gold orbs 1.x installed)</td>
	        </tr>






		<tr>
			<td colspan='3' class='fcaption'><b>Top Forums Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Top Forum Poster Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='menu_topftitle' value='".$tp->toFORM($pref['menu_topftitle'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of Users To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='menu_topfcount' value='".$tp->toFORM($pref['menu_topfcount'])."' /></td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'><b>Top Visits Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Top Visiter Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='menu_topvtitle' value='".$tp->toFORM($pref['menu_topvtitle'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of Users To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='menu_topvcount' value='".$tp->toFORM($pref['menu_topvcount'])."' /></td>
		</tr>



		<tr>
			<td colspan='3' class='fcaption'><b>Top Downloaders Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number of Downloads to Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='addon_dlcount' value='".$tp->toFORM($pref['addon_dlcount'])."' /></td>
		</tr>








		<tr>
			<td colspan='3' class='fcaption'><b>Latest Forum Post Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of Recent Posts:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='5' name='lfpmenu_count' value='".$tp->toFORM($pref['lfpmenu_count'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='lfpmenu_height' value='".$tp->toFORM($pref['lfpmenu_height'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed Start:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='5' name='lfpmenu_speedstart' value='".$tp->toFORM($pref['lfpmenu_speedstart'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Mouse-Over:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='5' name='lfpmenu_speedon' value='".$tp->toFORM($pref['lfpmenu_speedon'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Menu Scroll Speed On Mouse-Out:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='5' name='lfpmenu_speedoff' value='".$tp->toFORM($pref['lfpmenu_speedoff'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Avatars:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_avatar'] == 1 ? "<input type='checkbox' name='addon_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='addon_avatar_size' value='".$tp->toFORM($pref['addon_avatar_size'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Date Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='forumaddon_fdatecolor' value='".$tp->toFORM($pref['forumaddon_fdatecolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Thread Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='forumaddon_fthreadcolor' value='".$tp->toFORM($pref['forumaddon_fthreadcolor'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Post Font Color:</td>
			<td colspan='2'  class='forumheader3'>#<input class='tbox' type='text' size='10' name='forumaddon_fpostcolor' value='".$tp->toFORM($pref['forumaddon_fpostcolor'])."' /></td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'><b>Online Menu Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Online Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='onlineaddon_title' value='".$tp->toFORM($pref['onlineaddon_title'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Horizontal Menu:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_wide'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_wide' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_wide' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Avatars:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_avatar'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_avatar' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Online Location:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_location'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_location' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_location' value='0' />")."</td>
	        </tr>
               <tr>
		        <td style='width:30%' class='forumheader3'>Show Guests:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_guests'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_guests' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_guests' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Last Seen:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_lastseen'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_lastseen' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_lastseen' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number of Last Seen Members:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='onlineaddon_lastseencount' value='".$tp->toFORM($pref['onlineaddon_lastseencount'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Members Today Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_memberstoday'] == 1 ? "<input type='checkbox' name='onlineaddon_memberstoday' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_memberstoday' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show list of Members on Today:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_memberlist'] == 1 ? "<input type='checkbox' name='onlineaddon_memberlist' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_memberlist' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show 3D Globe of Recent Visitors:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_globe'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_globe' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_globe' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Globe Code (use any #s or letters, or name of site):</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='25' name='onlineaddon_globecode' value='".$tp->toFORM($pref['onlineaddon_globecode'])."' /> (if AACGC 3D Globe Menu Plugin installed use same code)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>3D Globe Size:</td>
                        <td style='width:' class=''>
                        <select name='onlineaddon_globesize' size='1' class='tbox' style='width:50%'>
                        <option name='onlineaddon_globesize' value='100'>100x100 no detail</option>
                        <option name='onlineaddon_globesize' value='150'>150x150 no detail</option>
                        <option name='onlineaddon_globesize' value='200'>200x200 no detail</option>
                        <option name='onlineaddon_globesize' value='250'>250x250 no detail</option>
                        <option name='onlineaddon_globesize' value='300'>300x300 no detail</option>
                        <option name='onlineaddon_globesize' value='180s'>180x180 with detail</option>
                        <option name='onlineaddon_globesize' value='200s'>200x200 with detail</option>
                        </td>
                </tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Newest Members:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_newest'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_newest' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_newest' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of New Users To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='onlineaddon_newmembercount' value='".$tp->toFORM($pref['onlineaddon_newmembercount'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Number Of New Users Per Row:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='onlineaddon_newmembercolcount' value='".$tp->toFORM($pref['onlineaddon_newmembercolcount'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Registered Member Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_totalmembers'] == 1 ? "<input type='checkbox' name='onlineaddon_totalmembers' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_totalmembers' value='0' />")."</td>
	        </tr>




		<tr>
			<td colspan='3' class='fcaption'><b>Online Menu Icons:</b></td>
		</tr>
               <tr>
		        <td style='width:30%' class='forumheader3'>Show PM Icon:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_pmicon'] == 1 ? "<input type='checkbox' name='addon_enable_pmicon' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_pmicon' value='0' />")."</td>
	        </tr>
               <tr>
		        <td style='width:30%' class='forumheader3'>Show Add Friend Icon:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_friendicon'] == 1 ? "<input type='checkbox' name='addon_enable_friendicon' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_friendicon' value='0' />")."</td>
	        </tr>
               <tr>
		        <td style='width:30%' class='forumheader3'>Show Web-Bot Icons:</td>
		        <td colspan=2 class='forumheader3'>".($pref['onlineaddon_enable_webbot'] == 1 ? "<input type='checkbox' name='onlineaddon_enable_webbot' value='1' checked='checked' />" : "<input type='checkbox' name='onlineaddon_enable_webbot' value='0' />")." (BETA - Leave unchecked if errors appear)</td>
	        </tr>


		<tr>
			<td colspan='3' class='fcaption'><b>Instant Messenger Settings:</b><br>(Shows IM Status In Default Profiles & Forums)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Xfire Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_xfireim'] == 1 ? "<input type='checkbox' name='addon_enable_xfireim' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_xfireim' value='0' />")." (Must add Extended User field named user_xfire)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Facebook Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_facebookim'] == 1 ? "<input type='checkbox' name='addon_enable_facebookim' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_facebookim' value='0' />")." (Must add Extended User fields named user_facebook & user_facebook_badge)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Facebook Badge Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='25' name='userfacebook_size' value='".$tp->toFORM($pref['userfacebook_size'])."' />px</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Yahoo Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_yahooim'] == 1 ? "<input type='checkbox' name='addon_enable_yahooim' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_yahooim' value='0' />")." (Must add Extended User field named user_yahoo)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable MSN Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_msnim'] == 1 ? "<input type='checkbox' name='addon_enable_msnim' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_msnim' value='0' />")." (Must add Extended User field named user_msn)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable AIM Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['addon_enable_aimim'] == 1 ? "<input type='checkbox' name='addon_enable_aimim' value='1' checked='checked' />" : "<input type='checkbox' name='addon_enable_aimim' value='0' />")." (Must add Extended User field named user_aim)</td>
	        </tr>







                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
