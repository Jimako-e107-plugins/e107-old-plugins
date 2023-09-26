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
    $pref['gamelist_showcasetitle'] = $_POST['gamelist_showcasetitle'];
    $pref['gamelist_showcaselogo'] = $_POST['gamelist_showcaselogo'];
    $pref['gamelist_showcaselogoheight'] = $_POST['gamelist_showcaselogoheight'];
    $pref['gamelist_showcaselogowidth'] = $_POST['gamelist_showcaselogowidth'];
    $pref['gamelist_showcaselogotype'] = $_POST['gamelist_showcaselogotype'];
    $pref['gamelist_showcaseicon'] = $_POST['gamelist_showcaseicon'];
    $pref['gamelist_showcasemenu_order'] = $_POST['gamelist_showcasemenu_order'];

    $pref['gamelist_showcasemenu_direction'] = $_POST['gamelist_showcasemenu_direction'];
    $pref['gamelist_showcasemenu_speed'] = $_POST['gamelist_showcasemenu_speed'];
    $pref['gamelist_showcasemenu_mouseoverspeed'] = $_POST['gamelist_showcasemenu_mouseoverspeed'];
    $pref['gamelist_showcasemenu_arrow'] = $_POST['gamelist_showcasemenu_arrow'];

    $pref['gamelist_showcase_catexclude'] = $_POST['gamelist_showcase_catexclude'];

    $pref['gamelist_showcase_newest'] = $_POST['gamelist_showcase_newest'];
    $pref['gamelist_showcasenewesticon'] = $_POST['gamelist_showcasenewesticon'];

    $pref['gamelist_showcasemaxgames'] = $_POST['gamelist_showcasemaxgames'];

    $pref['gamelist_showcasecatcol'] = $_POST['gamelist_showcasecatcol'];


if (isset($_POST['gamelist_enable_showcaselogo'])) 
{$pref['gamelist_enable_showcaselogo'] = 1;}
else
{$pref['gamelist_enable_showcaselogo'] = 0;}

if (isset($_POST['gamelist_enable_showcasecontrols'])) 
{$pref['gamelist_enable_showcasecontrols'] = 1;}
else
{$pref['gamelist_enable_showcasecontrols'] = 0;}

if (isset($_POST['gamelist_enable_showcasegametotal'])) 
{$pref['gamelist_enable_showcasegametotal'] = 1;}
else
{$pref['gamelist_enable_showcasegametotal'] = 0;}

if (isset($_POST['gamelist_enable_showcaseclantotal'])) 
{$pref['gamelist_enable_showcaseclantotal'] = 1;}
else
{$pref['gamelist_enable_showcaseclantotal'] = 0;}

if (isset($_POST['gamelist_enable_showcaseservertotal'])) 
{$pref['gamelist_enable_showcaseservertotal'] = 1;}
else
{$pref['gamelist_enable_showcaseservertotal'] = 0;}

if (isset($_POST['gamelist_enable_showcaseproducttotal'])) 
{$pref['gamelist_enable_showcaseproducttotal'] = 1;}
else
{$pref['gamelist_enable_showcaseproducttotal'] = 0;}

if (isset($_POST['gamelist_enable_showcasescroll'])) 
{$pref['gamelist_enable_showcasescroll'] = 1;}
else
{$pref['gamelist_enable_showcasescroll'] = 0;}

if (isset($_POST['gamelist_enable_showcasepopup'])) 
{$pref['gamelist_enable_showcasepopup'] = 1;}
else
{$pref['gamelist_enable_showcasepopup'] = 0;}

if (isset($_POST['gamelist_enable_showcasecatlist'])) 
{$pref['gamelist_enable_showcasecatlist'] = 1;}
else
{$pref['gamelist_enable_showcasecatlist'] = 0;}

if (isset($_POST['gamelist_enable_showcasenewest'])) 
{$pref['gamelist_enable_showcasenewest'] = 1;}
else
{$pref['gamelist_enable_showcasenewest'] = 0;}

if (isset($_POST['gamelist_enable_showcasecaution'])) 
{$pref['gamelist_enable_showcasecaution'] = 1;}
else
{$pref['gamelist_enable_showcasecaution'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Game List (Showcase Settings)";
//--------------------------------------------------------------------
$sql = new db;
$sql->db_Select("aacgc_gamelist_cat", "*", "ORDER BY cat_name ASC", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='gamelist_showcase_catexclude' value='".$option['cat_id']."'>".$option['cat_name']."</option>";}


$sql2 = new db;
$sql2->db_Select("aacgc_gamelist_cat", "*", "WHERE cat_id='".$pref['gamelist_showcase_catexclude']."'", "");
$row2 = $sql2->db_Fetch();

$text .= "
<form method='post' action='" . e_SELF . "?update' id='confadvmedsys'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>


		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Showcase Settings:</b></font></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Showcase Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gamelist_showcasetitle' value='" . $tp->toFORM($pref['gamelist_showcasetitle']) . "' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Custom Showcase Logo:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcaselogo'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcaselogo' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcaselogo' value='0' />")." (shows custom logo at top of showcase)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Showcase Menu Custom Logo Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_showcaselogoheight' value='" . $tp->toFORM($pref['gamelist_showcaselogoheight']) . "' />px</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Showcase Menu Custom Logo Width:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_showcaselogowidth' value='" . $tp->toFORM($pref['gamelist_showcaselogowidth']) . "' />px</td>
		</tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Showcase Menu Custom Logo Type:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_showcaselogotype' size='1' class='tbox' style='width:15%'>
                        <option name='gamelist_showcaselogotype' value='".$pref['gamelist_showcaselogotype']."'>".$pref['gamelist_showcaselogotype']."</option>
                        <option name='gamelist_showcaselogotype' value='Image'>Image</option>
                        <option name='gamelist_showcaselogotype' value='Flash'>Flash</option>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Showcase Menu Custom Logo Path:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='gamelist_showcaselogo' value='" . $tp->toFORM($pref['gamelist_showcaselogo']) . "' /><br>(full logo path including http://)</td>
		</tr>

		<tr>
			<td style='width:30%' class='forumheader3'>Game Icon Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gamelist_showcaseicon' value='" . $tp->toFORM($pref['gamelist_showcaseicon']) . "' /></td>
		</tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Order Games By Name:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_showcasemenu_order' size='1' class='tbox' style='width:15%'>
                        <option name='gamelist_showcasemenu_order' value='".$pref['gamelist_showcasemenu_order']."'>".$pref['gamelist_showcasemenu_order']."</option>
                        <option name='gamelist_showcasemenu_order' value='ASC'>ASC</option>
                        <option name='gamelist_showcasemenu_order' value='DESC'>DESC</option>
                        <option name='gamelist_showcasemenu_order' value='Random'>Random</option>
                        </td>
		</tr>
                <tr>
                        <td style='width:25%' class='forumheader3'>Game Category To Exclude From Showcase:</td>
                        <td style='width:' class='forumheader3'>
		        <select name='gamelist_showcase_catexclude' size='1' class='tbox' style='width:50%'>
                        <option name='gamelist_showcase_catexclude' value='".$pref['gamelist_showcase_catexclude']."'>".$row2['cat_name']."</option>
		        ".$options."
                        </td>
                </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Caution Strips:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcasecaution'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcasecaution' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcasecaution' value='0' />")." (shows images above and below scroller of caution stripes)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Large Pop-Up Game Icon When User Clicks Game Icon:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcasepopup'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcasepopup' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcasepopup' value='0' />")." (shows large game icon on showcase above list, if disabled clicking game icon will go to game detail page)</td>
	        </tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Auto-Scrolling:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcasescroll'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcasescroll' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcasescroll' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Scrolling Start Direction:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_showcasemenu_direction' size='1' class='tbox' style='width:15%'>
                        <option name='gamelist_showcasemenu_direction' value='".$pref['gamelist_showcasemenu_direction']."'>".$pref['gamelist_showcasemenu_direction']."</option>
                        <option name='gamelist_showcasemenu_direction' value='left'>left</option>
                        <option name='gamelist_showcasemenu_direction' value='right'>right</option>
                        </td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Normal Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_showcasemenu_speed' value='" . $tp->toFORM($pref['gamelist_showcasemenu_speed']) . "' />  (1 for slow, 10 for fast)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Scrolling Speed Controls:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcasecontrols'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcasecontrols' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcasecontrols' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Fast Speed:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_showcasemenu_mouseoverspeed' value='" . $tp->toFORM($pref['gamelist_showcasemenu_mouseoverspeed']) . "' />  (1 for slow, 10 for fast, 0 for it to stop)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Max Games To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_showcasemaxgames' value='" . $tp->toFORM($pref['gamelist_showcasemaxgames']) . "' />  (0 for all, the more games shown the longer loading time, if used best to set order names to random)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Game Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcasegametotal'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcasegametotal' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcasegametotal' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Clan Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcaseclantotal'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcaseclantotal' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcaseclantotal' value='0' />")." (AACGC Clan Listing Plugin Required)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Server Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcaseservertotal'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcaseservertotal' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcaseservertotal' value='0' />")." (AACGC Game Server List Plugin Required)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Total Product Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcaseproducttotal'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcaseproducttotal' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcaseproducttotal' value='0' />")." (AACGC Product Listing Plugin Required)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Recently Added Games:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcasenewest'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcasenewest' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcasenewest' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Recently Added Games To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_showcase_newest' value='" . $tp->toFORM($pref['gamelist_showcase_newest']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Recent Game Icon Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='gamelist_showcasenewesticon' value='" . $tp->toFORM($pref['gamelist_showcasenewesticon']) . "' /></td>
		</tr>

                <tr>
		        <td style='width:30%' class='forumheader3'>Show Game Category List:</td>
		        <td colspan=2 class='forumheader3'>".($pref['gamelist_enable_showcasecatlist'] == 1 ? "<input type='checkbox' name='gamelist_enable_showcasecatlist' value='1' checked='checked' />" : "<input type='checkbox' name='gamelist_enable_showcasecatlist' value='0' />")." (Uses Category Menu Settings On Setting Page)</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Categories Per Column:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='gamelist_showcasecatcol' value='" . $tp->toFORM($pref['gamelist_showcasecatcol']) . "' /></td>
		</tr>






		<tr>
			<td colspan='3' class='fcaption'><font size='2'><b>Direction Arrow Settings:</b></font> (Only If Auto-Scrolling Enabled)</td>
		</tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Direction Arrow Style:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='gamelist_showcasemenu_arrow' size='1' class='tbox' style='width:15%'>
                        <option name='gamelist_showcasemenu_arrow' value='".$pref['gamelist_showcasemenu_arrow']."'>".$pref['gamelist_showcasemenu_arrow']."</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 1'>Set 1</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 2'>Set 2</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 3'>Set 3</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 4'>Set 4</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 5'>Set 5</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 6'>Set 6</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 7'>Set 7</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 8'>Set 8</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 9'>Set 9</option>
                        <option name='gamelist_showcasemenu_arrow' value='Set 10'>Set 10</option>
                        </td>
		</tr>

                <tr>
                        <td style='width:' class='forumheader3' colspan=2>
                        <table style='width:100%' class='forumheader3'>
                        <td style='width:' class=''><center>Set 1 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 2 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow2.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow2.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 3 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow3.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow3.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 4 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow4.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow4.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 5 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow5.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow5.png'></img>
                        </center></td>
                        </tr><tr>
                        <td style='width:' class=''><center>Set 6 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow6.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow6.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 7<br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow7.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow7.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 8 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow8.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow8.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 9 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow9.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow9.png'></img>
                        </center></td>
                        <td style='width:' class=''><center>Set 10 <br> 
                        <img src='".e_PLUGIN."aacgc_gamelist/images/leftarrow10.png'></img><img src='".e_PLUGIN."aacgc_gamelist/images/rightarrow10.png'></img>
                        </center></td>
                        </tr></table>
		</tr>



</table><br><br><br>





	        <table style='" . ADMIN_WIDTH . "' class='fborder'>
                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><center><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>

