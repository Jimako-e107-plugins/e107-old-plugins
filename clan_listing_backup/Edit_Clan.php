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
require_once(HEADERF);
include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}

$title .= "".CLANLIST_EDC_T."";

$sql->db_Select("clan_listing", "*", "clan_id='".intval($id)."'");
$row = $sql->db_Fetch();

if((ADMIN) OR ($row['clan_owner'] == ".USERID.") AND ($pref['clanlist_enable_clansubmitedit'] == "1")){

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_clan'])) {
        $message = ($sql->db_Update("clan_listing", "clan_owner='".$_POST['clan_owner']."', clan_name='".$_POST['clan_name']."', clan_tag='".$_POST['clan_tag']."', clan_website='".$_POST['clan_website']."', clan_tsip='".$_POST['clan_tsip']."', clan_tsport='".$_POST['clan_tsport']."', clan_banner='".$_POST['clan_banner']."', clan_game_banner='".$_POST['clan_game_banner']."', clan_cat='".$_POST['clan_cat']."' WHERE clan_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}


if (isset($message)) {
$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b><br><br><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'>[ ".CLANLIST_GB." ]</a></div>");

require_once(FOOTERF);

}


//-----------------------------------------------------------------------------------------------------------+

$sql3 = new db;
$sql3->db_Select("clan_listing_cat", "*", "clan_cat_id='".intval($row['clan_cat'])."'");
$row3 = $sql3->db_Fetch();

$sql2 = new db;
$sql2->db_Select("clan_listing_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='clan_cat' value='".$option['clan_cat_id']."'>".$option['clan_cat_name']."</option>";}

$width = "width:100%";

$text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CN.":</td>
        <td style='width:70%' class='forumheader3'>
	    ".$rs->form_hidden("clan_owner", "".$row['clan_owner']."")."
            ".$rs -> form_text("clan_name", 100, $row['clan_name'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CT.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("clan_tag", 100, $row['clan_tag'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CC.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='clan_cat' size='1' class='tbox' style='width:100%'>
                <option name='clan_cat' value='".$row['clan_cat']."'>".$row3['clan_cat_name']."</option>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CW.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("clan_website", '100', '1', $row['clan_website'], "", "", "", "", "")."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CTS.":</td>
        <td style='width:70%' class='forumheader3'>
        IP:".$rs -> form_textarea("clan_tsip", '30', '1', $row['clan_tsip'], "", "", "", "", "")."PORT:".$rs -> form_textarea("clan_tsport", '15', '1', $row['clan_tsport'], "", "", "", "", "")."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CI.":</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' name='clan_banner' rows='15' cols='100' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['clan_banner']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CBC.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("clan_game_banner", '100', '5', $row['clan_game_banner'], "", "", "", "", "")."
        </td>
        </tr>
";

        
$text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['clan_id']."")."
        ".$rs -> form_button("submit", "update_clan", "".CLANLIST_EDC_UP."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";


}

else

{$text .= "".CLANLIST_EDC_ERR."";}



	      
$ns -> tablerender($title, $text);


require_once(FOOTERF);



?>

