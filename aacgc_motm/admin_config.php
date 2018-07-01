<?php



/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Of the Month       #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
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
    $pref['motm_menutitle'] = $_POST['motm_menutitle'];
    $pref['motm_trophysize'] = $_POST['motm_trophysize'];
    $pref['motm_monthfsize'] = $_POST['motm_monthfsize'];
    $pref['motm_monthfcolor'] = $_POST['motm_monthfcolor'];
    $pref['motm_yearfsize'] = $_POST['motm_yearfsize'];
    $pref['motm_yearfcolor'] = $_POST['motm_yearfcolor'];
    $pref['motm_customtrophy_path'] = $_POST['motm_customtrophy_path'];
    $pref['motm_avatar_size'] = $_POST['motm_avatar_size'];


if (isset($_POST['motm_enable_gold'])) 
{$pref['motm_enable_gold'] = 1;}
else
{$pref['motm_enable_gold'] = 0;}

if (isset($_POST['motm_enable_hoflink'])) 
{$pref['motm_enable_hoflink'] = 1;}
else
{$pref['motm_enable_hoflink'] = 0;}

if (isset($_POST['motm_enable_customtrophy'])) 
{$pref['motm_enable_customtrophy'] = 1;}
else
{$pref['motm_enable_customtrophy'] = 0;}

if (isset($_POST['motm_enable_avatar'])) 
{$pref['motm_enable_avatar'] = 1;}
else
{$pref['motm_enable_avatar'] = 0;}


    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC MOTM (Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>

		<tr>
			<td colspan='3' class='fcaption'><b>Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Gold System Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['motm_enable_gold'] == 1 ? "<input type='checkbox' name='motm_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='motm_enable_gold' value='0' />")."(shows orbs, must have gold sytem 4.x and gold orbs 1.x installed)</td>
	        </tr>



		<tr>
			<td style='width:30%' class='forumheader3'>Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='motm_menutitle' value='".$tp->toFORM($pref['motm_menutitle'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Use Custom Trophy Image:</td>
		        <td colspan=2 class='forumheader3'>".($pref['motm_enable_customtrophy'] == 1 ? "<input type='checkbox' name='motm_enable_customtrophy' value='1' checked='checked' />" : "<input type='checkbox' name='motm_enable_customtrophy' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Custom Trophy Image Path:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='motm_customtrophy_path' value='".$tp->toFORM($pref['motm_customtrophy_path'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Trophy Image Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='motm_trophysize' value='".$tp->toFORM($pref['motm_trophysize'])."' />(pixels)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Month Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='motm_monthfsize' value='".$tp->toFORM($pref['motm_monthfsize'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Month Font Color:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='20' name='motm_monthfcolor' value='".$tp->toFORM($pref['motm_monthfcolor'])."' />(<a href='http://www.computerhope.com/htmcolor.htm' target='_blank'>Click Here for list of HTML Color Codes</a>)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Year Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='motm_yearfsize' value='".$tp->toFORM($pref['motm_yearfsize'])."' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Year Font Color:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='20' name='motm_yearfcolor' value='".$tp->toFORM($pref['motm_yearfcolor'])."' />(<a href='http://www.computerhope.com/htmcolor.htm' target='_blank'>Click Here for list of HTML Color Codes</a>)</td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Previous Months Link at bottom of menu:</td>
		        <td colspan=2 class='forumheader3'>".($pref['motm_enable_hoflink'] == 1 ? "<input type='checkbox' name='motm_enable_hoflink' value='1' checked='checked' />" : "<input type='checkbox' name='motm_enable_hoflink' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show User's Avatar:</td>
		        <td colspan=2 class='forumheader3'>".($pref['motm_enable_avatar'] == 1 ? "<input type='checkbox' name='motm_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='motm_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>User Avatar Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='motm_avatar_size' value='" . $tp->toFORM($pref['motm_avatar_size'])."' />px  (If enabled above)</td>
		</tr>








                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

