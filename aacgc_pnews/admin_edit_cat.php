<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
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

include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_cat'])) {
        $message = ($sql->db_Update("aacgc_pnews_cat", "news_cat_title='".$_POST['news_cat_title']."', news_cat_desc='".$_POST['news_cat_desc']."' WHERE news_cat_id='".$_POST['id']."' ")) ? "".APNEWS_59."" : "".APNEWS_60."";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_pnews_cat", "news_cat_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['news_cat_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".APNEWS_62."</td>
        <td style='width:25%' class='forumheader3'>".APNEWS_81."</td>
        <td style='width:75%' class='forumheader3'>".APNEWS_82."</td>
        <td style='width:0%' class='forumheader3'>".APNEWS_66."</td>
       </tr>";
        $sql->db_Select("aacgc_pnews_cat", "*", "ORDER BY news_cat_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['news_cat_id']."</td>
        <td style='width:' class='forumheader3'>".$row['news_cat_title']."</td>
        <td style='width:' class='forumheader3'>".$row['news_cat_desc']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['news_cat_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['news_cat_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['news_cat_id']} ]')\"/>
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
                $sql->db_Select("aacgc_pnews_cat", "*", "news_cat_id = $id");
                $row = $sql->db_Fetch();


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_81.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("news_cat_title", 100, $row['news_cat_title'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_82.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("news_cat_desc", '100', '25', $row['news_cat_desc'], "", "", "", "", "")."
        </td>
        </tr>

";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['news_cat_id']."")."
        ".$rs -> form_button("submit", "update_cat", "".APNEWS_80."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Public News (Edit Category)", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


