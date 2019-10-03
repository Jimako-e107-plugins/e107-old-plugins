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

extract($_POST);
while (list($key, $id) = each($clan_cat_order)){
$tmp = explode(".", $id);
$sql->db_Update("clan_listing_cat", "clan_cat_order=".$tmp[1]." WHERE clan_cat_id=".$tmp[0]);
}

}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {

        $text .= $rs->form_open("post", e_SELF, "", "", "");

        $text .= "
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".ACLANLIST_ID."</td>
        <td style='width:100%' colspan='2' class='forumheader3'>".ACLANLIST_CATICO."</td>
        <td style='width:0%' class='forumheader3'> ".ACLANLIST_CATODR." </td>
        </tr>";

	$cats = $sql->db_Select("clan_listing_cat", "*", "ORDER BY clan_cat_order ASC", "");
	while ($row = $sql->db_Fetch()){
	extract($row);

        $text .= "
        <tr>
        <td style='width:0%' class='forumheader3'>".$clan_cat_id."</td>
        <td style='width:0%' class='forumheader3'><img src='".e_PLUGIN."clan_listing/icons/".$clan_cat_icon."' width='50px' /></td>
        <td style='width:100%' class='forumheader3'>".$clan_cat_name."</td>
	<td style='width:0%' class='forumheader3'>
	<select name='clan_cat_order[]' size='1' class='tbox' style='width:100%'>";

	for($a = 1; $a <= $cats; $a++){
	$text .= ($clan_cat_order == $a ? "<option value='$clan_cat_id.$a' selected='selected'>$a</option>\n" : "<option value='$clan_cat_id.$a'>$a</option>\n");
	}

	$text .= "</td>
	</tr>";}

        $text .= "
	<tr>
	<td style='width:100%' colspan='4' class='forumheader3'>
	<center>".$rs -> form_button("submit", "update_clan_cat", "".CLANLIST_EDC_UP."")."</center>
	</td>
	</tr>
	</table>";

	$text .= $rs->form_close();
        
	$ns -> tablerender("", $text);
	require_once(e_ADMIN."footer.php");

}
//-----------------------------------------------------------------------------------------------------------+

?>


