<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Item List                 #
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
if (isset($_POST['update_item_subcat'])) {
        $message = ($sql->db_Update("aacgc_itemlist_subcat", "item_subcat_cat='".intval($_POST['item_subcat_cat'])."', item_subcat_name='".$tp->toDB($_POST['item_subcat_name'])."', item_subcat_details='".$tp->toDB($_POST['item_subcat_details'])."' WHERE item_subcat_id='".intval($_POST['id'])."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
  $sql2->db_Delete("aacgc_itemlist_subcat", "item_subcat_id='".intval($delete_id[0])."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['product_cat_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%'  class='forumheader3'>".LAN_AIL_SUBCAT_06."</td>
        <td style='width:25%' class='forumheader3'>".LAN_AIL_SUBCAT_03."</td>
        <td style='width:50%' class='forumheader3'>".LAN_AIL_SUBCAT_05."</td>
        <td style='width:25%' class='forumheader3'>".LAN_AIL_SUBCAT_02."</td>
        <td style='width:0%'  class='forumheader3'>".LAN_AIL_OPTIONS."</td>
       </tr>";
        $sql->db_Select("aacgc_itemlist_subcat", "*", "ORDER BY item_subcat_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2->db_Select("aacgc_itemlist_cat", "*", "WHERE item_cat_id='".$row['item_subcat_cat']."'","");
        $row2 = $sql2->db_Fetch();
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['item_subcat_id']."</td>
        <td style='width:' class='forumheader3'>".$row['item_subcat_name']."</td>
        <td style='width:' class='forumheader3'>".$row['item_subcat_details']."</td>
        <td style='width:' class='forumheader3'>".$row2['item_cat_name']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['item_subcat_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['item_subcat_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['item_subcat_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("AACGC Item List (edit sub-category)", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("aacgc_itemlist_subcat", "*", "item_subcat_id = $id");
                $row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_itemlist_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='item_cat' value='".$option['item_cat_id']."'>".$option['item_cat_name']."</option>";}


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='item_subcat_cat' size='1' class='tbox' style='width:100%'>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Sub-Category Name:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("item_subcat_name", 100, $row['item_subcat_name'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Sub-Category Details:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("item_subcat_details", '100', '15', $row['item_subcat_details'], "", "", "", "", "")."
        </td>
        </tr>
";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['item_subcat_id']."")."
        ".$rs -> form_button("submit", "update_item_subcat", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender(LAN_AIL_SUBCAT_09, $text);
	      require_once(e_ADMIN."footer.php");
}
?>

