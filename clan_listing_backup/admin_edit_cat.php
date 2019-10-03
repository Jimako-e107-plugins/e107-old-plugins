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
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_clan_cat'])) {
        $message = ($sql->db_Update("clan_listing_cat", "clan_cat_name='".$tp->toDB($_POST['clan_cat_name'])."',clan_cat_icon='".$tp->toDB($_POST['clan_cat_icon'])."',clan_cat_order='".$tp->toDB($_POST['clan_cat_order'])."' WHERE clan_cat_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("clan_listing_cat", "clan_cat_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {

$sql2 = new db;
$sql2->db_Select("clan_listing_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$n++;
$options .= "<option name='clan_cat_order' value='".$n."'>".$n."</option>";}
$next = $n + 1;

        $text .= $rs->form_open("post", e_SELF, "myform_".$row['clan_cat_id']."", "", "");

        $text .= "
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".ACLANLIST_ID."</td>
        <td style='width:100%' colspan='2' class='forumheader3'>".ACLANLIST_CATICO."</td>
        <td style='width:0%' class='forumheader3'>".ACLANLIST_CATODR."</td>
        <td style='width:0%' class='forumheader3'>".ACLANLIST_OPT."</td>
        </tr>";

        $sql->db_Select("clan_listing_cat", "*", "ORDER BY clan_cat_order ASC","");
        while($row = $sql->db_Fetch()){

        $text .= "
        <tr>
        <td style='width:0%' class='forumheader3'>".$row['clan_cat_id']."</td>
        <td style='width:0%' class='forumheader3'><img src='".e_PLUGIN."clan_listing/icons/".$row['clan_cat_icon']."' width='50px' /></td>
        <td style='width:100%' class='forumheader3'>".$row['clan_cat_name']."</td>
	<td style='width:0%' class='forumheader3'>".$row['clan_cat_order']."</td>
        <td style='width:0%' class='forumheader3'>
	<a href='".e_SELF."?edit.{$row['clan_cat_id']}'>".ADMIN_EDIT_ICON."</a>
	<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['clan_cat_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['clan_cat_id']} ]')\"/>
	</td>
	</tr>";}

        $text .= "</table>";
	$text .= $rs->form_close();
        
	$ns -> tablerender("", $text);
	require_once(e_ADMIN."footer.php");

}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("clan_listing_cat", "*", "clan_cat_id = $id");
                $row = $sql->db_Fetch();
$sql2 = new db;
$sql2->db_Select("clan_listing_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$n++;
$options .= "<option name='clan_cat_order' value='".$n."'>".$n."</option>";}
$next = $n + 1;


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".ACLANLIST_CATN.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("clan_cat_name", 100, $row['clan_cat_name'], 500)."
        </td>
        </tr>";

        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."clan_listing/icons";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".ACLANLIST_ICO.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("clan_cat_icon", 50, $row['clan_cat_icon'], 100)."
        ".$rs -> form_button("button", '', "Show Icons", "onclick=\"expandit('plcico')\"")." [<a href='http://www.aacgc.com/SSGC/download.php?view.330' target='_blank'> Download Icon Pack </a>] (400+ Icons)
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
            $text .= "<a href=\"javascript:insertext('".$icon['fname']."','clan_cat_icon','plcico')\"><img width='100px' src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }

        $text .= "</div>
        </td></tr>

	<tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".ACLANLIST_CATODR.":</td>
        <td style='width:70%' class='forumheader3'>
	<select name='clan_cat_order' size='1' class='tbox' style='width:20%'>
	<option name='clan_cat_order' value='".$row['clan_cat_order']."'>".$row['clan_cat_order']."</option>
        ".$options."
	<option name='clan_cat_order' value='".$next."'>".$next."</option>
        </td>
        </tr>

        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['clan_cat_id']."")."
        ".$rs -> form_button("submit", "update_clan_cat", "".CLANLIST_EDC_UP."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


