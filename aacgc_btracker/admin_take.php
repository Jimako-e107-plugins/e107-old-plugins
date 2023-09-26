<?php

/*
#######################################
#     AACGC Bracket Tracker           #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/




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
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_user'])) {
        $message = ($sql->db_Update("aacgc_bt_members", "user_id='".$_POST['user_id']."',user_place='".$_POST['user_place']."' WHERE bt_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_bt_members", "bt_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+

if ($action == "") {

        $text .= $rs->form_open("post", e_SELF, "myform_".$row['bt_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>ID</td>
        <td style='width:40%' class='forumheader3'>User</td>
        <td style='width:40%' class='forumheader3'>Team</td>
        <td style='width:40%' class='forumheader3'>Category</td>
        <td style='width:60%' class='forumheader3'>Place</td>
        <td style='width:0%' class='forumheader3'>Delete</td>
       </tr>";
        $sql->db_Select("aacgc_bt_members", "*", "ORDER BY bt_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['user_id']."","");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_bt_cat", "*", "WHERE cat_id=".$row['user_cat']."","");
        $row3 = $sql3->db_Fetch();
        $sql4 = new db;
        $sql4->db_Select("aacgc_bt_teams", "*", "WHERE team_id=".$row['user_team']."","");
        $row4 = $sql4->db_Fetch();
        $text .= "
        <tr>
        <td style='width:' class='forumheader3' name='event_id' >".$row['bt_id']."</td>
        <td style='width:' class='forumheader3' name='user_id'>".$row2['user_name']."</td>
        <td style='width:' class='forumheader3' name='user_team'>".$row4['team_name']."</td>
        <td style='width:' class='forumheader3' name='user_cat'>".$row3['cat_name']."</td>
        <td style='width:' class='forumheader3' name='user_place'>".$row['user_place']."</td>
        <td style='width:' class='forumheader3'>";
        
$text .= "<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['bt_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['bt_id']} ]')\"/>
                </td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("Bracket Tracker User Editor", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+


?>

