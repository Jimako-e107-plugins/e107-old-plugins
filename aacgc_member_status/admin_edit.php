<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Status             #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;
require_once("../../class2.php");
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

include_lan(e_PLUGIN."aacgc_member_status/languages/".e_LANGUAGE.".php");

//-----------------------------------------------------------------------------------------------------------+

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    	$sql2->db_Delete("aacgc_member_status", "status_id='".$delete_id[0]."'");
}

//-----------------------------------------------------------------------------------------------------------+

if ($action == "") {

$text .= $rs->form_open("post", e_SELF, "myform_".$row['status_id']."", "", "");
$text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
        <td style='width:0%' class='forumheader3'>".AMS_29."</td>
        <td style='width:40%' class='forumheader3'>".AMS_30."</td>
        <td style='width:60%' class='forumheader3'>".AMS_31."</td>
        <td style='width:0%' class='forumheader3'>".AMS_32."</td>
        </tr>";

        $sql->db_Select("aacgc_member_status", "*", "ORDER BY status_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2 ->db_Select("user", "*", "WHERE user_id = '".$row['status_user']."'","");
        $row2 = $sql2 ->db_Fetch();

$text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['status_id']."</td>
        <td style='width:' class='forumheader3'>".$row2['user_name']."</td>
        <td style='width:' class='forumheader3'>".$row['status_text']."<br><div style='width:auto' class='forumheader3'>".$tp -> toHTML($row['status_text'], TRUE)."</div></td>
        <td style='width:' class='forumheader3'>
	<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['status_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['status_id']} ]')\"/>
	</td>
        </tr>";
}

$text .= "</table>";
$text .= $rs->form_close();
	
$ns -> tablerender("AACGC Member Status (".AMS_33.")", $text);
require_once(e_ADMIN."footer.php");
}

//-----------------------------------------------------------------------------------------------------------+

?>

