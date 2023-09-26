<?php

/*
#######################################
#     e107 website system plguin      #
#     Product Listing                 #
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
if (isset($_POST['update_product'])) {
        $message = ($sql->db_Update("product_listing", "product_code='".$_POST['product_code']."', product_price='".$_POST['product_price']."', product_cat='".$_POST['product_cat']."' WHERE product_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $message = ($sql2->db_Delete("product_listing", "product_id='".$delete_id[0]."'"));
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['product_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>Product ID</td>
        <td style='width:25%' class='forumheader3'>Product Code</td>
        <td style='width:25%' class='forumheader3'>Product Price</td>
        <td style='width:25%' class='forumheader3'>Product Category</td>
        <td style='width:' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("product_listing", "*", "ORDER BY product_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['product_id']."</td>
        <td style='width:25%' class='forumheader3'>".$row['product_code']."</td>
        <td style='width:25%' class='forumheader3'>".$row['product_price']."</td>
        <td style='width:25%' class='forumheader3'>".$row['product_cat']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['product_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['product_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['product_id']} ]')\"/>
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
                $sql->db_Select("product_listing", "product_id, product_code, product_price, product_cat", "product_id = $id");
                $row = $sql->db_Fetch();
$sql2 = new db;
$sql2->db_Select("product_listing_subcat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='product_cat' value='".$option['product_subcat_id']."'>".$option['product_subcat_name']."</option>";}


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Product Price:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("product_price", 100, $row['product_price'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Product Cat:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='product_cat' size='1' class='tbox' style='width:100%'>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Product Code:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("product_code", '100', '15', $row['product_code'], "", "", "", "", "")."
        </td>
        </tr>
";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['product_id']."")."
        ".$rs -> form_button("submit", "update_product", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>

