<?php


/*
##########################
# AACGC Game List        #
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



if (isset($_POST['gamelist_enable_clanlist'])) 
{$pref['gamelist_enable_clanlist'] = 1;}
else
{$pref['gamelist_enable_clanlist'] = 0;}

if (isset($_POST['gamelist_enable_clantotal'])) 
{$pref['gamelist_enable_clantotal'] = 1;}
else
{$pref['gamelist_enable_clantotal'] = 0;}

if (isset($_POST['gamelist_enable_clantotallist'])) 
{$pref['gamelist_enable_clantotallist'] = 1;}
else
{$pref['gamelist_enable_clantotallist'] = 0;}

if (isset($_POST['gamelist_enable_clanlistdet'])) 
{$pref['gamelist_enable_clanlistdet'] = 1;}
else
{$pref['gamelist_enable_clanlistdet'] = 0;}

if (isset($_POST['gamelist_enable_clantotalmenu'])) 
{$pref['gamelist_enable_clantotalmenu'] = 1;}
else
{$pref['gamelist_enable_clantotalmenu'] = 0;}

if (isset($_POST['gamelist_enable_clangtotalmenu'])) 
{$pref['gamelist_enable_clangtotalmenu'] = 1;}
else
{$pref['gamelist_enable_clangtotalmenu'] = 0;}

if (isset($_POST['gamelist_enable_playergt'])) 
{$pref['gamelist_enable_playergt'] = 1;}
else
{$pref['gamelist_enable_playergt'] = 0;}

if (isset($_POST['gamelist_enable_xfire'])) 
{$pref['gamelist_enable_xfire'] = 1;}
else
{$pref['gamelist_enable_xfire'] = 0;}

if (isset($_POST['gamelist_enable_playergts'])) 
{$pref['gamelist_enable_playergts'] = 1;}
else
{$pref['gamelist_enable_playergts'] = 0;}

if (isset($_POST['gamelist_enable_xfires'])) 
{$pref['gamelist_enable_xfires'] = 1;}
else
{$pref['gamelist_enable_xfires'] = 0;}

if (isset($_POST['gamelist_enable_playergtlist'])) 
{$pref['gamelist_enable_playergtlist'] = 1;}
else
{$pref['gamelist_enable_playergtlist'] = 0;}

if (isset($_POST['gamelist_enable_xfirelist'])) 
{$pref['gamelist_enable_xfirelist'] = 1;}
else
{$pref['gamelist_enable_xfirelist'] = 0;}

if (isset($_POST['gamelist_enable_playergsc'])) 
{$pref['gamelist_enable_playergsc'] = 1;}
else
{$pref['gamelist_enable_playergsc'] = 0;}

if (isset($_POST['gamelist_enable_playergsclist'])) 
{$pref['gamelist_enable_playergsclist'] = 1;}
else
{$pref['gamelist_enable_playergsclist'] = 0;}

if (isset($_POST['gamelist_enable_playergscdet'])) 
{$pref['gamelist_enable_playergscdet'] = 1;}
else
{$pref['gamelist_enable_playergscdet'] = 0;}

if (isset($_POST['gamelist_enable_gameservers'])) 
{$pref['gamelist_enable_gameservers'] = 1;}
else
{$pref['gamelist_enable_gameservers'] = 0;}

if (isset($_POST['gamelist_enable_servertotal'])) 
{$pref['gamelist_enable_servertotal'] = 1;}
else
{$pref['gamelist_enable_servertotal'] = 0;}

if (isset($_POST['gamelist_enable_servertotallist'])) 
{$pref['gamelist_enable_servertotallist'] = 1;}
else
{$pref['gamelist_enable_servertotallist'] = 0;}

if (isset($_POST['gamelist_enable_serverlistdet'])) 
{$pref['gamelist_enable_serverlistdet'] = 1;}
else
{$pref['gamelist_enable_serverlistdet'] = 0;}

if (isset($_POST['gamelist_enable_servertotalmenu'])) 
{$pref['gamelist_enable_servertotalmenu'] = 1;}
else
{$pref['gamelist_enable_servertotalmenu'] = 0;}

if (isset($_POST['gamelist_enable_servertotalcatmenu'])) 
{$pref['gamelist_enable_servertotalcatmenu'] = 1;}
else
{$pref['gamelist_enable_servertotalcatmenu'] = 0;}

if (isset($_POST['gamelist_enable_servergtotalmenu'])) 
{$pref['gamelist_enable_servergtotalmenu'] = 1;}
else
{$pref['gamelist_enable_servergtotalmenu'] = 0;}

if (isset($_POST['gamelist_enable_product'])) 
{$pref['gamelist_enable_product'] = 1;}
else
{$pref['gamelist_enable_product'] = 0;}

if (isset($_POST['gamelist_enable_producttotal'])) 
{$pref['gamelist_enable_producttotal'] = 1;}
else
{$pref['gamelist_enable_producttotal'] = 0;}

if (isset($_POST['gamelist_enable_producttotalmenu'])) 
{$pref['gamelist_enable_producttotalmenu'] = 1;}
else
{$pref['gamelist_enable_producttotalmenu'] = 0;}

if (isset($_POST['gamelist_enable_producttotalcatmenu'])) 
{$pref['gamelist_enable_producttotalcatmenu'] = 1;}
else
{$pref['gamelist_enable_producttotalcatmenu'] = 0;}

if (isset($_POST['gamelist_enable_clangtotalcatmenu'])) 
{$pref['gamelist_enable_clangtotalcatmenu'] = 1;}
else
{$pref['gamelist_enable_clangtotalcatmenu'] = 0;}

if (isset($_POST['gamelist_enable_cmms'])) 
{$pref['gamelist_enable_cmms'] = 1;}
else
{$pref['gamelist_enable_cmms'] = 0;}

if (isset($_POST['gamelist_enable_cmmsgamepage'])) 
{$pref['gamelist_enable_cmmsgamepage'] = 1;}
else
{$pref['gamelist_enable_cmmsgamepage'] = 0;}

if (isset($_POST['gamelist_enable_cmmscount'])) 
{$pref['gamelist_enable_cmmscount'] = 1;}
else
{$pref['gamelist_enable_cmmscount'] = 0;}


    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "Other AACGC Plugin Support (Settings)";
//--------------------------------------------------------------------


$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>";



//--------------------# CMMS Section #--------------------------

$text .= "
        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>CMMS Plugin:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable CMMS Linking:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_cmms'] == 1 ? "<input type='checkbox' name='gamelist_enable_cmms' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_cmms' value='0' />")."(Must have AACGC CMMS Installed)</td>
	        </tr>";



if ($pref['gamelist_enable_cmms'] == "1"){
$text .= "


                <tr>
		        <td style='width:30%' class='forumheader3'>Show CMMS Clan Total Under Game Icons:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_cmmscount'] == 1 ? "<input type='checkbox' name='gamelist_enable_cmmscount' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_cmmscount' value='0' />")." (effects all menus and pages)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Clan dropdown list under game icon on game detail pages:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_cmmsgamepage'] == 1 ? "<input type='checkbox' name='gamelist_enable_cmmsgamepage' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_cmmsgamepage' value='0' />")." (shows clan name, member count, wins, losses, pending, and total counts)</td>
	        </tr>
 
";}

$text .= "</table>";

//------------------# Clan List Section #--------------------


$text .= "
	<br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>
        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Clan Listing Plugin:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Clan List Linking:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_clanlist'] == 1 ? "<input type='checkbox' name='gamelist_enable_clanlist' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_clanlist' value='0' />")."(Must have AACGC Clan Listing Installed)</td>
	        </tr>";



if ($pref['gamelist_enable_clanlist'] == "1"){
$text .= "

        	<tr>
			<td colspan='3' class='fcaption'><b>Category List Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Clan Total Under Game Total:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_clantotal'] == 1 ? "<input type='checkbox' name='gamelist_enable_clantotal' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_clantotal' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game List Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Clan Total Under Game Icon:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_clantotallist'] == 1 ? "<input type='checkbox' name='gamelist_enable_clantotallist' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_clantotallist' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game Detail Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Clan List:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_clanlistdet'] == 1 ? "<input type='checkbox' name='gamelist_enable_clanlistdet' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_clanlistdet' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game List Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Clan Total Under Game Total:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_clantotalmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_clantotalmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_clantotalmenu' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Clan Total Under Game Icon:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_clangtotalmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_clangtotalmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_clangtotalmenu' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game Category List Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Total Under Game Total:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_clantotalcatmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_clantotalcatmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_clantotalcatmenu' value='0' />")."</td>
	        </tr>

";}




$text .= "</table>";


//-------------------------------------------------------# Game Servers Section #------------------------------------------------------


$text .= "
	<br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>

        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Game Server Listing Plugin:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Clan List Linking:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_gameservers'] == 1 ? "<input type='checkbox' name='gamelist_enable_gameservers' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_gameservers' value='0' />")."(Must have AACGC Game Server List Installed)</td>
	        </tr>";


if ($pref['gamelist_enable_gameservers'] == "1"){
$text .= "

        	<tr>
			<td colspan='3' class='fcaption'><b>Category List Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Total Under Game Total:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_servertotal'] == 1 ? "<input type='checkbox' name='gamelist_enable_servertotal' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_servertotal' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game List Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Total Under Game Icon:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_servertotallist'] == 1 ? "<input type='checkbox' name='gamelist_enable_servertotallist' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_servertotallist' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game Detail Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Banner List:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_serverlistdet'] == 1 ? "<input type='checkbox' name='gamelist_enable_serverlistdet' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_serverlistdet' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game List Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Total Under Game Total:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_servertotalmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_servertotalmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_servertotalmenu' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Total Under Game Icon:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_servergtotalmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_servergtotalmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_servergtotalmenu' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game Category List Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Total Under Game Total:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_servertotalcatmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_servertotalcatmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_servertotalcatmenu' value='0' />")."</td>
	        </tr>


";}


$text .= "</table>";



//-------------------------------------------------------# Product Section #------------------------------------------------------


$text .= "
	<br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>

        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Product Listing Plugin:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable PL Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_product'] == 1 ? "<input type='checkbox' name='gamelist_enable_product' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_product' value='0' />")."(Must have AACGC Product Listing Installed)</td>
	        </tr>";


if ($pref['gamelist_enable_product'] == "1"){
$text .= "

        	<tr>
			<td colspan='3' class='fcaption'><b>Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Purchasable Games on Game List Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_producttotal'] == 1 ? "<input type='checkbox' name='gamelist_enable_producttotal' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_producttotal' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game List Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Purchasable Games on Game List Menu:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_producttotalmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_producttotalmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_producttotalmenu' value='0' />")."</td>
	        </tr>
        	<tr>
			<td colspan='3' class='fcaption'><b>Game Category List Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Total Under Game Total:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_producttotalcatmenu'] == 1 ? "<input type='checkbox' name='gamelist_enable_producttotalcatmenu' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_producttotalcatmenu' value='0' />")."</td>
	        </tr>
";}

$text .= "</table>";

//-----------------------------------------------------------------------------------------------------------



//-------------------------------------------------------# Player GT Section #------------------------------------------------------


$text .= "
	<br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>

        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Player GT Plugin:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Player GT Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_playergts'] == 1 ? "<input type='checkbox' name='gamelist_enable_playergts' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_playergts' value='0' />")."(Must have AACGC Player GT Installed)</td>
	        </tr>";


if ($pref['gamelist_enable_playergts'] == "1"){
$text .= "

        	<tr>
			<td colspan='3' class='fcaption'><b>Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Player GT on Gamer List on Game Details Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_playergt'] == 1 ? "<input type='checkbox' name='gamelist_enable_playergt' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_playergt' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Player GT on Gamer List Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_playergtlist'] == 1 ? "<input type='checkbox' name='gamelist_enable_playergtlist' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_playergtlist' value='0' />")."</td>
	        </tr>
";}


$text .= "</table>";
//-------------------------------------------------------# Player Xfire Section #------------------------------------------------------


$text .= "
	<br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>

        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Xfire Stats Plugin:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Xfire Stats Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_xfires'] == 1 ? "<input type='checkbox' name='gamelist_enable_xfires' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_xfires' value='0' />")."(Must have AACGC Xfire Status Installed)</td>
	        </tr>";


if ($pref['gamelist_enable_xfires'] == "1"){
$text .= "

        	<tr>
			<td colspan='3' class='fcaption'><b>Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Player Xfire on Gamer List on Game Details Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_xfire'] == 1 ? "<input type='checkbox' name='gamelist_enable_xfire' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_xfire' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Player Xfire on Gamer List Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_xfirelist'] == 1 ? "<input type='checkbox' name='gamelist_enable_xfirelist' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_xfirelist' value='0' />")."</td>
	        </tr>

";}

$text .= "</table>";

//-------------------------------------------------------# Player GSC Section #------------------------------------------------------


$text .= "
	<br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>

        	<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>GSC Plugin:</b></font></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable GSC Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_playergsc'] == 1 ? "<input type='checkbox' name='gamelist_enable_playergsc' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_playergsc' value='0' />")."(Must have AACGC GSC List Installed)</td>
	        </tr>";


if ($pref['gamelist_enable_playergsc'] == "1"){
$text .= "

        	<tr>
			<td colspan='3' class='fcaption'><b>Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Player GSC on Gamer List on Game Details Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_playergscdet'] == 1 ? "<input type='checkbox' name='gamelist_enable_playergscdet' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_playergscdet' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Player GSC on Gamer List Page:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_playergsclist'] == 1 ? "<input type='checkbox' name='gamelist_enable_playergsclist' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_playergsclist' value='0' />")."</td>
	        </tr>

";}

$text .= "</table>";




$text .= "

                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><center><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

