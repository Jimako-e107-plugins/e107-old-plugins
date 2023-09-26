<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Welcome Menu              #   
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
    $pref['welcomemenu_title'] = $_POST['welcomemenu_title'];
    $pref['welcomemenu_avatarsize'] = $_POST['welcomemenu_avatarsize'];
    $pref['wm_rank_size'] = $_POST['wm_rank_size'];
    $pref['wm_advrank_size'] = $_POST['wm_advrank_size'];


if (isset($_POST['welcomemenu_enable_clock'])) 
{$pref['welcomemenu_enable_clock'] = 1;}
else
{$pref['welcomemenu_enable_clock'] = 0;}

if (isset($_POST['welcomemenu_enable_gold'])) 
{$pref['welcomemenu_enable_gold'] = 1;}
else
{$pref['welcomemenu_enable_gold'] = 0;}

if (isset($_POST['welcome_enable_onlinelist'])) 
{$pref['welcome_enable_onlinelist'] = 1;}
else
{$pref['welcome_enable_onlinelist'] = 0;}

if (isset($_POST['welcomemenu_enable_goldbalance'])) 
{$pref['welcomemenu_enable_goldbalance'] = 1;}
else
{$pref['welcomemenu_enable_goldbalance'] = 0;}

if (isset($_POST['welcomemenu_enable_goldspent'])) 
{$pref['welcomemenu_enable_goldspent'] = 1;}
else
{$pref['welcomemenu_enable_goldspent'] = 0;}

if (isset($_POST['welcomemenu_enable_goldlottery'])) 
{$pref['welcomemenu_enable_goldlottery'] = 1;}
else
{$pref['welcomemenu_enable_goldlottery'] = 0;}

if (isset($_POST['welcomemenu_enable_presents'])) 
{$pref['welcomemenu_enable_presents'] = 1;}
else
{$pref['welcomemenu_enable_presents'] = 0;}

if (isset($_POST['welcomemenu_enable_assets'])) 
{$pref['welcomemenu_enable_assets'] = 1;}
else
{$pref['welcomemenu_enable_assets'] = 0;}

if (isset($_POST['welcomemenu_enable_avatar'])) 
{$pref['welcomemenu_enable_avatar'] = 1;}
else
{$pref['welcomemenu_enable_avatar'] = 0;}

if (isset($_POST['welcomemenu_enable_id'])) 
{$pref['welcomemenu_enable_id'] = 1;}
else
{$pref['welcomemenu_enable_id'] = 0;}

if (isset($_POST['welcomemenu_enable_ip'])) 
{$pref['welcomemenu_enable_ip'] = 1;}
else
{$pref['welcomemenu_enable_ip'] = 0;}

if (isset($_POST['welcomemenu_enable_rating'])) 
{$pref['welcomemenu_enable_rating'] = 1;}
else
{$pref['welcomemenu_enable_rating'] = 0;}

if (isset($_POST['welcomemenu_enable_datejoined'])) 
{$pref['welcomemenu_enable_datejoined'] = 1;}
else
{$pref['welcomemenu_enable_datejoined'] = 0;}

if (isset($_POST['welcomemenu_enable_lastvisit'])) 
{$pref['welcomemenu_enable_lastvisit'] = 1;}
else
{$pref['welcomemenu_enable_lastvisit'] = 0;}

if (isset($_POST['welcomemenu_enable_totalvisits'])) 
{$pref['welcomemenu_enable_totalvisits'] = 1;}
else
{$pref['welcomemenu_enable_totalvisits'] = 0;}

if (isset($_POST['welcomemenu_enable_downloads'])) 
{$pref['welcomemenu_enable_downloads'] = 1;}
else
{$pref['welcomemenu_enable_downloads'] = 0;}

if (isset($_POST['welcomemenu_enable_totalposts'])) 
{$pref['welcomemenu_enable_totalposts'] = 1;}
else
{$pref['welcomemenu_enable_totalposts'] = 0;}

if (isset($_POST['welcomemenu_enable_lastpost'])) 
{$pref['welcomemenu_enable_lastpost'] = 1;}
else
{$pref['welcomemenu_enable_lastpost'] = 0;}

if (isset($_POST['welcomemenu_enable_rpg'])) 
{$pref['welcomemenu_enable_rpg'] = 1;}
else
{$pref['welcomemenu_enable_rpg'] = 0;}

if (isset($_POST['welcomemenu_enable_arcade'])) 
{$pref['welcomemenu_enable_arcade'] = 1;}
else
{$pref['welcomemenu_enable_arcade'] = 0;}

if (isset($_POST['welcomemenu_enable_arcadewins'])) 
{$pref['welcomemenu_enable_arcadewins'] = 1;}
else
{$pref['welcomemenu_enable_arcadewins'] = 0;}

if (isset($_POST['welcomemenu_enable_arcadechalls'])) 
{$pref['welcomemenu_enable_arcadechalls'] = 1;}
else
{$pref['welcomemenu_enable_arcadechalls'] = 0;}

if (isset($_POST['welcomemenu_enable_arcadetours'])) 
{$pref['welcomemenu_enable_arcadetours'] = 1;}
else
{$pref['welcomemenu_enable_arcadetours'] = 0;}

if (isset($_POST['welcomemenu_enable_aacgcrm'])) 
{$pref['welcomemenu_enable_aacgcrm'] = 1;}
else
{$pref['welcomemenu_enable_aacgcrm'] = 0;}

if (isset($_POST['wm_enable_aacgcroster'])) 
{$pref['wm_enable_aacgcroster'] = 1;}
else
{$pref['wm_enable_aacgcroster'] = 0;}

if (isset($_POST['wm_enable_aacgcadvroster'])) 
{$pref['wm_enable_aacgcadvroster'] = 1;}
else
{$pref['wm_enable_aacgcadvroster'] = 0;}

if (isset($_POST['welcomemenu_enable_ribbons'])) 
{$pref['welcomemenu_enable_ribbons'] = 1;}
else
{$pref['welcomemenu_enable_ribbons'] = 0;}

if (isset($_POST['welcomemenu_enable_medals'])) 
{$pref['welcomemenu_enable_medals'] = 1;}
else
{$pref['welcomemenu_enable_medals'] = 0;}

if (isset($_POST['welcomemenu_enable_links'])) 
{$pref['welcomemenu_enable_links'] = 1;}
else
{$pref['welcomemenu_enable_links'] = 0;}

if (isset($_POST['wm_enable_col1'])) 
{$pref['wm_enable_col1'] = 1;}
else
{$pref['wm_enable_col1'] = 0;}

if (isset($_POST['wm_enable_col2'])) 
{$pref['wm_enable_col2'] = 1;}
else
{$pref['wm_enable_col2'] = 0;}

if (isset($_POST['wm_enable_col3'])) 
{$pref['wm_enable_col3'] = 1;}
else
{$pref['wm_enable_col3'] = 0;}

if (isset($_POST['wm_enable_col4'])) 
{$pref['wm_enable_col4'] = 1;}
else
{$pref['wm_enable_col4'] = 0;}

if (isset($_POST['wm_enable_col5'])) 
{$pref['wm_enable_col5'] = 1;}
else
{$pref['wm_enable_col5'] = 0;}

if (isset($_POST['wm_theme'])) 
{$pref['wm_theme'] = 1;}
else
{$pref['wm_theme'] = 0;}

if (isset($_POST['wm_enable_aacgcbattle'])) 
{$pref['wm_enable_aacgcbattle'] = 1;}
else
{$pref['wm_enable_aacgcbattle'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Welcome Menu (settings)";


//-------------------------------------------------------------------------------------------------------------


$text .= "<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	  <table style='" . ADMIN_WIDTH . "' class='fborder'>



		<tr>
			<td colspan='3' class='fcaption'><b>Main Info: (check each you want shown)</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Welcome Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='welcomemenu_title' value='".$tp->toFORM($pref['welcomemenu_title'])."' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Special Theme:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_theme'] == 1 ? "<input type='checkbox' name='wm_theme' value='1' checked='checked' />" : "<input type='checkbox' name='wm_theme' value='0' />")." (uses fcation and indent in table class)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Realtime Clock:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_clock'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_clock' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_clock' value='0' />")." (<a href='".e_PLUGIN."aacgc_welcome_menu/admin_clock_config.php'>clock settings</a>)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Column 1:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_col1'] == 1 ? "<input type='checkbox' name='wm_enable_col1' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_col1' value='0' />")." (Username, Avatar, ID#, IP Address)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Column 2:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_col2'] == 1 ? "<input type='checkbox' name='wm_enable_col2' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_col2' value='0' />")." (Date Joined, Last Visit, Total Visits, Gold Balance, Downloads, Ribbons & Medals)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Column 3:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_col3'] == 1 ? "<input type='checkbox' name='wm_enable_col3' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_col3' value='0' />")." (Total Posts, Last Post, RPG)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Column 4:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_col4'] == 1 ? "<input type='checkbox' name='wm_enable_col4' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_col4' value='0' />")." (Arcade Wins, Arcade Challege Info, Lottery Info, Presents, Assets)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Column 5:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_col5'] == 1 ? "<input type='checkbox' name='wm_enable_col5' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_col5' value='0' />")." (Welcome Message, Username, Animated Army Welcome Soldiers)</td>
	        </tr>


                <tr>
		        <td style='width:30%' class='forumheader3'>Who's Online:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcome_enable_onlinelist'] == 1 ? "<input type='checkbox' name='welcome_enable_onlinelist' value='1' checked='checked' />" : "<input type='checkbox' name='welcome_enable_onlinelist' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Avatar:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_avatar'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_avatar' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_avatar' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Avatar Image Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='15' name='welcomemenu_avatarsize' value='".$tp->toFORM($pref['welcomemenu_avatarsize'])."' />px</td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>ID #:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_id'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_id' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_id' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>IP Address:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_ip'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_ip' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_ip' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Rating:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_rating'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_rating' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_rating' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Date Joined:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_datejoined'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_datejoined' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_datejoined' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Last Visit:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_lastvisit'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_lastvisit' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_lastvisit' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Total Visits</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_totalvisits'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_totalvisits' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_totalvisits' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Downloads:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_downloads'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_downloads' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_downloads' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Links: (settings / profile / logout)</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_links'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_links' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_links' value='0' />")."</td>
	        </tr>







		<tr>
			<td colspan='3' class='fcaption'><b>Forum Info: (check each you want shown)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Total Posts:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_totalposts'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_totalposts' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_totalposts' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Last Post:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_lastpost'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_lastpost' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_lastpost' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>RPG Level:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_rpg'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_rpg' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_rpg' value='0' />")." (Gold Sys 4.x & Gold RPG Plugin Required)</td>
	        </tr>









		<tr>
			<td colspan='3' class='fcaption'><b>Gold System & Plugins Support: (Gold Sys 4.x + Gold Plugins Required - check each you want shown)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Gold Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_gold'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_gold' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_gold' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Balance:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_goldbalance'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_goldbalance' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_goldbalance' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Spent:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_goldspent'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_goldspent' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_goldspent' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Lottery Plays:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_goldlottery'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_goldlottery' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_goldlottery' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Presents:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_presents'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_presents' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_presents' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Assets:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_assets'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_assets' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_assets' value='0' />")."</td>
	        </tr>







		<tr>
			<td colspan='3' class='fcaption'><b>Krooze Arcade Info: (Krooze Arcade Plugin Required - check each you want shown)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Arcade Support:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_arcade'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_arcade' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_arcade' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Wins:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_arcadewins'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_arcadewins' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_arcadewins' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Challenges:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_arcadechalls'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_arcadechalls' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_arcadechalls' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Tournaments:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_arcadetours'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_arcadetours' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_arcadetours' value='0' />")."</td>
	        </tr>









		<tr>
			<td colspan='3' class='fcaption'><b>AACGC Ribbons & Medals Info: (AACGC Ribbons & Medals Plugin Required - check each you want shown)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_aacgcrm'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_aacgcrm' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_aacgcrm' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Ribbons:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_ribbons'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_ribbons' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_ribbons' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Medals:</td>
		        <td colspan=2 class='forumheader3'>".($pref['welcomemenu_enable_medals'] == 1 ? "<input type='checkbox' name='welcomemenu_enable_medals' value='1' checked='checked' />" : "<input type='checkbox' name='welcomemenu_enable_medals' value='0' />")."</td>
	        </tr>



		<tr>
			<td colspan='3' class='fcaption'><b>AACGC Roster: (AACGC Roster Required)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Ranks:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_aacgcroster'] == 1 ? "<input type='checkbox' name='wm_enable_aacgcroster' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_aacgcroster' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Rank Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='wm_rank_size' value='".$tp->toFORM($pref['wm_rank_size'])."' /></td>
		</tr>


		<tr>
			<td colspan='3' class='fcaption'><b>AACGC Advanced Roster: (AACGC Advanced Roster Required)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Adv Ranks:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_aacgcadvroster'] == 1 ? "<input type='checkbox' name='wm_enable_aacgcadvroster' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_aacgcadvroster' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Adv Rank Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='60' name='wm_advrank_size' value='".$tp->toFORM($pref['wm_advrank_size'])."' /></td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'><b>AACGC Battle Stats: (AACGC Battle Addon and extedent fields Required)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Battle Stats Button:</td>
		        <td colspan=2 class='forumheader3'>".($pref['wm_enable_aacgcbattle'] == 1 ? "<input type='checkbox' name='wm_enable_aacgcbattle' value='1' checked='checked' />" : "<input type='checkbox' name='wm_enable_aacgcbattle' value='0' />")."</td>
	        </tr>





";









//-------------------------------------------------------------------------------------------------------------



$text .= "<tr>
	  <td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
	  </tr>
</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
