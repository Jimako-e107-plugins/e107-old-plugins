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
if(!getperms("P")) {
echo "";
exit;
}
require_once(e_ADMIN."auth.php");
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
//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_clan'])) {
        $message = ($sql->db_Update("clan_listing", "clan_owner='".$_POST['clan_owner']."', clan_name='".$_POST['clan_name']."', clan_tag='".$_POST['clan_tag']."', clan_website='".$_POST['clan_website']."', clan_tsip='".$_POST['clan_tsip']."', clan_tsport='".$_POST['clan_tsport']."', clan_banner='".$_POST['clan_banner']."', clan_game_banner='".$_POST['clan_game_banner']."', clan_cat='".$_POST['clan_cat']."' WHERE clan_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("clan_listing", "clan_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['clan_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>".ACLANLIST_ID."</td>
        <td style='width:25%' class='forumheader3'>".ACLANLIST_NOTW."</td>
        <td style='width:25%' class='forumheader3'>".ACLANLIST_CAT."</td>
        <td style='width:' class='forumheader3'>".ACLANLIST_OPT."</td>
       </tr>";
        $sql->db_Select("clan_listing", "*", "ORDER BY clan_id ASC","");
        while($row = $sql->db_Fetch()){
	$sql2 = new db;
        $sql2->db_Select("clan_listing_cat", "*", "WHERE clan_cat_id=".$row['clan_cat']."","");
        $row2 = $sql2->db_Fetch();
	$sql3 = new db;
        $sql3->db_Select("user", "*", "WHERE user_id=".$row['clan_owner']."","");
        $row3 = $sql3->db_Fetch();

        $text .= "
        <tr>
        <td style='width:0%' class='forumheader3'>".$row['clan_id']."</td>
        <td style='width:75%' class='forumheader3'>".$row['clan_name']."<br>".$row3['user_name']."<br>".$row['clan_tag']."<br><a href='".$row['clan_website']."' target='_blank'>".$row['clan_website']."</a></td>
        <td style='width:25%' class='forumheader3'>".$row2['clan_cat_name']."</td>
	<td style='width:0%' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['clan_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['clan_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['clan_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("clan_listing", "*", "clan_id = $id");
                $row = $sql->db_Fetch();
                $sql3 = new db;
                $sql3->db_Select("clan_listing_cat", "*", "WHERE clan_cat_id=".$row['clan_cat']."", "");
                $row3 = $sql3->db_Fetch();
$sql2 = new db;
$sql2->db_Select("clan_listing_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='clan_cat' value='".$option['clan_cat_id']."'>".$option['clan_cat_name']."</option>";}

$sql4 = new db;
$sql4->db_Select("user", "*");
$rows = $sql4->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option2 = $sql4->db_Fetch();
$options2 .= "<option name='clan_owner' value='".$option2['user_id']."'>".$option2['user_name']."</option>";}


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_CN.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("clan_name", 100, $row['clan_name'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".CLANLIST_CSF_COW.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='clan_owner' size='1' class='tbox' style='width:100%'>
		".$options2."
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
        IP:".$rs -> form_textarea("clan_tsip", '100', '1', $row['clan_tsip'], "", "", "", "", "")."PORT:".$rs -> form_textarea("clan_tsport", '100', '1', $row['clan_tsport'], "", "", "", "", "")."
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
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>

