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
if (isset($_POST['update_item'])) {
        $message = ($sql->db_Update("aacgc_itemlist", "item_cat='".$_POST['item_cat']."', item_subcat='".$_POST['item_subcat']."', item_name='".$_POST['item_name']."', item_image='".$_POST['item_image']."', item_detail='".$_POST['item_detail']."', item_link='".$_POST['item_link']."', item_price='".$_POST['item_price']."' WHERE item_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $message = ($sql2->db_Delete("aacgc_itemlist", "item_id='".$delete_id[0]."'"));
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {


        $text .= $rs->form_open("post", e_SELF, "myform_".$row['item_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>ID</td>
        <td style='width:25%' class='forumheader3'>Item Name / Image</td>
        <td style='width:25%' class='forumheader3'>Item Category / Sub-Category</td>
        <td style='width:50%' class='forumheader3'>Item Details / Link</td>
        <td style='width:25%' class='forumheader3'>Item Price</td>
        <td style='width:' class='forumheader3'>Options</td>
       </tr>";

        $sql->db_Select("aacgc_itemlist", "*", "ORDER BY item_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2->db_Select("aacgc_itemlist_cat", "*", "WHERE item_cat_id='".$row['item_cat']."'","");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_itemlist_subcat", "*", "WHERE item_subcat_id='".$row['item_subcat']."'","");
        $row3 = $sql3->db_Fetch();

if ($row['item_image'] == "")
{$image = "".e_PLUGIN."aacgc_itemlist/images/NoPhotoAvailable.jpg";}
else
{$image = "".$row['item_image']."";}

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['item_id']."</td>
        <td style='width:25%' class='forumheader3'>".$row['item_name']."<br><img width='50px' src='".$image."'></img></td>
        <td style='width:25%' class='forumheader3'>".$row2['item_cat_name']."<br>".$row3['item_subcat_name']."</td>
        <td style='width:25%' class='forumheader3'>".$row['item_detail']."<br>".$row['item_link']."</td>
        <td style='width:25%' class='forumheader3'>".$row['item_price']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['item_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['item_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['item_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("AACGC Item List (edit item)", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("aacgc_itemlist", "*", "item_id = $id");
                $row = $sql->db_Fetch();
$sql2 = new db;
$sql2->db_Select("aacgc_itemlist_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='item_cat' value='".$option['item_cat_id']."'>".$option['item_cat_name']."</option>";}

$sql3 = new db;
$sql3->db_Select("aacgc_itemlist_subcat", "*");
$rows = $sql3->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option3 = $sql3->db_Fetch();
$options3 .= "<option name='item_subcat' value='".$option3['item_subcat_id']."'>".$option3['item_subcat_name']."</option>";}

$sql4 = new db;
$sql4->db_Select("aacgc_itemlist_cat", "*", "WHERE item_cat_id='".$row['item_cat']."'","");
$row4 = $sql4->db_Fetch();
$sql5 = new db;
$sql5->db_Select("aacgc_itemlist_subcat", "*", "WHERE item_subcat_id='".$row['item_subcat']."'","");
$row5 = $sql5->db_Fetch();


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>

        <tr>
        <td style='width:30%; text-align:right' class='forumheader3' rowspan=3>Category (and/or) Sub_Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='item_cat' size='1' class='tbox' style='width:100%'>
                <option name='item_cat' value='".$row4['item_cat_id']."'>".$row4['item_cat_name']."</option>
		".$options."
                <option name='item_cat' value=''><i>none</i></option>

        </td>
        </tr>
        <tr>
        <td style='width:70%' class='forumheader3'>
        (And/OR)
        </td>
        </tr>

        <tr>
        <td style='width:70%' class='forumheader3'>
		<select name='item_subcat' size='1' class='tbox' style='width:100%'>
                <option name='item_subcat' value='".$row5['item_subcat_id']."'>".$row5['item_subcat_name']."</option>
		".$options3."
                <option name='item_subcat' value=''><i>none</i></option>

        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Item Name:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("item_name", 100, $row['item_name'], 500)."
        </td>
        </tr>

        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Item Image Path:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("item_image", 100, $row['item_image'], 500)."
        </td>
        </tr>

        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Item Details:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("item_detail", '100', '15', $row['item_detail'], "", "", "", "", "")."
        </td>
        </tr>

        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Item Link:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("item_link", 100, $row['item_link'], 500)."
        </td>
        </tr>

        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Item Price:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("item_price", 100, $row['item_price'], 500)."
        </td>
        </tr>

";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['item_id']."")."
        ".$rs -> form_button("submit", "update_item", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Item List (edit item)", $text);
	      require_once(e_ADMIN."footer.php");
}
?>

