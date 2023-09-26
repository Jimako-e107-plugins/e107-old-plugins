<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
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
if (isset($_POST['update_marked'])) {
        $message = ($sql->db_Update("aacgc_gamelist_markedgames", "game='".$_POST['game']."', mark='".$_POST['mark']."' WHERE marked_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_gamelist_markedgames", "marked_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['marked_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>ID</td>
        <td style='width:25%' class='forumheader3'>Game Name</td>
        <td style='width:75%' class='forumheader3'>Mark</td>
        <td style='width:0%' class='forumheader3'>Options</td>
       </tr>";

        $sql->db_Select("aacgc_gamelist_markedgames", "*", "ORDER BY marked_id ASC","");
        while($row = $sql->db_Fetch()){

        $sql2 = new db;
        $sql2->db_Select("aacgc_gamelist_marks", "*", "WHERE mark_id=".$row['mark']."","");
        $row2 = $sql2->db_Fetch();

        $sql3 = new db;
        $sql3->db_Select("aacgc_gamelist", "*", "WHERE game_id=".$row['game']."","");
        $row3 = $sql3->db_Fetch();

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['marked_id']."</td>
        <td style='width:' class='forumheader3'>".$row3['game_name']."</td>
        <td style='width:' class='forumheader3'><img src='".e_PLUGIN."aacgc_gamelist/marks/".$row2['mark_img']."'></img> - ".$row2['mark_name']."</td>
        <td style='width:' class='forumheader3'>";
/*   
        $text .= "
		<a href='".e_SELF."?edit.{$row['marked_id']}'>".ADMIN_EDIT_ICON."</a>";
*/

        $text .= "
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['marked_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['marked_id']} ]')\"/>
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
/*
//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("aacgc_gamelist_cat", "*", "cat_id = $id");
                $row = $sql->db_Fetch();


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category Name:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("cat_name", 100, $row['cat_name'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category Detail:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("cat_text", '100', '25', $row['cat_text'], "", "", "", "", "")."
        </td>
        </tr>

";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['cat_id']."")."
        ".$rs -> form_button("submit", "update_cat", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Game List (Edit Category)", $text);
	      require_once(e_ADMIN."footer.php");
}
*/


?>



