<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

require_once("../../class2.php");
include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");
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
if (isset($_POST['update_cat_order'])) {

extract($_POST);
while (list($key, $id) = each($cat_order)){
$tmp = explode(".", $id);
$sql->db_Update("aacgc_paytrack_cat", "cat_order=".$tmp[1]." WHERE cat_id=".$tmp[0]);
}

}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {

        $text .= $rs->form_open("post", e_SELF, "", "", "");

        $text .= "
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:10%' class='forumheader3'>".APT_39."</td>
        <td style='width:80%' class='forumheader3'>".APT_35."</td>
        <td style='width:10%' class='forumheader3'> ".APT_37." </td>
        </tr>";

	$cats = $sql->db_Select("aacgc_paytrack_cat", "*", "ORDER BY cat_order ASC", "");
	while ($row = $sql->db_Fetch()){
	extract($row);

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$cat_id."</td>
        <td style='width:' class='forumheader3'>".$cat_title."</td>
	<td style='width:' class='forumheader3'>
	<select name='cat_order[]' size='1' class='tbox' style='width:100%'>";

	for($a = 1; $a <= $cats; $a++){
	$text .= ($cat_order == $a ? "<option value='$cat_id.$a' selected='selected'>$a</option>\n" : "<option value='$cat_id.$a'>$a</option>\n");
	}

	$text .= "</td>
	</tr>";}

        $text .= "
	<tr>
	<td style='width:100%' colspan='4' class='forumheader3'>
	<center>".$rs -> form_button("submit", "update_cat_order", "".APT_42."")."</center>
	</td>
	</tr>
	</table>";

	$text .= $rs->form_close();
        
	$ns -> tablerender("AACGC Payment Tracker (".APT_41.")", $text);
	require_once(e_ADMIN."footer.php");

}
//-----------------------------------------------------------------------------------------------------------+

?>


