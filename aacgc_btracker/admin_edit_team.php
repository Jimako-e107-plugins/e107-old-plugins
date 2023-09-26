<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Bracket Tracker           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
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
if (isset($_POST['update_team'])) {
        $message = ($sql->db_Update("aacgc_bt_teams", "team_name='".$_POST['team_name']."',team_color='".$_POST['team_color']."' WHERE team_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_bt_teams", "team_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['team_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>ID</td>
        <td style='width:50%' class='forumheader3'>Team Name</td>
        <td style='width:50%' class='forumheader3'>Team Color</td>
        <td style='width:50%' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_bt_teams", "*", "ORDER BY team_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['team_id']."</td>
        <td style='width:' class='forumheader3'>".$row['team_name']."</td>
        <td style='width:' class='forumheader3'>".$row['team_color']."</td>

        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['team_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['team_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['team_id']} ]')\"/>
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
                $sql->db_Select("aacgc_bt_teams", "*", "team_id = $id");
                $row = $sql->db_Fetch();


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Team Name:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("team_name", 100, $row['team_name'], 500)."
        </td>
        </tr>
	<tr>
		<td style='width:30%' class='forumheader3'>Team Color:</td>
                <td style='width:' class=''>
                <select name='team_color' size='1' class='tbox' style='width:50%'>
                <option name='team_color' value='".$row['team_color']."'>".$row['team_color']."</option>
                <option name='team_color' value='White'>White</option>
                <option name='team_color' value='Red'>Red</option>
                <option name='team_color' value='Blue'>Blue</option>
                <option name='team_color' value='Green'>Green</option>
                <option name='team_color' value='Yellow'>Yellow</option>
                <option name='team_color' value='Orange'>Orange</option>
                <option name='team_color' value='Purple'>Purple</option>

                </td>
	<tr>



";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['team_id']."")."
        ".$rs -> form_button("submit", "update_team", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Bracket Tracker (Edit Team)", $text);
	      require_once(e_ADMIN."footer.php");
}
?>



