<?php

/*
##########################
# AACGC Clan Listing     #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
*/

require_once("../../class2.php");
include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");
if(!getperms("P")) {
echo "";
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_clan'] == '1') {
$newclanowner = $tp->toDB($_POST['clan_owner']);
$newclanname = $tp->toDB($_POST['clan_name']);
$newclantag = $tp->toDB($_POST['clan_tag']);
$newclanwebsite = $tp->toDB($_POST['clan_website']);
$newclantsip = $tp->toDB($_POST['clan_tsip']);
$newclantsport = $tp->toDB($_POST['clan_tsport']);
$newclanbanner = $tp->toDB($_POST['clan_banner']);
$newclangame = $tp->toDB($_POST['clan_game_banner']);
$newclancat = $_POST['clan_cat'];
$reason = "";
$newok = "";
if (($newclanname == "") OR ($newclanwebsite == "")){
	$newok = "0";
	$reason = "".CLANLIST_CSF_ERR."";
} else {
	$newok = "1";
}
if (($newclancat == "")){
	$newok = "0";
	$reason = "No Category Selected";
} else {
	$newok = "1";
}

If ($newok == "0"){
 	$newtext = "
 	<center>
	<b><br><br> ".$reason."
	</center>
 	</b>
	";
	$ns->tablerender("", $newtext);
}
If ($newok == "1"){
$sql->db_Insert("clan_listing", "NULL, '".$newclanowner."', '".$newclanname."', '".$newclantag."', '".$newclanwebsite."', '".$newclantsip."', '".$newclantsport."', '".$newclanbanner."', '".$newclangame."', '".$newclancat."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Clan Added</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";


$sql->db_Select("clan_listing_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='clan_cat' value='".$option['clan_cat_id']."'>".$option['clan_cat_name']."</option>";}

$sql2 = new db;
$sql2->db_Select("user", "*");
$rows2 = $sql2->db_Rows();
for ($i=0; $i < $rows2; $i++) {
$option2 = $sql2->db_Fetch();
$options2 .= "<option name='clan_owner' value='".$option2['user_id']."'>".$option2['user_name']."</option>";}

$text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CN.":</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='clan_name' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_COW.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='clan_owner' size='1' class='tbox' style='width:50%'>
		".$options2."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CT.":</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='clan_tag' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CW.":</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='clan_website' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CTS.":</td>
        <td style='width:70%' class='forumheader3'>
        IP:<input class='tbox' type='text' name='clan_tsip' size='50'>PORT:<input class='tbox' type='text' name='clan_tsport' size='25'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CI.":</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' name='clan_banner' rows='15' cols='100' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "</td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CBC.":</td>
        <td style='width:70%' class='forumheader3'>
	        <textarea class='tbox' rows='15' cols='100' name='clan_game_banner'></textarea>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CC.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='clan_cat' size='1' class='tbox' style='width:50%'>
		".$options."
        </td>
        </tr>


";
        $text .= "</div>
        </td>
		</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_clan' value='1'>
		<input class='button' type='submit' value='".CLANLIST_NC_ADD."'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Clan Listing (Add Clan)", $text);
	      require_once(e_ADMIN."footer.php");
?>


