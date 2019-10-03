<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/


require_once("../../class2.php");
include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");

if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

if (e_QUERY == "update")
{

    $pref['clanlist_menutitle'] = $tp->toDB($_POST['clanlist_menutitle']);
    $pref['clanlist_menuheight'] = $_POST['clanlist_menuheight'];
    $pref['clanlist_menuspeeds'] = $_POST['clanlist_menuspeeds'];
    $pref['clanlist_menuspeedon'] = $_POST['clanlist_menuspeedon'];
    $pref['clanlist_menuspeedout'] = $_POST['clanlist_menuspeedout'];
    $pref['clanlist_menugamefsize'] = $_POST['clanlist_menugamefsize'];
    $pref['clanlist_menuclanfsize'] = $_POST['clanlist_menuclanfsize'];
    $pref['clanlist_menuiconsize'] = $_POST['clanlist_menuiconsize'];

    $pref['clanlist_catpagetitle'] = $tp->toDB($_POST['clanlist_catpagetitle']);
    $pref['clanlist_catpagefsize'] = $_POST['clanlist_catpagefsize'];
    $pref['clanlist_catpageiconsize'] = $_POST['clanlist_catpageiconsize'];

    $pref['clanlist_listpagecatfsize'] = $_POST['clanlist_listpagecatfsize'];
    $pref['clanlist_listpageclanfsize'] = $_POST['clanlist_listpageclanfsize'];

    $pref['clanlist_detpageclanfsize'] = $_POST['clanlist_detpageclanfsize'];

    $pref['clanlist_pmuser'] = $_POST['clanlist_pmuser'];

   $pref['clanlist_header'] = $tp->toDB($_POST['clanlist_header']);
   $pref['clanlist_intro'] = $tp->toDB($_POST['clanlist_intro']);


if (isset($_POST['clanlist_enable_clantotal'])) 
{$pref['clanlist_enable_clantotal'] = 1;}
else
{$pref['clanlist_enable_clantotal'] = 0;}


if (isset($_POST['clanlist_enable_clansubmit'])) 
{$pref['clanlist_enable_clansubmit'] = 1;}
else
{$pref['clanlist_enable_clansubmit'] = 0;}


if (isset($_POST['clanlist_enable_showclans'])) 
{$pref['clanlist_enable_showclans'] = 1;}
else
{$pref['clanlist_enable_showclans'] = 0;}


if (isset($_POST['clanlist_enable_scroll'])) 
{$pref['clanlist_enable_scroll'] = 1;}
else
{$pref['clanlist_enable_scroll'] = 0;}


if (isset($_POST['clanlist_enable_clansubmitedit'])) 
{$pref['clanlist_enable_clansubmitedit'] = 1;}
else
{$pref['clanlist_enable_clansubmitedit'] = 0;}


    save_prefs();
    $text .= "<center><b>Settings Saved</b></center>";
}

$admin_title = "AACGC Clan Listing (Settings)";
//--------------------------------------------------------------------

$sql = new db;
$sql->db_Select("user", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='clanlist_pmuser' value='".$option['user_id']."'>".$option['user_name']."</option>";}

$sql2 = new db;
$sql2->db_Select("user", "*", "WHERE user_id=".$pref['clanlist_pmuser']."", "");
$row2 = $sql2->db_Fetch();

$text .= "
<form method='post' action='" . e_SELF . "?update' id='confclanlist'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>



		<tr>
			<td colspan='3' class='fcaption'><b>".ACLANLIST_CONF_01.":</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_02.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['clanlist_enable_clansubmit'] == 1 ? "<input type='checkbox' name='clanlist_enable_clansubmit' value='1' checked='checked' />" : "<input type='checkbox' name='clanlist_enable_clansubmit' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_03.":</td>
		        <td colspan=2 class='forumheader3'>
			<select name='clanlist_pmuser' size='1' class='tbox' style='width:100%'>
			<option name='clanlist_pmuser' value='".$pref['clanlist_pmuser']."'>".$row2['user_name']."</option>
			".$options."
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_04.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['clanlist_enable_clansubmitedit'] == 1 ? "<input type='checkbox' name='clanlist_enable_clansubmitedit' value='1' checked='checked' />" : "<input type='checkbox' name='clanlist_enable_clansubmitedit' value='0' />")."</td>
	        </tr>


		<tr>
			<td colspan='3' class='fcaption'><b>".ACLANLIST_CONF_05.":</b></td>
		</tr>
        	<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_06.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='clanlist_catpagetitle' value='" . $tp->toFORM($pref['clanlist_catpagetitle']) . "' /></td>
		</tr>
        	<tr>
        		<td style='width:' class='forumheader3'>".ACL_01.":</td>
        		<td style='width:' class='forumheader3' colspan=2>
	    		<textarea class='tbox' rows='5' cols='100' name='clanlist_header' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['clanlist_header']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "      </td> 
		</tr>
        	<tr>
        		<td style='width:' class='forumheader3'>".ACL_02.":</td>
        		<td style='width:' class='forumheader3' colspan=2>
	    		<textarea class='tbox' rows='15' cols='100' name='clanlist_intro' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['clanlist_intro']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "      </td> 
		</tr>
        	<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_07.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_catpagefsize' value='" . $tp->toFORM($pref['clanlist_catpagefsize']) . "' /></td>
		</tr>
        	<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_08.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_catpageiconsize' value='" . $tp->toFORM($pref['clanlist_catpageiconsize']) . "' />px</td>
		</tr>




		<tr>
			<td colspan='3' class='fcaption'><b>".ACLANLIST_CONF_09.":</b></td>
		</tr>
        	<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_10.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_listpagecatfsize' value='" . $tp->toFORM($pref['clanlist_listpagecatfsize']) . "' /></td>
		</tr>
        	<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_11.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_listpageclanfsize' value='" . $tp->toFORM($pref['clanlist_listpageclanfsize']) . "' /></td>
		</tr>



		<tr>
			<td colspan='3' class='fcaption'><b>".ACLANLIST_CONF_12.":</b></td>
		</tr>
        	<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_13.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_detpageclanfsize' value='" . $tp->toFORM($pref['clanlist_detpageclanfsize']) . "' /></td>
		</tr>





		<tr>
			<td colspan='3' class='fcaption'><b>".ACLANLIST_CONF_14.":</b></td>
		</tr>
        	<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_15.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='25' name='clanlist_menutitle' value='" . $tp->toFORM($pref['clanlist_menutitle']) . "' /></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_16.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['clanlist_enable_clantotal'] == 1 ? "<input type='checkbox' name='clanlist_enable_clantotal' value='1' checked='checked' />" : "<input type='checkbox' name='clanlist_enable_clantotal' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_17.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_menuheight' value='" . $tp->toFORM($pref['clanlist_menuheight']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_18.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_menugamefsize' value='" . $tp->toFORM($pref['clanlist_menugamefsize']) . "' />px  (pixles)</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_19.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_menuiconsize' value='" . $tp->toFORM($pref['clanlist_menuiconsize']) . "' />px  (pixles)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_20.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['clanlist_enable_showclans'] == 1 ? "<input type='checkbox' name='clanlist_enable_showclans' value='1' checked='checked' />" : "<input type='checkbox' name='clanlist_enable_showclans' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_21.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_menuclanfsize' value='" . $tp->toFORM($pref['clanlist_menuclanfsize']) . "' />px  (pixles)</td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_22.":</td>
		        <td colspan=2 class='forumheader3'>".($pref['clanlist_enable_scroll'] == 1 ? "<input type='checkbox' name='clanlist_enable_scroll' value='1' checked='checked' />" : "<input type='checkbox' name='clanlist_enable_scroll' value='0' />")."</td>
	        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_23.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_menuspeeds' value='" . $tp->toFORM($pref['clanlist_menuspeeds']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_24.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_menuspeedon' value='" . $tp->toFORM($pref['clanlist_menuspeedon']) . "' /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>".ACLANLIST_CONF_25.":</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='clanlist_menuspeedout' value='" . $tp->toFORM($pref['clanlist_menuspeedout']) . "' /></td>
		</tr>








                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='".ACLANLIST_CONF_26."' class='button' /></td>
		</tr>





</table>
</form>";





$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
