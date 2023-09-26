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
if (isset($_POST['update_product_subcat'])) {
        $message = ($sql->db_Update("product_listing_subcat", "product_subcat_name='".$_POST['product_subcat_name']."', product_cat='".$_POST['product_cat']."' WHERE product_subcat_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("product_listing_subcat", "product_subcat_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['product_subcat_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>Sub-Category ID</td>
        <td style='width:25%' class='forumheader3'>Sub-Category Name</td>
        <td style='width:25%' class='forumheader3'>Category</td>
        <td style='width:' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("product_listing_subcat", "*", "ORDER BY product_subcat_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['product_subcat_id']."</td>
        <td style='width:25%' class='forumheader3'>".$row['product_subcat_name']."</td>
        <td style='width:25%' class='forumheader3'>".$row['product_cat']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['product_subcat_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['product_subcat_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['product_subcat_id']} ]')\"/>
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
                $sql->db_Select("product_listing_subcat", "*", "product_subcat_id = $id");
                $row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("product_listing_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='product_cat' value='".$option['product_cat_id']."'>".$option['product_cat_name']."</option>";}



        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Sub-Category Name:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("product_subcat_name", 100, $row['product_subcat_name'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='product_cat' size='1' class='tbox' style='width:100%'>
		".$options."
        </td>
        </tr>

";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['product_subcat_id']."")."
        ".$rs -> form_button("submit", "update_product_subcat", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>



