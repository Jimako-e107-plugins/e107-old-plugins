<?php

/*
#######################################
#     AACGC HOS                       #                
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
if (isset($_POST['update_hos'])) {
        $message = ($sql->db_Update("aacgc_hos", "game_name='".$_POST['game_name']."',ip='".$_POST['ip']."',info='".$_POST['info']."',reason='".$_POST['reason']."',date='".$_POST['date']."',img_link='".$_POST['img_link']."',ext_link='".$_POST['ext_link']."' WHERE hos_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {

        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
        $sql2->db_Delete("aacgc_hos", "hos_id='".$delete_id[0]."'");
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['hos_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:5%' class='forumheader3'>HOS ID</td>
        <td style='width:' class='forumheader3'>Game Name</td>
        <td style='width:' class='forumheader3'>IP</td>
        <td style='width:' class='forumheader3'>Info</td>
        <td style='width:' class='forumheader3'>Reason</td>
        <td style='width:' class='forumheader3'>Date</td>
        <td style='width:15%' class='forumheader3'>Image Link</td>
        <td style='width:15%' class='forumheader3'>Ext Link</td>
        <td style='width:5%' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_hos", "*", "ORDER BY hos_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['hos_id']."</td>
        <td style='width:' class='forumheader3'>".$row['game_name']."</td>
        <td style='width:' class='forumheader3'>".$row['ip']."</td>
        <td style='width:' class='forumheader3'>".$row['info']."</td>
        <td style='width:' class='forumheader3'>".$row['reason']."</td>
        <td style='width:' class='forumheader3'>".$row['date']."</td>
        <td style='width:' class='forumheader3'>".$row['img_link']."</td>
        <td style='width:' class='forumheader3'>".$row['ext_link']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['hos_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['hos_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['hos_id']} ]')\"/>
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
                $sql->db_Select("aacgc_hos", "*", "hos_id = $id");
                $row = $sql->db_Fetch();


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Game Name:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("game_name", 100, $row['game_name'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>IP:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("ip", 100, $row['ip'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Info:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("info", 100, $row['info'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Reason:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("reason", 100, $row['reason'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Date:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("date", 100, $row['date'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Image Link:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("img_link", 100, $row['img_link'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Ext Link:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("ext_link", 100, $row['ext_link'], 500)."
        </td>
        </tr>
";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['hos_id']."")."
        ".$rs -> form_button("submit", "update_hos", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


